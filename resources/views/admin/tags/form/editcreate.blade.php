<form action="{{ route($routename, $tag->id) }}" method="POST">
  @csrf
  @method($method)
    <input type="text" name="name" id="name" 
      placeholder="Inserisci nome tag" required class="w-50"
      value="{{ old('name', $tag->name) }}"
    >
    @error('name')
      <div class="alert alert-danger">
        <span>{{ $message }}</span>
      </div>
    @enderror
    <button class="btn btn-primary">Invia</button>
</form>