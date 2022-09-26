@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="pt-2">{{ $post->title }}</h1>
                <img src="{{ asset('/storage' . '/' . $post->post_image)}}" alt="{{ $post->title }}">
                <h4 class="p-3">{{ $post->post_content }}</h4>
                <h5 class="pb-3">Caricato il: {{ $post->post_date }} <br> Utente: 
                    {{ $post->user->name }} <br> Tag: 
                    @forelse ($post->tags as $tag)
                        #{{ $tag->name }}
                    @empty
                       Nessun tag 
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
