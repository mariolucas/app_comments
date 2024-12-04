@extends('layouts.app')

@section('content')

<div class="row">
	<h1 class="mb-5">
		<i class="bi bi-chat-right-dots-fill"></i> Meus comentários
	</h1>
	@foreach($comentarios as $comentario)
	<div class="col-md-4 col-sm-12 mb-4">
		<div class="card shadow border-0">
		  <div class="card-body">

		  	<div class="row">
		  		<div class="col-6">
		  			<h5 class="card-title mb-0">{{$comentario['nome']}}</h5>
		  		</div>
		  		<div class="col-6 d-flex justify-content-end">
		  			<a class="nav-link" href="#" data-bs-toggle="modal" onclick="carregaComentario({{$comentario['id']}})" data-bs-target="#modalEditComentario">
			  			<i class="bi bi-pencil-fill"></i>
			  		</a>
			  		<a href="/deleta-comentario/{{$comentario['id']}}" class="nav-link ms-3">
			  			<i class="bi bi-trash3-fill "></i>
			  		</a>
		  		</div>
		  	</div>
		  	
		    <div class="mb-2">
		    	<small>Criação: {{$comentario['data_criacao']}}</small>
		    	@if( $comentario['data_criacao'] != $comentario['data_atualizacao'])
		    	 / <small>Edição: {{$comentario['data_atualizacao']}}</small>
		    	@endif
		    </div>
		    <p class="card-text card-comentario" id="txtComentario-{{$comentario['id']}}">{{$comentario['comentario']}}</p>
		  </div>
		</div>
	</div>
	@endforeach
</div>


<div class="modal fade" id="modalEditComentario" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar comentário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="/edita-comentario" >
          @csrf
          <input type="hidden" name="id_comentario" id="id_comentario">
          <div class="modal-body">
            
              <div class="mb-3">
                <label class="col-form-label">Comentário:</label>
                <textarea class="form-control" id="comentario" name="comentario"></textarea>
              </div>
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Editar</button>
          </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
	<script type="text/javascript">
		function carregaComentario(id){
			var comentario = $("#txtComentario-"+id).text();
			$("#comentario").val(comentario);
			$("#id_comentario").val(id);
		}
	</script>
@endsection