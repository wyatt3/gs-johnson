@extends('layouts.app')

@section('content')
<div class="content">
    <category-section></category-section>
</div>
<footer class="bg-primary d-flex justify-content-center py-2">
    <div class="footer-divider"></div>
    @foreach($footerLinks as $link)
    <a href="{{ $link->url }}" download class="footer-link footer-link-center">{{ $link->name }}</a>
    <div class="footer-divider"></div>
    @endforeach
</footer>
@endsection
