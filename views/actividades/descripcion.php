<?php //print_r($asignacion); ?>
<div class="container-fluid">
  <div class="row"> 
    <div class="col-md-12 text-justify">
      <h2>Descripcion de la tarea</h2>
      <?php if ($asignacion->descripcion != null){
        echo $asignacion->descripcion;
      }else{
        echo "No hay descripcion";
      }?>

    </div>
  </div>

</div>