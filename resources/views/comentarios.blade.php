@extends('layouts.app')

@section('content')

<div class="row">

	@foreach($comentarios as $comentario)
	<div class="col-md-4 col-sm-12 mb-4">
		<div class="card shadow border-0">
		  <div class="card-body">
		  	<h5 class="card-title mb-0">{{$comentario['nome']}}</h5>
		    <div class="mb-2">
		    	<small>{{$comentario['data']}}</small>
		    </div>
		    <p class="card-text card-comentario">{{$comentario['comentario']}}</p>
		  </div>
		</div>
	</div>
	@endforeach
</div>

@endsection
