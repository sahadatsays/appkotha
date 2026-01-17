<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactFormRequest;
use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact.index');
    }

    public function store(ContactFormRequest $request): RedirectResponse
    {
        ContactMessage::create([
            ...$request->validated(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('contact.index')
            ->with('success', 'Thank you for your message! We will get back to you within 24 hours.');
    }

    public function quote(): View
    {
        return view('contact.quote');
    }

    public function storeQuote(ContactFormRequest $request): RedirectResponse
    {
        ContactMessage::create([
            ...$request->validated(),
            'message_type' => 'quote',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('contact.quote')
            ->with('success', 'Thank you for your quote request! Our team will review your requirements and contact you within 24 hours.');
    }

    public function success(): View
    {
        return view('contact.success');
    }

    public function demo(): View
    {
        return view('contact.demo');
    }

    public function storeDemoRequest(ContactFormRequest $request): RedirectResponse
    {
        ContactMessage::create([
            ...$request->validated(),
            'message_type' => 'demo',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()
            ->route('contact.demo')
            ->with('success', 'Thank you for your demo request! We will contact you to schedule a demo.');
    }
}
