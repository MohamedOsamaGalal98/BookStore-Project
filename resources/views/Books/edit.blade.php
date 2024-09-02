@extends('layout')


@section('content')
<form method="POST"  action="{{url('/books/' . $book->id)}}">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="exampleFormControlInput1">Book Title</label>
    <input type="text" name='title' class="form-control" value="{{$book->title}}">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput2">Book Autor</label>
    <input type="text"  name='author' class="form-control" value="{{$book->author}}">
    </input>
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput3">Number Of Pages</label>
     <input type="text"  name='pages' class="form-control" value="{{$book->pages}}">
    </input>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Published At</label>
    <input type="text"  name='published_at' class="form-control" value="{{$book->published_at}}">
    </input> 
  </div>
   <div class="form-group">
    <label for="exampleFormControlTextarea1">Submit</label>
    <input type="submit"  class="form-control">
    </input> 
  </div>
</form>


@stop