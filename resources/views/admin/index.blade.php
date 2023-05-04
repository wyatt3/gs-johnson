@extends('layouts.admin')

@section('content')
<h1>Admin</h1>
<div class="resume mb-4">
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
</div>
<div class="social-links">
    <h2 class="mb-3">Social Links</h2>

    <div class="d-flex justify-content-evenly">
        <div class="left-side">
            <h3 class="text-center">Left Side</h3>
            <form action="{{ route('admin.social.update') }}" method="POST">
                <input type="hidden" name="filename" value="left">
                <label>Displayed Name</label>
                <input class="form-control mb-2" type="text" name="displayName" placeholder="Displayed Name" value="{{ $left['displayName'] ?? '' }}">
                <label>URL</label>
                <input class=" form-control mb-2" type="text" name="url" placeholder="URL" value="{{ $left['url'] ?? '' }}">
                <input class="btn btn-primary" type="submit" value="Update">
            </form>
        </div>
        <div class="right-side">
            <h3 class="text-center">Right Side</h3>
            <form action="{{ route('admin.social.update') }}" method="POST">
                <input type="hidden" name="filename" value="right">
                <label>Displayed Name</label>
                <input class="form-control mb-2" type="text" name="displayName" placeholder="Displayed Name" value="{{ $right['displayName'] ?? '' }}">
                <label>URL</label>
                <input class="form-control mb-2" type="text" name="url" placeholder="URL" value="{{ $right['url'] ?? '' }}">
                <input class="btn btn-primary" type="submit" value="Update">
            </form>
        </div>
    </div>

</div>
@endsection