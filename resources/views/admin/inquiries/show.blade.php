@extends('layouts.admin')
@section('title', 'Inquiry from ' . $inquiry->name)
@section('page_title', 'Inquiry Details')

@section('content')
<div class="max-w-2xl">
    <a href="{{ route('admin.inquiries') }}" class="text-sm text-warm-400 hover:text-brand-500 flex items-center gap-1 mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to Inquiries
    </a>

    <div class="card p-8 space-y-6">
        <div class="flex items-center justify-between">
            <h2 class="font-display text-xl font-bold text-brand-500">{{ $inquiry->name }}</h2>
            <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $inquiry->status === 'new' ? 'bg-amber-100 text-amber-700' : ($inquiry->status === 'read' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">{{ ucfirst($inquiry->status) }}</span>
        </div>

        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-warm-400">Email</span>
                <p class="font-medium text-warm-700"><a href="mailto:{{ $inquiry->email }}" class="text-accent-600 hover:underline">{{ $inquiry->email }}</a></p>
            </div>
            @if($inquiry->phone)
                <div>
                    <span class="text-warm-400">Phone</span>
                    <p class="font-medium text-warm-700">{{ $inquiry->phone }}</p>
                </div>
            @endif
            @if($inquiry->company)
                <div>
                    <span class="text-warm-400">Company</span>
                    <p class="font-medium text-warm-700">{{ $inquiry->company }}</p>
                </div>
            @endif
            <div>
                <span class="text-warm-400">Type</span>
                <p class="font-medium text-warm-700">{{ ucfirst($inquiry->type) }}</p>
            </div>
            <div>
                <span class="text-warm-400">Date</span>
                <p class="font-medium text-warm-700">{{ $inquiry->created_at->format('M d, Y h:i A') }}</p>
            </div>
        </div>

        @if($inquiry->subject)
            <div class="border-t border-warm-100 pt-4">
                <span class="text-warm-400 text-sm">Subject</span>
                <p class="font-medium text-warm-700 mt-0.5">{{ $inquiry->subject }}</p>
            </div>
        @endif

        <div class="border-t border-warm-100 pt-4">
            <span class="text-warm-400 text-sm">Message</span>
            <p class="text-warm-700 mt-2 leading-relaxed whitespace-pre-wrap">{{ $inquiry->message }}</p>
        </div>

        <div class="border-t border-warm-100 pt-4 flex gap-3">
            <a href="mailto:{{ $inquiry->email }}?subject=Re: {{ $inquiry->subject ?? 'Your Inquiry' }}" class="btn-primary text-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Reply via Email
            </a>
            @if($inquiry->phone)
                <a href="tel:{{ $inquiry->phone }}" class="btn-secondary text-sm">Call</a>
            @endif
        </div>
    </div>
</div>
@endsection
