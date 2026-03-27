<?php
require_once 'models/Auth.php';
require_once 'models/Proceso.php';
require_once 'menu.controller.php';
require_once 'models/Cliente.php';

class ProcesosController
{
    private $model;
    private $cliente;


    public function __CONSTRUCT()
    {
        $this->model = new Proceso();
        $this->cliente = new Cliente();

    }

    public function Index()
    {
        $procesos = $this->model->ListarIndex();
        $menu = new MenuController();
        $menu->layout();
        //require_once 'views/layouts/header.php';
        require_once 'views/procesos/index.php';
        require_once 'views/layouts/footer.php';
    }

    public function Crud()
    {
        $cliente = $this->cliente->Listar();
        $procesos = new Proceso();
        if (isset($_REQUEST['id'])) {
            $procesos = $this->model->Obtener($_REQUEST['id']);
        };
        require_once 'views/procesos/crud.php';
    }

    public function Guardar()
    {

        $proceso = new Proceso();
        $proceso->id = $_REQUEST['id'];
        $proceso->proceso = $_REQUEST['proceso'];
        $proceso->sigla = $_REQUEST['sigla'];
        $proceso->cliente_id = $_REQUEST['cliente_id'];

        $proceso->id > 0 ?
            $this->model->Actualizar($proceso)
            : $this->model->Registrar($proceso);
    }

    public function Obtener()
    {
        $Procesos = $this->model->Obtener($_REQUEST['id']);
        require_once 'views/procesos/index.php';
    }

    public function Eliminar()
    {
         $this->model->Eliminar($_REQUEST['id']);
    }
}
