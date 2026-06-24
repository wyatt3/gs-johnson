@extends('layouts.app')

@section('content')
@include('partials.header')
<div class="homepage-divider bg-primary"></div>
<div class="content">
    <!-- category carousel-->
</div>
<footer class="bg-primary d-flex justify-content-center py-2">
    <div class="footer-divider"></div>
    @foreach($footerLinks as $link)
    <a href="{{ $link->url }}" download class="footer-link footer-link-center">{{ $link->name }}</a>
    <div class="footer-divider"></div>
    @endforeach
</footer>
@endsection
