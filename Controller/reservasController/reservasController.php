<?php  

class MvcController {

   public function plantilla(){
   	     include 'Views/template.php';
   }

  	#INTERACCIÓN DEL USUARIO
	#----------------------------------------------
	public function enlacesPaginasController(){
		$paginasObj = new Paginas();
		if(isset($_GET["action"])){

		  $enlacesController = $_GET["action"];

		}else{

		   $enlacesController = "index";
			
		}
      // le pide al modelo y que conecte con :: al método y asi heredo la clase y sus metodos y atributos..
	  $respuesta = $paginasObj->enlacesPaginasModel($enlacesController);
	  //$respuesta = Paginas::enlacesPaginasModel($enlacesController);
		 require $respuesta;

	}
	//=============================================================================
	//RESERVAS
	//============================================================================
// funcion para devolver todas las reservas.
public function getReservasController() {
    $datosObj = new Datos();
    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $hoy = date('Y-m-d');
    
    // Obtener las reservas
    $respuesta = $datosObj->getReservasModel('reservas');
    
    // Comprobar si se obtuvieron datos
    if (empty($respuesta)) {
        echo '<tr><td colspan="7">No hay reservas disponibles.</td></tr>';
    } else {
        foreach ($respuesta as $row) {
            if ($hoy == $row['diallegada']) {
                echo '<tr>';
                echo '<td align="center">'.$row["nombrecliente"].'</td>';
                echo '<td align="center">'.$row["cantidadpersonas"].'</td>';
                echo '<td align="center">'.$row["telefono"].'</td>';
                echo '<td align="center">'.date("d-m-Y", strtotime($row["diallegada"])).'</td>';
                echo '<td align="center">'.$row["horallegada"].'</td>';
                echo '<td align="center">'.$row["observaciones"].'</td>';
                echo '<td align="center">';
                echo '<a href="index.php?action=editarReservas&idreserva='.$row["idreserva"].'"<i class="fa fa-edit btn btn-primary btn-sm"></i></a>&nbsp;&nbsp;&nbsp;';
                echo '<a href="index.php?action=reservas&idBorrar='.$row["idreserva"].'"<i class="fa fa-trash-o btn btn-danger btn-sm"></i></a>';
                echo '</td>';
                echo '</tr>';
            }
        }
    }
}

 	//insertar reservas
 	public function agregarReservaController(){
		$datosObj = new Datos();
         	if(isset($_POST['agregar'])) {
 			$datosController = array("nombrecliente"=>$_POST['nombrecliente'],
 				                     "cantidadpersonas"=>$_POST['cantidadpersonas'],
 				                      "telefono"=>$_POST['telefono'],
 				                      "diallegada"=>$_POST['diallegada'],	              
 				                      "horallegada"=>$_POST['horallegada'],	              
 				                      "observaciones"=>$_POST['observaciones']
 				                                  
 				                     );
 			#pedir la informacion al modelo.
		$respuesta = $datosObj->agregarReservasModel($datosController,'reservas');
 		//$respuesta= Datos::agregarReservasModel($datosController,'reservas');
 			if ($respuesta == 'success') {
 				header('location:okReservas');
 			}else{
                header('location:reservas');
 			}
 		}
 	}

 	//borrar Reservas
   public function deleteReservasController(){
	$datosObj = new Datos();
   	 if (isset($_GET['idBorrar'])) {
   	 	$datosController = $_GET['idBorrar'];
		$respuesta = $datosObj->deleteReservaModel($datosController,'reservas');
   	 	//$respuesta = Datos::deleteReservaModel($datosController,'reservas');
   	 	if ($respuesta == 'success') {
         header('location:borrarReservas');
          
   	 	}
   	 }
   }
//cantidad de reservas
   public function totalReservasController(){
	$datosObj = new Datos();
	$respuesta = $datosObj->totalReservasModel('reservas');
   	  //$respuesta = Datos::totalReservasModel('reservas');
   	 	foreach ($respuesta as $key ) {
 			 echo $key['total'];
 		}
   	  	
   	  
   }

     public function editarReservasController(){
		$datosObj = new Datos();
      	$datosController= $_GET['idreserva'];
	    //$respuesta =Datos::editarReservasModel($datosController, 'reservas');
		$respuesta = $datosObj->editarReservasModel($datosController, 'reservas');
	    echo ' <form method="post">
          <div class="row">
            <div class="col-md-6">  
              <div class="form-group">
                <label for="recipient-name" class="form-control-label">Nombre Cliente:</label>
                <input type="text" class="form-control" id="recipient-name" name="nombrecliente" value="'.$respuesta['nombrecliente'].'">
              </div>
            </div>
               <div class="col-md-6">  
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Cantidad de Personas:</label>
              <input type="text" class="form-control" id="recipient-name" name="cantidadpersonas" value="'.$respuesta['cantidadpersonas'].'">
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6"> 
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Telefono de Contacto:</label>
              <input type="text" class="form-control" id="recipient-name" name="telefono"  value="'.$respuesta['telefono'].'">
            </div>
            </div>
            <div class="col-md-6"> 
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Fecha Reserva (1/10/2017):</label>
              <input type="text" id="datepicker" class="form-control" id="recipient-name" name="diallegada" value="'.$respuesta['diallegada'].'">
            </div>
            </div>
            </div>
             <div class="row">
                <div class="col-md-6"> 
             <div class="form-group">
              <label for="recipient-name" class="form-control-label">Hora de Reserva (22:00):</label>
              <input type="text" class="form-control" id="recipient-name" name="horallegada" value="'.$respuesta['horallegada'].'">
            </div>
            </div>
              <div class="col-md-6"> 
              <div class="form-group">
              <label for="message-text" class="form-control-label">Observaciones:</label>
              <textarea class="form-control" id="message-text" name="observaciones" required="">'.$respuesta['observaciones'].'</textarea>
            </div>
            </div>
        </div>
        </div>
        <input type="hidden" name="idreserva" value="'.$respuesta['idreserva'].'">
          <button type="submit" class="btn btn-primary form-control" name="editar">Agregar Reserva</button>
          </form>';
     
    }

    public function actualizarReservasController(){
		$datosObj = new Datos();
    	if (isset($_POST['editar'])) {
    		$datosController=array('nombrecliente'=>$_POST['nombrecliente'],
    			                   'cantidadpersonas'=>$_POST['cantidadpersonas'],
    			                   'telefono'=>$_POST['telefono'],
    			                   'diallegada'=>date("Y-m-d", strtotime($_POST['diallegada'])),
    			                   'horallegada'=>$_POST['horallegada'],
    			                   'observaciones'=>$_POST['observaciones'],
    			                   'idreserva'=>$_POST['idreserva']
    			);
				$respuesta = $datosObj->actualizarReservasModel($datosController,'reservas');
				//$respuesta=Datos::actualizarReservasModel($datosController,'reservas');	
    	  	if ($respuesta == 'success') {
      				  header('location:cambioReservas');
      		}
    	}
    }
   //=============================================================================
	//FIN DE RESERVAS
	//============================================================================

}
