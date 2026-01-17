<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::published()
            ->orderBy('sort_order')
            ->get();

        return view('services.index', compact('services'));
    }

    public function show(Service $service): View
    {
        if (!$service->is_published) {
            abort(404);
        }

        $otherServices = Service::published()
            ->where('id', '!=', $service->id)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        return view('services.show', compact('service', 'otherServices'));
    }
}
