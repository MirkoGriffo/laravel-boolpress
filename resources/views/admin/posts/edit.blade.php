@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="mb-5">EDIT:
    <a href="{{ route('admin.posts.show', $post->id)}}">{{ $post->title}}</a>
</h1>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="title" class="form-label">Title *</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title', $post->title)}}">
            @error('title')
            <div class="feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content *</label>
            <textarea class="form-control @error('title') is-invalid @enderror" name="content" id="content" rows="6">{{ old('content', $post->content)}}</textarea>
            @error('content')
            <div class="feedback">{{$message}}</div>
            @enderror
        </div>
        
        
        <button class="btn btn-primary" type="submit">Update post</button>
    </form>
    </div>
</div>
</div>
@endsection