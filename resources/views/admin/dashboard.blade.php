@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
{{-- Stats Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    @php
        $stats = [
            ['label' => 'Total Products', 'value' => $productCount, 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>', 'color' => 'text-blue-600 bg-blue-50'],
            ['label' => 'New Inquiries', 'value' => $newInquiries, 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>', 'color' => 'text-amber-600 bg-amber-50'],
            ['label' => 'Subscribers', 'value' => $subscriberCount, 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>', 'color' => 'text-green-600 bg-green-50'],
            ['label' => 'Active Warranties', 'value' => $warrantyCount, 'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>', 'color' => 'text-accent-600 bg-accent-50'],
        ];
    @endphp
    @foreach($stats as $stat)
        <div class="card p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-warm-400">{{ $stat['label'] }}</p>
                    <p class="text-3xl font-display font-bold text-warm-800 mt-1">{{ $stat['value'] }}</p>
                </div>
                <div class="w-12 h-12 rounded-xl {{ $stat['color'] }} flex items-center justify-center">
                    {!! $stat['icon'] !!}
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- Recent Activity --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Recent Inquiries --}}
    <div class="card">
        <div class="px-6 py-4 border-b border-warm-200/50 flex items-center justify-between">
            <h2 class="font-display font-semibold text-warm-700">Recent Inquiries</h2>
            <a href="{{ route('admin.inquiries') }}" class="text-sm text-accent-600 hover:text-accent-700">View All →</a>
        </div>
        <div class="divide-y divide-warm-100">
            @forelse($recentInquiries as $inquiry)
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-warm-700 text-sm">{{ $inquiry->name }}</p>
                            <p class="text-xs text-warm-400">{{ $inquiry->email }}</p>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $inquiry->status === 'new' ? 'bg-amber-100 text-amber-700' : ($inquiry->status === 'read' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700') }}">{{ ucfirst($inquiry->status) }}</span>
                    </div>
                    <p class="text-sm text-warm-500 mt-1 line-clamp-1">{{ $inquiry->message }}</p>
                    <p class="text-xs text-warm-300 mt-1">{{ $inquiry->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-warm-400 text-sm">No inquiries yet.</div>
            @endforelse
        </div>
    </div>

    {{-- Recent Subscribers --}}
    <div class="card">
        <div class="px-6 py-4 border-b border-warm-200/50 flex items-center justify-between">
            <h2 class="font-display font-semibold text-warm-700">Recent Subscribers</h2>
            <a href="{{ route('admin.subscribers') }}" class="text-sm text-accent-600 hover:text-accent-700">View All →</a>
        </div>
        <div class="divide-y divide-warm-100">
            @forelse($recentSubscribers as $sub)
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <p class="font-medium text-warm-700 text-sm">{{ $sub->email }}</p>
                        <p class="text-xs text-warm-300">{{ $sub->subscribed_at?->diffForHumans() ?? 'N/A' }}</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $sub->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-warm-100 text-warm-500' }}">{{ ucfirst($sub->status) }}</span>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-warm-400 text-sm">No subscribers yet.</div>
            @endforelse
        </div>
    </div>

    {{-- Recent Warranties --}}
    <div class="card lg:col-span-2">
        <div class="px-6 py-4 border-b border-warm-200/50 flex items-center justify-between">
            <h2 class="font-display font-semibold text-warm-700">Latest Guaranteed Products</h2>
            <a href="{{ route('admin.warranties') }}" class="text-sm text-accent-600 hover:text-accent-700">Manage Warranties →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-warm-50/50 text-warm-500 text-[11px] uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Serial</th>
                        <th class="px-6 py-3 font-semibold">Customer</th>
                        <th class="px-6 py-3 font-semibold">Product</th>
                        <th class="px-6 py-3 font-semibold">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-warm-100">
                    @foreach($recentWarranties as $rw)
                        <tr class="text-sm">
                            <td class="px-6 py-3 font-mono text-accent-600">{{ $rw->serial_number }}</td>
                            <td class="px-6 py-3 text-warm-700">{{ $rw->customer_name }}</td>
                            <td class="px-6 py-3 text-warm-500">{{ $rw->product_name }}</td>
                            <td class="px-6 py-3 text-warm-400">{{ $rw->created_at->format('M d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
