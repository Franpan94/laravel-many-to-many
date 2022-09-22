@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('edit'))
               <div class="alert alert-success m-3">
                   <span>{{ session('edit') }}</span>
               </div>   
            @endif
            @if (session('create'))
               <div class="alert alert-primary m-3">
                   <span>{{ session('create') }}</span>
               </div> 
            @endif
            <div class="col-12 text-center">
                <h1 class="pt-2">{{ $post->title }}</h1>
                <img src="{{ $post->post_image }}" alt="{{ $post->title }}">
                <h4 class="p-3">{{ $post->post_content }}</h4>
                <h5 class="pb-3">Caricato il: {{ $post->post_date }} da: 
                    {{ $post->user->name }} tag: 
                    @forelse ($post->tags as $tag)
                        {{ $tag->name }}
                    @empty
                       Non ci sono tag 
                    @endforelse
                
                </h5>
                <form action="{{ route('admin.posts.edit', $post->id) }}" method="GET" class="d-inline">
                    <button class="btn btn-success text-monospace">Modifica</button>
                    @csrf
                </form>
                <form action="{{ route('admin.posts.destroy', $post->id) }}" class="d-inline" method="POST">
                    <button class="btn btn-danger text-monospace">Elimina</button>
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection
