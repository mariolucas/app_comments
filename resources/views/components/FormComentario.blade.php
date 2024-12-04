<div class="modal fade" id="modalComentario" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Novo comentário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="/salvar-comentario" >
          @csrf
          <div class="modal-body">
            
              <div class="mb-3">
                <label class="col-form-label">Comentário:</label>
                <textarea class="form-control" id="comentario" name="comentario"></textarea>
              </div>
            
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-primary">Comentar</button>
          </div>
      </form>
    </div>
  </div>
</div>