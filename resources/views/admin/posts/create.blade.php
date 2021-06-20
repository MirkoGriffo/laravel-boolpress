@extends('layouts.app')

@section('content')
<div class="container">
<h1 class="mb-5">Create new post</h1>

<div class="row">
    <div class="col-md-8 offset-md-2">
        <form action="{{ route('admin.posts.store') }}" method="POST">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="title" class="form-label">Title *</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ old('title')}}">
            @error('title')
            <div class="feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content *</label>
            <textarea class="form-control @error('title') is-invalid @enderror" name="content" id="content" rows="6">{{ old('content')}}</textarea>
            @error('content')
            <div class="feedback">{{ $message }}</div>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Create post</button>
    </form>
    </div>
</div>
</div>
@endsection