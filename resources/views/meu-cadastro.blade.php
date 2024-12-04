@extends('layouts.app')

@section('content')

<div class="row">
	<h1 class="mb-5">
		<i class="bi bi-person-circle"></i> Meu Cadastro
	</h1>
	<div class="col-6">
		<div class="card p-3 shadow border-0">
			<form id="formCadastro" method="POST" action="/edita-cadastro">
				@csrf
				<div class="mb-3 row">
				  <label class="col-sm-3 col-form-label">Nome</label>
				  <div class="col-sm-9">
				  	<input type="text" class="form-control" value="{{$dados['nome']}}" name="nome" id="nome" placeholder="Digite seu nome">
				  </div>
				</div>
				<div class="mb-3 row">
				  <label class="col-sm-3 col-form-label">E-mail</label>
				  <div class="col-sm-9">
				  	<input type="email" class="form-control" value="{{$dados['email']}}" name="email" id="email" placeholder="Digite seu e-mail">
				  </div>
				</div>
				<div class="mb-3 row">
				  <label class="col-sm-3 col-form-label">Alterar Senha</label>
				  <div class="col-sm-9">
				  	<input type="password" class="form-control" name="senha" id="senha" placeholder="Digite sua nova senha">
				  </div>
				</div>
				<div>
					<p>
						<small>Pode ser necessário refazer login na alteração da senha e/ou email</small>
					</p>
					<button class="btn btn-primary" type="submit">
						Editar
					</button>
				</div>
			</form>
		</div>
	</div>
</div>


@endsection
