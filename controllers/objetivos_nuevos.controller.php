<?php
require_once 'models/Auth.php';
require_once 'models/ObjetivoNuevo.php';
require_once 'models/Proyecto.php';
require_once 'menu.controller.php';


class Objetivos_nuevosController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new ObjetivoNuevo();
    }
    public function Index()
    {
        $etapas = $this->model->Listar($_REQUEST['pid']);
        require_once 'views/etapas/index.php';
    }

    public function Crud()
    {
        $nueva = $_REQUEST['nueva'];
        $Etapas = new ObjetivoNuevo();
        if (isset($_REQUEST['id'])) {
            $Etapas = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'views/objetivosNuevos/crud.php';
    }


    public function Registrar()
    {
        $etapa = new ObjetivoNuevo();
        $etapa->etapa_id = $_REQUEST['etapa_id'];
        $etapa->objetivo = $_REQUEST['objetivo'];
        $etapa->proyecto_id = $_REQUEST['proyecto_id'];
        $etapa->nueva = $_REQUEST['nueva'];

        $etapa->id > 0 ?
            $this->model->Actualizar($etapa)
            : $this->model->Registrar($etapa);
    }

    public function Gestion()
    {
        $Etapas = new ObjetivoNuevo();
        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        $menu = new MenuController();
        $menu->layout();
        //require_once 'views/layouts/header.php';
        require_once 'views/Etapas/gestion.php';
        // require_once 'views/layouts/footer.php';

    }

    public function Proyecto()
    {
        $Etapas = new ObjetivoNuevo();
        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        require_once 'views/Etapas/ver.php';
    }
    public function Etapa()
    {
        $Etapas = new ObjetivoNuevo();
        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        require_once 'views/etapas/index.php';
    }
    public function Ver()
    {   
        $Etapas = new ObjetivoNuevo();
        $plantillas = new Proyecto();
        $plantillas = $plantillas->Obtener($_REQUEST['pid']);
        //print_r($plantillas);
        $objindex= $this->model->Obj_index($plantillas->plantilla_id);
        require_once 'views/objetivos/ver.php';
       
    }
    public function Ver0()
    {   
        $Etapas = new ObjetivoNuevo();
        
        //print_r($plantillas);
        $objindex= $this->model->Obj_index($_REQUEST['pid']);
        require_once 'views/objetivos/ver0.php';
       
    }
}
