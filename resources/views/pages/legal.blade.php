@extends('layouts.app')
@section('title', $title . ' - Lenz Breeze')

@section('content')
<section class="gradient-brand py-16">
    <div class="container-custom">
        <h1 class="font-display text-4xl font-bold text-white">{{ $title }}</h1>
    </div>
</section>
<section class="section-padding bg-white">
    <div class="container-custom">
        <div class="max-w-3xl mx-auto prose prose-warm prose-headings:font-display prose-headings:text-brand-500 prose-a:text-accent-600">
            @if($page)
                {!! $page->content !!}
            @else
                <p>This page content is being updated. Please check back later.</p>
            @endif
        </div>
    </div>
</section>
@endsection
