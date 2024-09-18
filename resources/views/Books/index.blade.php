@extends('layouts.app')


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
				
				 <?php 
				 $discount =  $book->discount()->first();
				 //dd($discount);
				 ?>
				 @if($discount == null)
				 <p class="card-text">Discount: No Discount Available For This Item </p>

				 <p class="card-text">Price After Discount: {{$price_after_discount = $book->price}} EGY</p>
				 @elseif($discount->type == 'percentage')
				 <p class="card-text">Discount: {{$discount->value }} %</p>

				 <p class="card-text">Price After Discount: {{$price_after_discount = $book->price -  ( $book->price * ($discount->value/100) ) }} EGY</p>

				 @elseif($discount->type == 'numeric')
				 <p class="card-text">Discount: {{$discount->value }} EGY</p>

				 <p class="card-text">Price After Discount: {{$price_after_discount = $book->price -  $discount->value }} EGY</p>
				
				 @endif
				


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
			</div> 
		</body>
	</head>
	
@stop