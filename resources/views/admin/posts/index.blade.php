@extends('layouts.app')

@section('content')
    <div class="container">
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
                        <td>DELETE</td>
                    </tr>

                @endforeach
            </tbody>
        </table>
    </div>
@endsection