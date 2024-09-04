@extends('layout')


@section('content')
<form method="POST"  action="{{url('/books/' . $book->id)}}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="form-group">
    <label for="exampleFormControlInput1">Book Title</label>
    <input type="text" name='title' class="form-control" value="{{$book->title}}">
  </div>

  <div class="form-group">
        <label for="exampleFormControlInput1">Image</label>
        <input type="file" name='image' class="form-control" >
  </div>


  <div class="form-group">
    <label for="exampleFormControlSelect1">Book Department:</label>
    <label for="exampleFormControlInput2">{{$book->department->name}} </label>
        <select class="form-control" id="exampleFormControlSelect1" name="department_id">
            @foreach ($departments as $department)
            <option value="{{$department->id}}">{{$department->name}}</option>
            @endforeach   
        </select>
  </div>



  <div class="form-group">
    <label for="exampleFormControlInput2">Book Autors:</label>
      <label for="exampleFormControlInput2">
       @foreach($book->authors as $author)
       {{$author->name}}
       @if(!$loop->last)
			 -
			 @endif
			 @endforeach
        </label>
    <select class="form-control" id="exampleFormControlSelect1" multiple="multiple" name="author_list[]">
      @foreach ($authors as $author)
      <option value="{{$author->id}}">{{$author->name}}</option>
      @endforeach   
    </select>
  </div>


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