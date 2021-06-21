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
                    <th colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
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
    </div>
@endsection