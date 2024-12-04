@extends('layouts.app')

@section('content')

<div class="modal modal-sheet position-static d-block p-4 py-md-5">
	<div class="modal-dialog">
		<div class="modal-content rounded-2 shadow border-0">
			<div class="modal-header p-5 pb-4 border-0 justify-content-center">
				<h3>LOGIN</h3>
			</div>
			<div class="modal-body p-5 pt-0">
				<form id="formLogin" method="POST">
					@csrf
					<div class="alert alert-danger pb-0 d-none" id="errors"></div>
					<div class="alert alert-success pb-0 d-none" id="success"></div>

					<div class="form-floating mb-3">
			            <input type="email" class="form-control rounded-3" id="email" name="email" placeholder="name@example.com">
			            <label>Endereço de email</label>
			        </div>
			        <div class="form-floating mb-3">
			            <input type="password" class="form-control rounded-3" id="senha" name="senha" placeholder="senha" >
			            <label>Senha</label>
			        </div>
			        <button class="w-100 mb-2 btn rounded-3 btn-primary" type="submit">Acessar</button>
			        <hr>
			        <a href="/cadastro">Faça seu cadastro aqui!</a>
				</form> 
			</div>
		</div>
	</div>
</div>


@endsection

@section('script')
	<script type="text/javascript">
		$("#formLogin").submit(function(e){
			e.preventDefault();
			var formData = new FormData(this);

			$('#errors').html('').addClass('d-none');
			$("#success").html('').addClass('d-none');

			var api_url = "{{ env('API_URL') }}";

			$.ajax({
				type: 'POST',
				url: `${api_url}/login`,
				data: formData,
				processData: false,
        		contentType: false,
        		success: function(res){
        			if(res.success){
        				document.cookie = "api_token=" + res.token + "; path=/; max-age=2592000;";
        				window.location.href = "/"
        			}

         			$('#errors').html('').addClass('d-none');

        		},
			 	error: function(xhr){
				 	if(xhr.status === 422){
				 		var errors = xhr.responseJSON.errors;
				 		$.each(errors, function (key, value) {
		                    $('#errors').append('<p>' + value + '</p>');
		                });
				 	} else {
				 		$('#errors').html('')
				 			.removeClass('d-none')
				 			.html('<p>Ocorreu um erro inesperado.</p>');
		            }
				 }
			});
		});
	</script>
@endsection