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
         {{-- Tags --}}
         <h4>Tags</h4>
         <div class="mb-3">
             @foreach ($tags as $tag)
                 <span class="d-inline-block mr-3">
                     <input type="checkbox" name="tags[]" id="tag{{ $loop->iteration }}" value="{{ $tag->id }}" 
                     @if ($errors->any() && in_array($tag->id, old('tags')))
                       checked  
                       @elseif (!$errors->any() && $post->tags->contains($tag->id))
                       checked
                     @endif
                     >
                     <label for="tag{{ $loop->iteration }}"></label>
                     {{ $tag->name }}
                 </span>
             @endforeach
             @error('tags')
             <div>
                 {{ $message }}
             </div>
                 
             @enderror
         </div>
        
        <button class="btn btn-primary" type="submit">Update post</button>
    </form>
    </div>
</div>
</div>
@endsection