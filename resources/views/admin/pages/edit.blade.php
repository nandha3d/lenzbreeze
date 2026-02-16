@extends('layouts.admin')
@section('title', 'Edit: ' . $page->title)
@section('page_title', 'Edit Page: ' . $page->title)

@section('content')
<div class="max-w-3xl">
    <a href="{{ route('admin.pages') }}" class="text-sm text-warm-400 hover:text-brand-500 flex items-center gap-1 mb-6">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Back to Pages
    </a>

    <form action="{{ route('admin.pages.update', $page) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="card p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Page Title</label>
                <input type="text" name="title" value="{{ old('title', $page->title) }}" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Content (HTML supported)</label>
                <textarea name="content" rows="20" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all font-mono text-sm">{{ old('content', $page->content) }}</textarea>
            </div>
        </div>

        <div class="card p-6 space-y-5">
            <h2 class="font-display font-semibold text-warm-700 border-b border-warm-100 pb-3">SEO</h2>
            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Meta Title</label>
                <input type="text" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-warm-700 mb-1.5">Meta Description</label>
                <textarea name="meta_description" rows="2" class="w-full px-4 py-3 rounded-lg border border-warm-300 focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 outline-none transition-all resize-none">{{ old('meta_description', $page->meta_description) }}</textarea>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn-primary">Save Changes</button>
            <a href="{{ route('admin.pages') }}" class="btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
