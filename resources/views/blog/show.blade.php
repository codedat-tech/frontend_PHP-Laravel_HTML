@extends('layouts.index')
@section('content')
    <div class="container">
        <h1>{{ $blog->title }}</h1>
        <img src="{{ asset('asset/image/' . $blog->image) }}" alt="{{ $blog->title }}" style="width: 100%;">
        <p>{{ $blog->description }}</p>
        <a href="{{ route('blog.index') }}">Back to Blog</a>
    </div>
@endsection
