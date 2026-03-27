<?php
require_once 'models/Auth.php';
require_once 'models/EtapasNuevas.php';
require_once 'menu.controller.php';

class Etapas_nuevasController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new EtapasNuevas();

    }
    public function Index()
    {
        $plantilla = $this->model->BuscarPlantilla($_REQUEST['pid']);
        $id_plantilla = $plantilla->plantilla_id;
        $etapas = $this->model->Listar($id_plantilla);
        $etapasNuevas = $this->model->ListarNuevas($_REQUEST['pid']);
        require_once 'views/etapasNuevas/index.php';
    }

    public function Crud()
    {
        $Etapas = new EtapasNuevas();

        if (isset($_REQUEST['id'])) {
            $Etapas = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'views/etapasNuevas/crud.php';
    }


    public function Registrar()
    {
        $etapa = new EtapasNuevas();

        $etapa->proyecto_id    = $_REQUEST['proyecto_id'];
        $etapa->notacion = $_REQUEST['notacion'];
        echo $etapa->id > 0 ?
            $this->model->Actualizar($etapa)
            : $this->model->Registrar($etapa);
    }


    public function Gestion()
    {
        $Etapas = new EtapasNuevas();

        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        $menu = new MenuController();
        $menu->layout();
       // require_once 'views/layouts/header.php';
        require_once 'views/etapas/gestion.php';
        // require_once 'views/layouts/footer.php';

    }

    public function Proyecto()
    {
        $Etapas = new EtapasNuevas();

        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        require_once 'views/etapas/ver.php';
    }
    public function Etapa()
    {
        $Etapas = new EtapasNuevas();

        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        require_once 'views/etapas/index.php';
    }
}
