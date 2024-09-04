@extends('layout')


@section('content')

<title>Home Bage</title>
	</head>
		<body>
			   <div class="card" style="width: 18rem;">
			   <img src="{{asset('images/' . $book->image) }}" class="card-img-top" alt="...">
			    <div class="card-body">
			     <h5 class="card-title">{{$book->title}}</h5>
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
			    </div>
			   </div>



@stop