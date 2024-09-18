@extends('layouts.app')


@section('content')

@if(Session::has('message'))
<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif


<title>Home Bage</title>
	</head>
		<body>
			<div class="container">
            <?php


 $total_price=0; $total_quantity=0; ?>

			 <div class="row">
			 @foreach($cartitems as $item)
			 <div class="col-sm-4">
			   <div class="card" style="width: 18rem; ">
			   <img src="{{asset('images/' . $item->image) }}" class="card-img-top" alt="...">
			    <div class="card-body">
			     <a href="{{url('/books/' . $item->id)}}"><h5 class="card-title" >{{$item->title}}</h5></a>
				 <h6 class="card-subtitle mb-2 text-muted">Department: {{$item->department->name}} </h6>
			     <h6 class="card-subtitle mb-2 text-muted">
				Book Author:
				 @foreach($item->authors as $author)
				 {{$author->name}}
				 @if(!$loop->last)
				 -
				 @endif
				 @endforeach
				 </h6>
			     <p class="card-text">Published At: {{$item->published_at}}</p>
			     <p class="card-text">Pages: {{$item->pages}}</p>
				 <p class="card-text">Price: {{$item->price}}</p>

				 <?php 
				 $discount =  $item->discount()->first();
				 ?>
				 @if($discount == null)
				 <p class="card-text">Discount: No Discount Available For This Item </p>

				 <p class="card-text">Price After Discount: {{$price_after_discount = $item->price}} EGY</p>
				 @elseif($discount->type == 'percentage')
				 <p class="card-text">Discount: {{$discount->value }} %</p>

				 <p class="card-text">Price After Discount: {{$price_after_discount = $item->price -  ( $item->price * ($discount->value/100) ) }} EGY</p>

				 @elseif($discount->type == 'numeric')
				 <p class="card-text">Discount: {{$discount->value }} EGY</p>

				 <p class="card-text">Price After Discount: {{$price_after_discount = $item->price -  $discount->value }} EGY</p>
				
				 @endif
				<?php
					$cartbook = $cartbooks
					 ->where('book_id', ($item->id))
					 ->first();
				?>
                 <p class="card-text">quantity: {{$cartbook->quantity}}</p>

				 
                 <?php $total_price = ($total_price + ( $price_after_discount * $cartbook->quantity) ); 
                 $total_quantity = ($total_quantity + ($cartbook->quantity)); 
				 ?>


				 <form method='POST' action="{{url('/cart/' . $item->id)}}" style="display: inline;">
				 	@csrf
   				 <button type="submit" class="btn btn-danger">Drop Item</button>
				 </form>

			    </div>
			   </div>
			  </div>
			  	@endforeach
			 </div>


             <h5 class="card-title" >Total Price: {{$total_price}}</h5>
             <h5 class="card-title" >Total Quantity: {{$total_quantity}}</h5>


			</div> 
		</body>
	</head>
	
@stop