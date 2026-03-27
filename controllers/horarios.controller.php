<?php
require_once 'models/Auth.php';
require_once 'models/Horario.php';
require_once 'models/Usuario.php';
require_once 'menu.controller.php';

class HorariosController
{

  private $model;

  public function __CONSTRUCT()
  {
    $this->model = new Horario();
  }

  public function Index()
  {

    $menu = new MenuController();
    $menu->layout();
    require_once 'views/horarios/obtener.php';
    require_once 'views/layouts/footer.php';
  }
  public function Obtener()
  {
    $horario = new Horario();
    $menu = new MenuController();
    $menu->layout();

    require_once 'views/horarios/obtener.php';
    // require_once 'views/layouts/footer.php';
  }
  public function Eventos()
  {
    $data = $this->model->Obtener($_REQUEST['id']);
    $color = '#A80300';
    $textColor = '#ffffff';

    foreach ($data  as $row) {
      $data[] = array(
        'id'   => $row["id"],
        'title'   => $row["dia"],
        'start'   => $row["fecha"],
        'end'   => $row["fecha"],
        'color' => $color,
        'textColor' => $textColor,
      );
    }


    echo json_encode($data, JSON_HEX_QUOT | JSON_HEX_TAG);
  }

  public function Estado()
  {
    $horarios = $this->model->Ver($_REQUEST['hid']);
   // print_r($horarios);  
    require_once 'views/horarios/estado.php';       
  }

  public function Editar()
  {
    $horarios = $this->model->Ver($_REQUEST['hid']);
    $funcionario=new Usuario();
    $funcionarios=$funcionario->Funcionarios();
    
    require_once 'views/horarios/editar.php';       
  }



  public function Actualizar()
  {

    $horario = new Horario();
    $horario->estado = $_REQUEST['estado'];
    $horario->id = $_REQUEST['id'];
    $this->model->Actualizar($horario);
  }

  public function Edit0()
  {

    $horario = new Horario();
    $horario->id = $_REQUEST['id'];
    $horario->fecha = $_REQUEST['fecha'];
    $horario->dia = $_REQUEST['dia'];
    $horario->hora1 = $_REQUEST['hora1'];
    $horario->hora2 = $_REQUEST['hora2'];
   
    $horario->usuario_id = $_REQUEST['responsable'];
    
    $this->model->Edit0($horario);
  }

  public function Borrar(){

    if ($_REQUEST['id']) {
      // file was successfully deleted
      $this->model->Borrar($_REQUEST['id']);
      echo'<script>
      alert("Eliminado con éxito!!");
         window.history.back();
         </script>';
  } else {
  }

  }

}
