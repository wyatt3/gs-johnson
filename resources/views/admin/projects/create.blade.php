@extends('layouts.admin')

@section('content')
<a class="btn btn-outline-gold-main" href="{{ route('admin.projects.index') }}">&larr; Back to Projects</a>

@if ($errors->any())
<div class="alert alert-danger mt-3">
    @foreach ($errors->all() as $error)
    <div>{{$error}}</div>
    @endforeach
</div>
@endif
<form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="mt-2 mb-1" for="category">Project Category</label>
    <select class="form-control" id="category" name="category_id">
        <option value="">Select a category</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
    <label class="mt-2 mb-1" for="title">Project Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Enter project title" value="{{ old('title') }}">
    <!-- <label class="mt-2 mb-1" for="description">Project Description</label> -->
    <!-- <textarea class="form-control bg-primary text-gold-secondary" id="description" name="description" rows="8" placeholder="Enter project description">{{ old('description') }}</textarea> -->
    <label class="mt-2 mb-1" for="images">Project Media</label>
    <file-upload></file-upload>
    <input type="submit" class="btn btn-gold-main mt-2" value="Create Project">
</form>
@endsection