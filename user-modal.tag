<user-modal>
    
    <div id="user-modal-tag" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div if={ready} class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">{model.Apellido}, {model.Nombre}</h4>
          </div>
          <div class="modal-body">
              <div if={!ready} class="text-center">
                  Cargando, espere un momento por favor ...
              </div>
            <div if={ready} class="media">
              <div class="media-left">
                <img class="media-object user-modal-pic" src="uploads/{model.Foto}">
              </div>
              <div class="media-body">
                <dl>
                  <dt>Nombre</dt>
                  <dd>{model.Apellido} {model.Nombre}</dd>
                  <dt>Correo</dt>
                  <dd>{model.Correo}</dd>
                  <dt>Fecha nacimiento</dt>
                  <dd>{model.FechaNacimiento}</dd>
                  <dt>Sexo</dt>
                  <dd>{model.Sexo}</dd>
                </dl>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <style>
        .user-modal-pic{width:220px;}
    </style>
    
  <script>
      var self = this;
      self.ready = false;      
      
      getDataFromServer();
      
      function getDataFromServer(){
          $.post('?c=Alumno&a=Obtener&id=' + opts.id, function(r){
              self.model = r;
              self.model.Sexo = r.Sexo == 1 ? 'Hombre' : 'Mujer';
              self.ready = true;
              
              self.update();
          }, 'json')
      }
      
      this.on('mount', function(){
        $("#user-modal-tag").modal();          
      })
  </script>

</user-modal>