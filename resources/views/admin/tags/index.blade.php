@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-12">
          @if (session('createTag'))
            <div class="alert alert-primary">
              <span>#{{ session('createTag') }}</span>
            </div>
          @endif
          @if (session('editTag'))
            <div class="alert alert-success">
              <span>#{{ session('editTag') }}</span>
            </div>
          @endif
          @if (session('deleteTag'))
            <div class="alert alert-danger">
              <span>#{{ session('deleteTag') }}</span>  
            </div>  
          @endif
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">HashTag</th>
                    <th scope="col">Nome tag</th>
                    <th scope="col">Modifica/Elimina</th>
                  </tr>
                </thead>
                @forelse ($tags as $tag)
                <tr>
                    <th scope="row">{{ $tag->id }}</th>
                    <td>#</td>
                    <td><a class="ms_a_tags" href="{{ route('admin.tags.show', $tag->id) }}">#{{ $tag->name }}</a></td>
                    <td>
                      <form action="{{ route('admin.tags.edit', $tag->id) }}" method="GET" class="d-inline">
                        @csrf
                        <button class="btn btn-success">Modifica</button>
                      </form>
                      <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Elimina</button>
                      </form>
                    </td>
                  </tr>
                @empty
                    Non sono presenti tag
                @endforelse
                
            </table>
              
        </div>
    </div>
  </div>
@endsection