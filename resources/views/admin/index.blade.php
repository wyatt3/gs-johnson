@extends('layouts.admin')

@section('content')
<h1>Admin</h1>
@if(file_exists(public_path('/storage/GracieJohnson.pdf')))
<h2>Resume</h2>
<iframe class="w-100 mb-3" src="{{ asset('/storage/GracieJohnson.pdf') }}" frameborder="0" style="height: 70vw"></iframe>
@endif
<h3>Upload New Resume</h3>
<form class="form-group" action="{{ route('admin.resume.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input class="mt-3 form-control" name="resume" type="file">
    <input class="btn btn-primary mt-3" type="submit" value="Upload">
</form>

<h2>Social Links</h2>

<h3>Left Side</h3>

<h3>Right Side</h3>
@endsection