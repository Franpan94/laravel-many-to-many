@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
               @include('admin.posts.form.editcreate', [
                'routename'=> 'admin.posts.store',
                'method'=> 'POST',
               ])
               
            </div>
        </div>
    </div>
@endsection