@extends('layouts.admin')

@section('content')
<h1>Admin</h1>
@if ($errors->any())
<div class="alert alert-danger mt-3">
    @foreach ($errors->all() as $error)
    <div>{{$error}}</div>
    @endforeach
</div>
@endif

@endsection
