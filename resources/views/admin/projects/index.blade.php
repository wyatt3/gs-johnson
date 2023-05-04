@extends('layouts.admin')

@section('content')
<h1>Projects</h1>
<a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Create Project</a>
<projects></projects>
@endsection