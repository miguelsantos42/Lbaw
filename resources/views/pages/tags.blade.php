@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tags</h1>
        
        <form action="{{ route('tags.search') }}" method="GET"> 
            <input type="text" name="search" class="form-control" placeholder="Filter by tag name" value="{{ request()->query('search') }}">
            <button type="submit">Search</button>
        </form>

        <a href="{{ route('tags.create') }}" class="btn btn-primary">New Tag</a>

        
        <div class="row mt-3">
            @foreach($tags as $tag)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tag->tagName }}</h5>
                            <a href="{{ route('tags.show', ['tag' => $tag->id]) }}" class="btn btn-primary">View Posts</a>
                            <a href="{{ route('tags.edit', ['tag' => $tag->id]) }}" class="btn btn-secondary">Edit</a>    <!-- Se for Admin -->
                            <form action="{{ route('tags.destroy', ['tag' => $tag->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
