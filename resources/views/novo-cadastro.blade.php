@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-6">
		<h1>
			<i class="bi bi-person-vcard-fill"></i> Cadastro
		</h1>
		<div class="card p-3 shadow border-0">
			<form id="formCadastro" method="POST">
				@csrf
				<div class="alert alert-danger pb-0 d-none" id="errors"></div>
				<div class="alert alert-success pb-0 d-none" id="success"></div>

				<div class="mb-3 row">
				  <label class="col-sm-2 col-form-label">Nome</label>
				  <div class="col-sm-10">
				  	<input type="text" class="form-control" name="nome" id="nome" placeholder="Digite seu nome">
				  </div>
				</div>
				<div class="mb-3 row">
				  <label class="col-sm-2 col-form-label">E-mail</label>
				  <div class="col-sm-10">
				  	<input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail">
				  </div>
				</div>
				<div class="mb-3 row">
				  <label class="col-sm-2 col-form-label">Senha</label>
				  <div class="col-sm-10">
				  	<input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua senha">
				  </div>
				</div>
				<div>
					<button class="btn btn-primary" type="submit">
						Salvar
					</button>
				</div>
			</form>
		</div>
	</div>
</div>


@endsection

@section('script')
	<script type="text/javascript">
		$("#formCadastro").submit(function(e){
			e.preventDefault();
			var formData = new FormData(this);

			$('#errors').html('').addClass('d-none');
			$("#success").html('').addClass('d-none');

			$.ajax({
			 	type: "POST",
			 	url: "/api/novo-cadastro",
			 	data: formData,
			 	processData: false,
        		contentType: false,
			 	success: function(res){
			 		if(res.success){
			 			$("#success").removeClass('d-none').html("<p>Cadastro realizado com sucesso!</p>");
			 		}
			 	},
			 	error: function(xhr){
				 	if(xhr.status === 422){
				 		var errors = xhr.responseJSON.errors;
				 		$('#errors').removeClass('d-none');
				 		$.each(errors, function (key, value) {
		                    $('#errors').append('<p>' + value + '</p>');
		                });
				 	} else {
				 		$('#errors').removeClass('d-none')
				 			.html('<p>Ocorreu um erro inesperado.</p>');
		            }
				 }
			 });
		});
	</script>
@endsection