@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <div class="mb-5">
        <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Edit post</a>
    </div>
    <p>{{ $post->content }}</p>

    {{-- Post Tags --}}
    @if (count($post->tags) > 0)
        <h4>Tags</h4>
        @foreach ($post->tags as $item)
            <span class="badge badge-primary"> {{ $item->name }}</span>
        @endforeach
    @endif
</div>
@endsection

