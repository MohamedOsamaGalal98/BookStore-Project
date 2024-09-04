@extends('layout')


@section('content')

@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif


<title>Home Bage</title>
	</head>
		<body>
			<div class="container">
			 <div class="row">
			 	@foreach($books as $book)
  			  <div class="col-sm-4">
			   <div class="card" style="width: 18rem; ">
			   <img src="{{asset('images/' . $book->image) }}" class="card-img-top" alt="...">
			    <div class="card-body">
			     <a href="{{url('/books/' . $book->id)}}"><h5 class="card-title" >{{$book->title}}</h5></a>
				 <h6 class="card-subtitle mb-2 text-muted">	{{$book->department->name}} </h6>
			     <h6 class="card-subtitle mb-2 text-muted">
				 @foreach($book->authors as $author)
				 {{$author->name}}
				 @if(!$loop->last)
				 -
				 @endif
				 @endforeach
				 </h6>
			     <p class="card-text">{{$book->published_at}}</p>
			     <p class="card-text">{{$book->pages}}</p>
			     <p class="card-text">7mada</p>
				 <a href="{{url('/books/' . $book->id. '/edit')}}"><button type="button" class="btn btn-primary">Edit</button></a>
				 <form method='POST' action="{{url('/books/' . $book->id)}}" style="display: inline;">
				 	  @csrf
				 	@method('DELETE')
   				 <button type="submit" class="btn btn-danger">Delete</button>
				 </form>

			    </div>
			   </div>
			  </div>
			  	@endforeach
			 </div>
			</div> 
		</body>
	</head>
	
@stop