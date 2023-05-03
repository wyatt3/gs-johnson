@extends('layouts.admin')

@section('content')
<h1 class="text-gold-main">Projects</h1>
<a class="btn btn-primary" href="{{ route('admin.projects.create') }}">Create Project</a>
<projects></projects>
@endsection