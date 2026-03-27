<?php
require_once 'models/Auth.php';
require_once 'models/Compromiso.php';
require_once 'menu.controller.php';

class CompromisosController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Compromiso();
    }

    public function Index()
    {

        $compromiso = new Compromiso();
        $compromisos = $this->model->Obtener($_REQUEST['hid']);
        require_once 'views/compromisos/index.php';
        
    }
    public function Obtener()
    {
        $compromiso = new Compromiso();
        $menu = new MenuController();
        $menu->layout();
        //require_once 'views/layouts/headerc.php';
        require_once 'views/horarios/obtener.php';
        // require_once 'views/layouts/footer.php';
    }

    public function Crud()
    {
        $compromiso = new Compromiso();
        if(isset($_REQUEST['id'])){
          $compromiso=  $this->model->Listar($_REQUEST['id']);
         }
           require_once 'views/compromisos/crud.php';
    }


    public function Guardar()
    {
        $compromiso = new Compromiso();
        $compromiso->id = $_REQUEST['id'];
        $compromiso->horario_id = $_REQUEST['horario_id'];
        $compromiso->descripcion = $_REQUEST['descripcion'];
        $compromiso->fecha = $_REQUEST['fecha'];
        $compromiso->fverificacion = $_REQUEST['fverificacion'];
        $compromiso->estado = $_REQUEST['estado'];

        $compromiso->id > 0
            ? $this->model->Actualizar($compromiso) :
            $this->model->Registrar($compromiso);
    }



    public function Eliminar(){
        if ($_REQUEST['id']) {            
            $this->model->Eliminar($_REQUEST['id']);
            echo'<script>
            alert("Eliminado con éxito!!");
               window.history.back();
               </script>';
        } else {
        }


    }

}
