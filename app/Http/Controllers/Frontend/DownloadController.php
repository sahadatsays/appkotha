<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\Order;
use App\Models\ProductFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadController extends Controller
{
    /**
     * Show user's downloads/licenses
     */
    public function index()
    {
        $user = auth()->user();

        $licenses = License::with(['product', 'order'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('downloads.index', [
            'licenses' => $licenses,
        ]);
    }

    /**
     * Download product file using license
     */
    public function download(Request $request, License $license)
    {
        // Verify ownership
        if (!$this->canAccess($license)) {
            abort(403, 'You do not have access to this download.');
        }

        // Check if license is active
        if (!$license->isActive()) {
            return back()->with('error', 'Your license has expired or been revoked.');
        }

        // Get the main product file
        $file = ProductFile::where('product_id', $license->product_id)
            ->where('is_main', true)
            ->where('is_active', true)
            ->first();

        if (!$file) {
            return back()->with('error', 'Download file not available.');
        }

        // Increment download counters
        $license->incrementDownload();
        $file->incrementDownload();

        // Generate download response
        return $this->streamDownload($file);
    }

    /**
     * Download specific file (for products with multiple files)
     */
    public function downloadFile(Request $request, License $license, ProductFile $file)
    {
        // Verify ownership
        if (!$this->canAccess($license)) {
            abort(403, 'You do not have access to this download.');
        }

        // Check if license is active
        if (!$license->isActive()) {
            return back()->with('error', 'Your license has expired or been revoked.');
        }

        // Verify file belongs to licensed product
        if ($file->product_id !== $license->product_id) {
            abort(403, 'Invalid file for this license.');
        }

        if (!$file->is_active) {
            return back()->with('error', 'This file is no longer available.');
        }

        // Increment download counters
        $license->incrementDownload();
        $file->incrementDownload();

        return $this->streamDownload($file);
    }

    /**
     * Guest download (via order lookup)
     */
    public function guestDownload(Request $request, Order $order, License $license)
    {
        // Verify the license belongs to this order
        if ($license->order_id !== $order->id) {
            abort(403);
        }

        // Verify guest session
        if (!session('guest_order_' . $order->id)) {
            return redirect()->route('checkout.lookup')
                ->with('error', 'Please verify your order to access downloads.');
        }

        // Check if license is active
        if (!$license->isActive()) {
            return back()->with('error', 'Your license has expired or been revoked.');
        }

        // Get the main product file
        $file = ProductFile::where('product_id', $license->product_id)
            ->where('is_main', true)
            ->where('is_active', true)
            ->first();

        if (!$file) {
            return back()->with('error', 'Download file not available.');
        }

        // Increment download counters
        $license->incrementDownload();
        $file->incrementDownload();

        return $this->streamDownload($file);
    }

    /**
     * Verify license key (API endpoint)
     */
    public function verifyLicense(Request $request)
    {
        $validated = $request->validate([
            'license_key' => 'required|string',
            'domain' => 'nullable|string',
            'product_id' => 'nullable|integer',
        ]);

        $license = License::where('license_key', $validated['license_key'])->first();

        if (!$license) {
            return response()->json([
                'valid' => false,
                'message' => 'Invalid license key.',
            ], 404);
        }

        // Check product match if provided
        if (isset($validated['product_id']) && $license->product_id !== $validated['product_id']) {
            return response()->json([
                'valid' => false,
                'message' => 'License key is not valid for this product.',
            ], 400);
        }

        if (!$license->isActive()) {
            return response()->json([
                'valid' => false,
                'message' => $license->isExpired() ? 'License has expired.' : 'License is not active.',
                'status' => $license->status,
                'expires_at' => $license->expires_at?->toISOString(),
            ], 400);
        }

        return response()->json([
            'valid' => true,
            'message' => 'License is valid.',
            'license' => [
                'type' => $license->type,
                'status' => $license->status,
                'expires_at' => $license->expires_at?->toISOString(),
                'product_id' => $license->product_id,
                'activations' => [
                    'current' => $license->current_activations,
                    'max' => $license->max_activations,
                ],
            ],
        ]);
    }

    /**
     * Activate license (API endpoint)
     */
    public function activateLicense(Request $request)
    {
        $validated = $request->validate([
            'license_key' => 'required|string',
            'domain' => 'nullable|string',
            'device_id' => 'nullable|string',
        ]);

        $license = License::where('license_key', $validated['license_key'])->first();

        if (!$license) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid license key.',
            ], 404);
        }

        if (!$license->canActivate()) {
            return response()->json([
                'success' => false,
                'message' => 'License activation limit reached or license is not active.',
                'activations' => [
                    'current' => $license->current_activations,
                    'max' => $license->max_activations,
                ],
            ], 400);
        }

        $activated = $license->activate([
            'domain' => $validated['domain'] ?? null,
            'device_id' => $validated['device_id'] ?? null,
            'ip' => $request->ip(),
        ]);

        return response()->json([
            'success' => $activated,
            'message' => $activated ? 'License activated successfully.' : 'Failed to activate license.',
        ]);
    }

    /**
     * Check if user can access the license
     */
    private function canAccess(License $license): bool
    {
        $user = auth()->user();

        // User owns the license
        if ($user && $license->user_id === $user->id) {
            return true;
        }

        // Guest with session verification
        if (session('guest_order_' . $license->order_id)) {
            return true;
        }

        return false;
    }

    /**
     * Stream file download with security checks
     */
    private function streamDownload(ProductFile $file): StreamedResponse
    {
        $path = $file->file_path;

        // Security: Prevent directory traversal attacks
        $path = str_replace(['../', '..\\', '..'], '', $path);
        $path = ltrim($path, '/');
        $path = ltrim($path, '\\');

        // Security: Validate path is within storage directory
        $fullPath = Storage::disk('local')->path($path);
        $storagePath = Storage::disk('local')->path('');

        // Normalize paths for comparison
        $fullPath = realpath($fullPath);
        $storagePath = realpath($storagePath);

        if (!$fullPath || !$storagePath || !str_starts_with($fullPath, $storagePath)) {
            \Log::warning('Invalid file path attempted', [
                'path' => $file->file_path,
                'user_id' => auth()->id(),
                'ip' => request()->ip(),
            ]);
            abort(403, 'Invalid file path.');
        }

        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'File not found.');
        }

        // Security: Sanitize filename to prevent path injection
        $filename = basename($file->file_name);
        $filename = preg_replace('/[^a-zA-Z0-9._-]/', '_', $filename);

        // Security: Rate limiting (10 downloads per hour per user)
        if (auth()->check()) {
            $key = 'downloads:' . auth()->id();
            if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, 10)) {
                abort(429, 'Too many download attempts. Please try again later.');
            }
            \Illuminate\Support\Facades\RateLimiter::hit($key, 3600);
        }

        // Log download for security audit
        \Log::info('File download', [
            'user_id' => auth()->id(),
            'file_id' => $file->id,
            'filename' => $filename,
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return Storage::disk('local')->download(
            $path,
            $filename,
            [
                'Content-Type' => $file->file_type ?? 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }
}
