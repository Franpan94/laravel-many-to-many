<form action="{{ route($routename, $post->id) }}" method="POST" enctype="multipart/form-data">
  @method($method)
  @csrf

  <div class="p-4">
    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}"
      placeholder="Inserisci titolo" required class="w-50"
    >
    @error('title')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="p-4">
    <div class="pb-1">
      <span>Inserisci copertina</span>
    </div>
    <input type="file" name="post_image" id="post_image"  
      required value="{{ old('post_image', $post->post_image) }} "  
    >
    @error('post_image')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="p-4">
    <textarea name="post_content" id="post_content" cols="80" rows="10" required
      placeholder="Inserisci descrizione">
      {{ old('post_content', $post->post_content) }} 
    </textarea>
    @error('post_content')
      <div class="alert alert-danger">{{ $message }}</div>
    @enderror
  </div>
  @foreach ($tags as $tag)
    <div class="p-2">
      @if ($errors->any())
        <input type="checkbox" name="tags[]" id="tags" value="{{ $tag->id }}"
        {{ in_array($tag->id, old('tags', [])) ? 'checked' : ''}}>
        #{{ $tag->name }}
      @else
        <input type="checkbox" name="tags[]" id="tags" value="{{ $tag->id }}"
        {{ $post->tags->contains($tag) ? 'checked' : '' }}>
        #{{ $tag->name }}
      @endif
    </div>
  @endforeach
  <div class="p-4">
    <button class="btn btn-primary">
      Invia
    </button>
  </div>
</form>
