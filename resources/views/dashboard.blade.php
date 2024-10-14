
@extends('admin.layout.index')
@section('content')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    {{-- @include('layouts.sidebar') --}}
<h1>Welcome to Admin</h1>
@endsection

