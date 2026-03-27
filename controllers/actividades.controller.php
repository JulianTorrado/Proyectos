<?php
require_once 'models/Auth.php';
require_once 'models/Actividad.php';
require_once 'models/Horario.php';

require_once 'models/Proceso.php';
require_once 'menu.controller.php';


class ActividadesController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Actividad();

    }
    public function Index()
    {
        $etapas = $this->model->Listar($_REQUEST['pid']);
        require_once 'views/etapas/index.php';
    }

    public function Crud()
    {
        $Etapas = new Actividad();
        $proceso = new Proceso();
        $procesos = $proceso->Listar();
        if (isset($_REQUEST['id'])) {
            $Etapas = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'views/actividades/crud.php';
    }


    public function Registrar()
    {
        $actividad = new Actividad();
        $actividad->objetivo_id = $_REQUEST['objetivo_id'];
        $actividad->actividad = $_REQUEST['actividad'];
        $actividad->proceso = $_REQUEST['proceso'];
        $actividad->soporte = $_REQUEST['soporte'];
        $actividad->descripcion = $_REQUEST['descripcion'];
        $actividad->id > 0 ?
            $this->model->Actualizar($actividad)
            : $this->model->Registrar($actividad);
    }

    public function verDescripcion(){
        $asignaciones = new Horario();
        $asignacion = $asignaciones->AsignadoDescricion($_REQUEST['id']);
        require_once 'views/actividades/descripcion.php';

    }
    public function Gestion()
    {
        $Etapas = new Objetivo();
        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        $menu = new MenuController();
        $menu->layout();
        //require_once 'views/layouts/header.php';
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
        $objindex = $this->model->Obj_index($_REQUEST['pid']);
        require_once 'views/objetivos/ver.php';

    }


    public function Reasignar()
    {
        $proceso = $this->model->Proceso();
        require_once 'views/actividades/reasignar.php';
    }
    public function ReasignarEdit()
    {

        $asignar = new Actividad();

        $asignar->id = $_REQUEST['id'];
        $asignar->responsable = $_REQUEST['responsable'];
        $this->model->ReasignarEdit($asignar);

    }
}