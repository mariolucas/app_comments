<nav class="navbar navbar-expand-lg mb-4">
  <div class="container-fluid p-0">
    
    <a class="navbar-brand" href="#"><strong>COMMENTS</strong></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="/">
          <i class="bi bi-house-door-fill"></i> Home
        </a>
        @authJwtWeb
        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#modalComentario">
          <i class="bi bi-pencil-square"></i> Comentar
        </a>
        <a class="nav-link" href="/meus-comentarios">
          <i class="bi bi-chat-right-dots-fill"></i> Meus comentários
        </a>
        <a class="nav-link" href="/meu-cadastro">
          <i class="bi bi-person-circle"></i> Meu Cadastro
        </a>
        <a class="nav-link" href="/sair">
          <i class="bi bi-x-circle-fill"></i> Sair
        </a>
        @endauthJwtWeb

        @guestJwtWeb
        <a class="nav-link" href="/novo-cadastro">
          <i class="bi bi-person-circle"></i> Cadastre-se
        </a>
        <a class="nav-link" href="/login">
          <i class="bi bi-lock-fill"></i> Login
        </a>
        @endguestJwtWeb

      </div>
    </div>
  </div>
</nav>