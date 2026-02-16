@extends('layouts.admin')
@section('title', 'Pages')
@section('page_title', 'CMS Pages')

@section('content')
<p class="text-warm-400 text-sm mb-6">Manage your website pages content</p>

<div class="card overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-warm-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Page Title</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Slug</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-warm-500 uppercase tracking-wider">Updated</th>
                <th class="px-6 py-3 text-right text-xs font-semibold text-warm-500 uppercase tracking-wider">Action</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-warm-100">
            @forelse($pages as $page)
                <tr class="hover:bg-warm-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-warm-700">{{ $page->title }}</td>
                    <td class="px-6 py-4 text-warm-400 font-mono text-xs">{{ $page->slug }}</td>
                    <td class="px-6 py-4 text-warm-400">{{ $page->updated_at->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.pages.edit', $page) }}" class="text-accent-600 hover:text-accent-700 text-sm font-medium">Edit →</a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-6 py-12 text-center text-warm-400">No pages found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
