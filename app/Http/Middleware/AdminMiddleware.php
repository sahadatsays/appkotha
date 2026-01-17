<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check authentication
        if (!auth()->check()) {
            Log::warning('Unauthenticated admin access attempt', [
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
                'user_agent' => $request->userAgent(),
            ]);
            abort(403, 'Unauthorized. Admin access required.');
        }

        // Check admin status
        if (!auth()->user()->is_admin) {
            Log::warning('Non-admin user attempted admin access', [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email,
                'ip' => $request->ip(),
                'url' => $request->fullUrl(),
            ]);
            abort(403, 'Unauthorized. Admin access required.');
        }

        // Optional: IP Whitelist (configure in .env)
        $allowedIPs = config('app.admin_allowed_ips', []);
        if (!empty($allowedIPs)) {
            $allowedIPs = is_array($allowedIPs) ? $allowedIPs : explode(',', $allowedIPs);
            $allowedIPs = array_map('trim', $allowedIPs);
            
            if (!in_array($request->ip(), $allowedIPs)) {
                Log::alert('Admin access attempt from unauthorized IP', [
                    'user_id' => auth()->id(),
                    'ip' => $request->ip(),
                    'url' => $request->fullUrl(),
                ]);
                abort(403, 'Access denied from this IP address.');
            }
        }

        // Admin session timeout (30 minutes for admin, shorter than regular users)
        $adminTimeout = config('app.admin_session_timeout', 30);
        $lastActivity = session('admin_last_activity');
        
        if ($lastActivity && now()->diffInMinutes($lastActivity) > $adminTimeout) {
            Log::info('Admin session expired', [
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
            ]);
            
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            
            return redirect()->route('login')
                ->with('error', 'Your admin session has expired. Please login again.');
        }

        // Update last activity
        session(['admin_last_activity' => now()]);

        // Log admin access (optional, for sensitive operations)
        if ($request->isMethod('POST') || $request->isMethod('DELETE') || $request->isMethod('PATCH')) {
            Log::info('Admin action performed', [
                'user_id' => auth()->id(),
                'action' => $request->route()->getName(),
                'method' => $request->method(),
                'ip' => $request->ip(),
            ]);
        }

        return $next($request);
    }
}
