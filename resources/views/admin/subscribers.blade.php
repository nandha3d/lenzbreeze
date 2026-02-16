@extends('layouts.admin')
@section('title', 'Subscribers')
@section('page_title', 'Newsletter Subscribers')

@section('content')
<div class="flex items-center justify-between mb-6">
    <p class="text-warm-400 text-sm">{{ $subscribers->total() }} total subscribers</p>
    <a href="{{ route('admin.subscribers.export') }}" class="btn-secondary text-sm">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        Export CSV
    </a>
</div>

<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-warm-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Subscribed</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-warm-100">
            @forelse($subscribers as $sub)
                <tr class="hover:bg-warm-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-warm-700">{{ $sub->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $sub->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-warm-200 text-warm-500' }}">{{ ucfirst($sub->status) }}</span>
                    </td>
                    <td class="px-6 py-4 text-warm-400">{{ $sub->subscribed_at?->format('M d, Y') ?? '—' }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-6 py-12 text-center text-warm-400">No subscribers yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($subscribers->hasPages())
    <div class="mt-6">{{ $subscribers->links() }}</div>
@endif
@endsection
