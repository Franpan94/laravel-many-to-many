@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h3 class="pt-2">Tutti i post dove è presente il tag: #{{ $tag->name }}</h3>
            @forelse ($tag->posts as $post)
            <h1 class="pt-3">{{ $post->title }}</h1>
            <img src="{{ $post->post_image }}" alt="{{ $post->title }}">
            <h4 class="p-3">{{ $post->post_content }}</h4>
            <h5 class="pb-3">Caricato il: {{ $post->post_date }} <br> Utente: 
                {{ $post->user->name }} <br> Tag: 
                @forelse ($post->tags as $tag)
                    #{{ $tag->name }}
                @empty
                   Nessun tag 
                @endforelse
            </h5> 
            @empty
                Non ci sono tag appasrtenenti a questo post
            @endforelse
        </div>
    </div>
  </div>
@endsection