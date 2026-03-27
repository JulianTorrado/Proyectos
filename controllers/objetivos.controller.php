<?php
require_once 'models/Auth.php';
require_once 'models/Objetivo.php';
require_once 'models/Proyecto.php';
require_once 'menu.controller.php';


class ObjetivosController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Objetivo();
    }
    public function Index()
    {
        $etapas = $this->model->Listar($_REQUEST['pid']);
        require_once 'views/etapas/index.php';
    }

    public function Crud()
    {
        $Etapas = new Objetivo();
        if (isset($_REQUEST['id'])) {
            $Etapas = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'views/objetivos/crud.php';
    }


    public function Registrar()
    {
        $etapa = new Objetivo();
        $etapa->etapa_id = $_REQUEST['etapa_id'];
        $etapa->objetivo = $_REQUEST['objetivo'];


        $etapa->id > 0 ?
            $this->model->Actualizar($etapa)
            : $this->model->Registrar($etapa);
    }

    public function Gestion()
    {
        $Etapas = new Objetivo();
        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        $menu = new MenuController();
        $menu->layout();
       // require_once 'views/layouts/header.php';
        require_once 'views/Etapas/gestion.php';
        // require_once 'views/layouts/footer.php';

    }

    public function Proyecto()
    {
        $Etapas = new Objetivo();
        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        require_once 'views/Etapas/ver.php';
    }
    public function Etapa()
    {
        $Etapas = new Objetivo();
        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        require_once 'views/etapas/index.php';
    }
    public function Ver()
    {   
        $Etapas = new Objetivo();
        $plantillas = new Proyecto();
        $plantillas = $plantillas->Obtener($_REQUEST['pid']);
        //print_r($plantillas);
        $objindex= $this->model->Obj_index($plantillas->plantilla_id);
        require_once 'views/objetivos/ver.php';
       
    }
    public function Ver0()
    {   
        $Etapas = new Objetivo();
        
        //print_r($plantillas);
        $objindex= $this->model->Obj_index($_REQUEST['pid']);
        require_once 'views/objetivos/ver0.php';
       
    }
}
