@extends('layouts.app')


@section('content')

@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif


<title>Home Bage</title>
	</head>
		<body>
			<div class="container">
			
			@foreach($books->chunk(3) as $chunk)
				<div class="row">
					@foreach($chunk as $book)
						<div class="col-sm-4">
							<div class="card" style="width: 18rem; ">
								<img height="240" width="280" src="{{asset('images/' . $book->image) }}" class="card-img-top" alt="...">
								<div class="card-body">
									<a href="{{url('/books/' . $book->id)}}"><h5 class="card-title" >{{$book->title}}</h5></a>
									<h6 class="card-subtitle mb-2 text-muted">Department: {{$book->department->name}} </h6>
									<h6 class="card-subtitle mb-2 text-muted">
										Book Author:
										@foreach($book->authors as $author)
											{{$author->name}}
											@if(!$loop->last)
												-
											@endif
										@endforeach
									</h6>
									<p class="card-text">Published At: {{$book->published_at}}</p>
									<p class="card-text">Pages: {{$book->pages}}</p>
									<p class="card-text">Price: {{$book->price}}</p>

								
									 <p class="card-text">Discount: {{ $book->discount_text }} </p> 

									<a href="{{url('cart/'. $book->id)}}">
										<button class="addtocart">
											<div class="pretext">
												<i class="fas fa-cart-plus"></i>ADD TO CART</div>
											<div class="pretext done">
												<div class="posttext"><i class="fas fa-check"></i>ADDED</div>
											</div>
										</button>
									</a>

									<p style="margin-bottom: 10px;"></p>

									<a class='btn btn-info' href="{{url('/books/' . $book->id. '/edit')}}">Edit</a>
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
				<br>
			@endforeach
			</div> 
		</body>
	</head>
	
@stop