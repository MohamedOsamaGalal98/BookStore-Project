@extends('layout')


@section('content')

<div class="container">

  <form method="POST"  action="{{url('/books')}}">
    @csrf
    <div class="form-group">
      <label for="exampleFormControlInput1">Book Title</label>
      <input type="text" name='title' class="form-control" >
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput2">Book Autor</label>
      <input type="text"  name='author' class="form-control">
      </input>
    </div>
    <div class="form-group">
      <label for="exampleFormControlInput3">Number Of Pages</label>
       <input type="text"  name='pages' class="form-control">
      </input>
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Published At</label>
      <input type="text"  name='published_at' class="form-control">
      </input> 
    </div>
     <div class="form-group">
      <label for="exampleFormControlTextarea1">Submit</label>
      <input type="submit"  class="form-control">
      </input> 
    </div>
  </form>
</div>

      @if ($errors->any())
          <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        @endif


@stop