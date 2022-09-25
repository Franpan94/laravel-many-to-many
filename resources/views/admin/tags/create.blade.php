@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
        <div class="col-12">
            @include('admin.tags.form.editcreate', [
                'routename'=>'admin.tags.store',
                'method'=>'POST'
            ])
        </div>
    </div>
  </div>
@endsection