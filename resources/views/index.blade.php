@extends('layouts.app')

@section('content')
<header class="bg-secondary text-gold-main text-center pb-3">
    <img width="100%" src="{{ asset('img/ornament.png') }}" aria-hidden>
    <h1 class="title">Gracie Johnson</h1>
    <span class="subtitle">Design Portfolio</span>
    <img width="100%" class="ornament-bottom" src="{{ asset('img/ornament.png') }}" aria-hidden>
</header>
<div class="content">
    <category-section></category-section>
</div>
<footer class="bg-primary d-flex justify-content-center py-2">
    @if($left)
    <a href="{{ $left->url }}" target="_blank" class="footer-link footer-link-outer footer-link-left">{{ $left->displayName }}</a>
    <div class="footer-divider"></div>
    @endif
    <a href="{{ asset('storage/GracieJohnson.pdf') }}" download class="footer-link footer-link-center"><span class="download-my">Download my</span><span class="my">My</span> Resume</a>
    @if($right)
    <div class="footer-divider"></div>
    <a href="{{ $right->url }}" target="_blank" class="footer-link footer-link-outer footer-link-right">{{ $right->displayName }}</a>
    @endif
</footer>
@endsection