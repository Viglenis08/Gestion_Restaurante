
 <div class="container"><br>
 

 <?php  
$action = isset($_GET['action']) ? $_GET['action'] : '';
   if($action == 'okReservas'){
        echo '<center><div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Exitos!! </strong> La Reserva fue agregada Satifactoriamente al Sistema.
          </div>
        </center>';
   }elseif($action == 'borrarReservas'){
        echo '<center><div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <strong>Exitos!! </strong> La Reserva fue Borrada Satifactoriamente del Sistema.
          </div>
        </center>';
   }elseif ($action == 'cambioReservas'){
   
  } else {
    
  
      
   }
 

 ?>
<div class="card">
<div class="row">
  <div class="col-md-8">  
    <ol class="breadcrumb">
       <li class="breadcrumb-item active"><i class="fa fa-list"> </i> LISTADO DE RESERVAS </li>
    </ol>
  </div>
    <div class="col-md-4">  
     <div class="alert alert-success" role="alert">

         <strong>Reservas Activas : </strong>
          <?php $vistaReservas = new MvcController();
                 $vistaReservas->totalReservasController();
           ?>                                     
    </div>
  </div>
    <br><br><br>
    <div class="col-md-7">
    <form method="post" class="form-control" action="index.php?action=buscarReservas">  
      <input type="text" class="form-control" id="datepicker" name="buscar" placeholder="Buscar Reservas por Fechas" required=""><br>
       <input type="submit" name="submit" class="btn btn-info btn-sm" value="Buscar">
    </form>
  </div>
  <div class="col-md-2">
<?php require 'Views/modal/modal_reserva.php'; ?>
  <div class="alert alert-secondary" role="alert">
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#reserva" data-whatever="@mdo"><i class="fa fa-plus fa-spin"> </i> 
  Hacer Reserva Nueva
  </button>
</div>
</div>
  <div class="card-block">
    <p class="card-text">
       <table class="table table-bordered">
    <thead class="thead" >
       <tr class="bg-warning">
            <td align="center">Cliente</td>
            <td align="center">Comensales</td>
            <td align="center">Teléfono</td>
            <td align="center">Dia</td>
            <td align="center">Hora</td>
            <td align="center">Observaciones</td>
            <td align="center">Acciones</td>
      </tr>
          </thead>

    <tbody>
      <?php
      
      $vistaUsuario = new MvcController();
       $reservas = $vistaUsuario->getReservasController();
       $reservas = $vistaUsuario->deleteReservasController();
        //$vistaUsuario = new MvcController();
        //$vistaUsuario->getReservasController();
        //$vistaUsuario->deleteReservasController();
       ?>
    </tbody>
  </table>
</div>
    </p>
</div>
  
  </div>
</div>
 </div>

</div>


