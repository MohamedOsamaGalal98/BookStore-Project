@extends('layout')


@section('content')

<div class="container">

  <form method="POST"  action="{{url('/books')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlInput1">Book Title</label>
        <input type="text" name='title' class="form-control" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput1">Image</label>
        <input type="file" name='image' class="form-control" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Book Department:</label>
        <select class="form-control" id="exampleFormControlSelect1" name="department_id">
              @foreach ($departments as $department)
              <option value="{{$department->id}}">{{$department->name}}</option>
              @endforeach   
        </select>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Book Autors:</label>
        <select class="form-control" id="exampleFormControlSelect1" multiple="multiple" name="author_list[]">
              @foreach ($authors as $author)
              <option value="{{$author->id}}">{{$author->name}}</option>
              @endforeach   
        </select>
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