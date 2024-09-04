@extends('layout')


@section('content')

<div class="container">
  <form method="POST"  action="{{url('/departments')}}">
    @csrf
    <div class="form-group">
        <label for="exampleFormControlInput1">New Book Department Name:</label>
        <input type="text" name='name' class="form-control" >
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