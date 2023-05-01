@extends('layouts.admin')

@section('content')
<div class="container">
    Access token: {{ Auth::user()->createToken('access')->plainTextToken }}
    <category-table></category-table>
</div>
@endsection