<?php
require_once 'models/Auth.php';
require_once 'models/Plantilla.php';
require_once 'models/Proyecto.php';
require_once 'models/Etapa.php';
require_once 'models/Objetivo.php';
require_once 'models/Actividad.php';
require_once 'menu.controller.php';


class PlantillasController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Plantilla();
    }
    public function Index()
    {
        $plantillas = $this->model->Listar();
        $menu = new MenuController();
        $menu->layout();
       // require_once 'views/layouts/header.php';
        require_once 'views/plantillas/index.php';
        require_once 'views/layouts/footer.php';
    }

    public function Crud()
    {
        $plantillas = new Plantilla();
        if (isset($_REQUEST['id'])) {
            $plantillas = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'views/layouts/validaciones.php'; 
        require_once 'views/plantillas/crud.php';
    }


    public function Registrar()
    {
        $plantilla = new Plantilla();
        $plantilla->id = $_REQUEST['id'];
        $plantilla->nombre = $_REQUEST['nombre'];
        $plantilla->descripcion = $_REQUEST['descripcion'];
        $plantilla->duracion = $_REQUEST['duracion'];
        $plantilla->created = date('Y-m-d');
        $plantilla->modified = date('Y-m-d');
        $plantilla->id > 0 ?
            $this->model->Actualizar($plantilla)
            : $this->model->Registrar($plantilla);
    }

    public function Gestion()
    {
        $plantillas = new Plantilla();
        $etapa = new Etapa();
        $objetivo = new Objetivo();
        $actividades = new Actividad();

        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        $etapas = $etapa->Listar($_REQUEST['pid']);
        $objetivos = $objetivo->Obj_pro($_REQUEST['pid']);
        $objindex = $objetivo->Obj_index($_REQUEST['pid']);
        $act_pro = $actividades->Act_Pro($_REQUEST['pid']);
        $_SESSION['pid'] = $_REQUEST['pid'];
        $menu = new MenuController();
        $menu->layout();
        //require_once 'views/layouts/header.php';
        require_once 'views/plantillas/gestion.php';
        require_once 'views/layouts/footer.php';
    }

    public function Proyecto()
    {
        $plantillas = new Plantilla();
        $proyec = new Proyecto();
        $etapa = new Etapa();
        $obj = new Objetivo();
        $act = new Actividad();    
        $proyecs=   $proyec->Obtener($_REQUEST['pid']);       
        $proyecto = $this->model->Obtener($proyecs->plantilla_id);
        require_once 'views/plantillas/ver.php';
    }
    public function Proyecto0()
    {
        $plantillas = new Plantilla();        
        $etapa = new Etapa();
        $obj = new Objetivo();
        $act = new Actividad();           
        $proyecto = $this->model->Obtener($_REQUEST['pid']);
        require_once 'views/plantillas/ver0.php';
    }
}
