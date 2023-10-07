
  <div class="modal fade bd-example" id="categorias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: #FF9033;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="exampleModalLabel" style="color: white;">Agregue Nuevas Categorias</h4>
        </div>
        <div class="modal-body">

          <form method="post">
          <div class="row">
            <div class="col-md-12">  
              <div class="form-group">
               <center> <label for="categoria-name" class="form-control-label"><strong>Nombre Categoria :</strong></center></label>
       
                <input type="text" class="form-control" id="categoria-name" name="nombrecategoria" required="">
              </div>
            </div>

          </div>
         
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" name="agregarCategorias">Agregar Categoria</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php  

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$regis = new CategoriasController();
$regis->agregarCategoriasController();
?>