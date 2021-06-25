@extends('layouts.app')

@section('content')
    <div class="container">

        @if (session('deleted'))
            <div class="alert alert-success">
                <strong>{{ session('deleted') }}</strong>
                deleted successfully
            </div>
        @endif

        <h1>Our Posts</h1>
        <a class="btn btn-primary" href="{{ route('admin.posts.create') }}">Create new post</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Create</th>
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>@if($item->category) {{ $item->category->name }} @endif</td>
                        
                        <td><div>{{ $item->created_at->format('l d/m/y') }}</div>
                       <div> {{ $item->created_at->diffForHumans() }}</div>
                    </td>
                    
                        <td><a class="btn btn-success" href="{{ route('admin.posts.show' , $item->id) }}">SHOW</a></td>
                        <td><a class="btn btn-warning" href="{{ route('admin.posts.edit' , $item->id) }}">EDIT</a></td>
                        <td>
                            <form class="delete-post-form" action="{{ route('admin.posts.destroy', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                           

                            <input class="btn btn-danger" type="submit" value="DELETE"> 
                        </form>
                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
        <h2 class="mb-3">Posts by Category</h2>
        @foreach ($categories as $item)
            <div class="category mb-3">
                <h3>{{ $item->name }}</h3>
                @forelse ($item->posts as $post )
                    <a href="{{ route('admin.posts.show', $post->id) }}"> {{ $post->title }}</a> <br>
                @empty
                    No posts in this category...<a href="{{ route('admin.posts.create') }}">Create the first post!</a>
                @endforelse
            </div>
        @endforeach
    </div>
@endsection