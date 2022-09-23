@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row text-center">
    <div class="col-12">
      @if (session('delete'))
        <div class="alert alert-danger">
          <span>{{ session('delete') }}</span>
        </div>
      @endif
      @if (session('create'))
        <div class="alert alert-primary m-3">
          <span>{{ session('create') }}</span>
        </div> 
      @endif
      @if (session('edit'))
        <div class="alert alert-success m-3">
          <span>{{ session('edit') }}</span>
        </div>   
      @endif
      <table class="table table-striped table-dark">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Titolo</th>
            <th scope="col">UserName</th>
            <th scope="col">Tag</th>
            <th scope="col">UserId</th>
            <th scope="col">Modifica/Elimina</th>
          </tr>
        </thead>
        @forelse ($posts as $post)
          <tbody>
            <tr>
              <th scope="row">{{ $post->id }}</th>
              <td><a href="{{ route('admin.posts.show', $post->id) }}">{{ $post->title }}</a></td>
              <td>{{ $post->user->name }}</td>
              <td>
                 @forelse ($post->tags as $tag )
                   #{{ $tag->name }}
                 @empty
                   nessun tag
                 @endforelse
              </td>
              <td>{{ $post->user_id }}</td>
              <td>
                <form action="{{ route('admin.posts.edit', $post->id) }}" method="GET" class="d-inline">
                  <button class="btn btn-success text-monospace">Modifica</button>
                  @csrf
                </form>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline">
                  <button class="btn btn-danger text-monospace">Elimina</button>
                  @csrf
                  @method('DELETE')
                </form>
              </td>
            </tr>
          </tbody>
        @empty
          <div class="col-12">
            <h1>Non ci sono Post</h1>  
          </div>  
        @endforelse
      </table>
    </div>
  </div>
</div>
@endsection