@extends('layout')


@section('content')


    @foreach($departments as $department)

		<div class="card" style="width: 18rem;">
		 <div class="card-body">
			<h5 class="card-title">{{$department->name}}</h5>
		 </div>
		</div>
    @endforeach



@stop