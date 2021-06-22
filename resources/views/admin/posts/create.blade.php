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
        <div class="mb-3">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id">
                <option value="">-- Select category --</option>
                @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                 @if ($item->id == old('category_id')) selected @endif>
                    {{ $item->name }}
                </option>
                @endforeach
            </select>
        </div>
        <button class="btn btn-primary" type="submit">Create post</button>
    </form>
    </div>
</div>
</div>
@endsection