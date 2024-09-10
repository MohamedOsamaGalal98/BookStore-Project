@extends('layouts.app')


@section('content')

@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif


<title>Home Bage</title>
	</head>
		<body>
				 @foreach($authors as $author)
			 	<div class="card" style="width: 18rem; ">
				 <div class="card-body">
				 <h6 class="card-subtitle mb-2 text-muted">{{$author->name}}  ({{$author->books_count}})</h6>
				 @foreach($author->books as $book)
			     <h5 class="card-title" >{{$book->title}}</h5>
			 	@endforeach
				</div>
			</div> 
			@endforeach
			</body>
	</head>
	
@stop		

