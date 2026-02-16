@extends('layouts.admin')
@section('title', 'Inquiries')
@section('page_title', 'Inquiries')

@section('content')
<p class="text-warm-400 text-sm mb-6">Contact form submissions from your website visitors</p>

<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-warm-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Type</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Date</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-warm-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-warm-100">
            @forelse($inquiries as $inquiry)
                <tr class="hover:bg-warm-50 transition-colors {{ $inquiry->status === 'new' ? 'bg-amber-50/30' : '' }}">
                    <td class="px-6 py-4 font-medium text-warm-700">{{ $inquiry->name }}</td>
                    <td class="px-6 py-4 text-warm-500">{{ $inquiry->email }}</td>
                    <td class="px-6 py-4"><span class="px-2 py-0.5 rounded-full text-xs font-medium bg-warm-100 text-warm-600">{{ ucfirst($inquiry->type) }}</span></td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $inquiry->status === 'new' ? 'bg-amber-100 text-amber-700' : ($inquiry->status === 'read' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">{{ ucfirst($inquiry->status) }}</span>
                    </td>
                    <td class="px-6 py-4 text-warm-400">{{ $inquiry->created_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-accent-600 hover:text-accent-700 text-sm font-medium">View →</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-6 py-12 text-center text-warm-400">No inquiries received yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($inquiries->hasPages())
    <div class="mt-6">{{ $inquiries->links() }}</div>
@endif
@endsection
