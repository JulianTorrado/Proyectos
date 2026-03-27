<?php
require_once 'models/Auth.php';
require_once 'models/Seguimiento.php';
require_once 'menu.controller.php';

class SeguimientosController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Seguimiento();
    }

    public function Index()
    {
        $menu = new MenuController();
        $menu->layout();
        // require_once 'views/layouts/header.php';    
        $seguimientos=$this->model->Obtener($_REQUEST['cli_id']);   
        require_once 'views/Seguimientos/index.php';
        require_once 'views/layouts/footer.php';
    }


    public function Crud()
    {
        $seguimiento = new Seguimiento();
        if (isset($_REQUEST['id'])) {
            $Seguimiento = $this->model->Obtener($_REQUEST['id']);
        };
        require_once 'views/Seguimientos/crud.php';
    }

    public function Guardar()
    {
        //sleep(10);
        $seg = new Seguimiento();

        $seg->fecha_control = $_REQUEST['fecha_control'];
        $seg->propuesta = $_REQUEST['propuesta'];
        $seg->m_envio = $_REQUEST['m_envio'];
        $seg->info1 = $_REQUEST['info1'];
        $seg->info2 = $_REQUEST['info2'];
        $seg->creacion = $_REQUEST['creacion'];
        $seg->cliente_id = $_REQUEST['cliente_id'];
        $seg->usuario_id = $_REQUEST['usuario_id'];

        $seg->estado_id = 1;

        $seg->id > 0
            ? $this->model->Actualizar($seg)
            : $this->model->Registrar($seg);
    }
}
