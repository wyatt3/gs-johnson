@extends('layouts.app')

@section('content')
@include('partials.header')
<div class="homepage-divider bg-primary"></div>
<carousel :categories="{{ $categories }}"></carousel>
<footer class="bg-secondary d-flex justify-content-center py-2">
    <div class="footer-divider"></div>
    @foreach($footerLinks as $link)
    <a href="{{ $link->url }}" download class="footer-link footer-link-center">{{ $link->name }}</a>
    <div class="footer-divider"></div>
    @endforeach
</footer>
@endsection
