@extends('layouts.admin')
@section('title', 'Retailer Management')
@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Retailer Management</h1>
    <a href="{{ route('admin.retailers.create') }}" class="btn-primary">+ Add Retailer</a>
</div>
<div class="bg-white rounded-xl shadow-sm overflow-hidden border border-warm-200">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-warm-50 text-warm-600 text-xs uppercase">
                <tr>
                    <th class="px-6 py-3 font-semibold">Code</th>
                    <th class="px-6 py-3 font-semibold">Name</th>
                    <th class="px-6 py-3 font-semibold">Owner</th>
                    <th class="px-6 py-3 font-semibold">City</th>
                    <th class="px-6 py-3 font-semibold">Phone</th>
                    <th class="px-6 py-3 font-semibold text-center">Warranties</th>
                    <th class="px-6 py-3 font-semibold text-center">Status</th>
                    <th class="px-6 py-3 font-semibold text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-warm-100">
                @forelse($retailers as $retailer)
                <tr class="hover:bg-warm-50/50 transition-colors">
                    <td class="px-6 py-4 font-mono text-sm text-accent-700 font-bold">{{ $retailer->retailer_code }}</td>
                    <td class="px-6 py-4 font-medium text-warm-700">{{ $retailer->name }}</td>
                    <td class="px-6 py-4 text-warm-600 text-sm">{{ $retailer->owner_name }}</td>
                    <td class="px-6 py-4 text-warm-500 text-sm">{{ $retailer->city }}, {{ $retailer->state }}</td>
                    <td class="px-6 py-4 text-warm-500 text-sm">{{ $retailer->phone }}</td>
                    <td class="px-6 py-4 text-center"><span class="bg-accent-50 text-accent-700 px-2 py-0.5 rounded-full text-xs font-bold">{{ $retailer->warranties_count }}</span></td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $retailer->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $retailer->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end gap-1">
                            <a href="{{ route('admin.retailers.edit', $retailer) }}" class="p-2 text-warm-600 hover:bg-warm-100 rounded-lg transition-colors" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.retailers.toggle', $retailer) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2 {{ $retailer->is_active ? 'text-red-500 hover:bg-red-50' : 'text-green-600 hover:bg-green-50' }} rounded-lg transition-colors" title="{{ $retailer->is_active ? 'Deactivate' : 'Activate' }}">
                                    @if($retailer->is_active)
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    @else
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    @endif
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="px-6 py-12 text-center text-warm-500">No retailers yet. <a href="{{ route('admin.retailers.create') }}" class="text-accent-600 hover:underline font-medium">Add one to get started!</a></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($retailers->hasPages())
    <div class="px-6 py-4 border-t border-warm-200">{{ $retailers->links() }}</div>
    @endif
</div>
@endsection
