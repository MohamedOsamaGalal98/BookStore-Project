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
			 @foreach($cartitems as $item)
			 <div class="col-sm-4">
			   <div class="card">
			   <img  height="240" width="280" src="{{asset('images/' . $item->image) }}" class="card-img-top" alt="...">
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
				 <p class="card-text">Discount:{{ $item->discount_text }} </p>
                 <p class="card-text">quantity: {{$item->pivot->quantity}}</p>

				 <form method='POST' action="{{url('/cart/' . $item->id)}}" style="display: inline;">
				 	@csrf
   				 <button type="submit" class="btn btn-danger">Drop Item</button>
				 </form>

			    </div>
			   </div>
			  </div>
			  	@endforeach
			 </div>
			<br>
			 <form method="POST"  action="" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<div class="row">
						<div class="col-md-8">
							<input type="text" name='copon' value="{{old('copon', $discount->code ?? null) }}" class="form-control" placeholder="Insert Copoun" >
						</div>
						<div class="col-md-4">
							<input type="submit"  class="form-control">
						</div>
					</div>
				</div>
			</form>

			<h5 class="card-title" >Total Price: {{$total_price}}</h5>
			<h5 class="card-title" >Total Quantity: {{$total_quantity}}</h5>


			</div> 
		</body>
	</head>
	
@stop