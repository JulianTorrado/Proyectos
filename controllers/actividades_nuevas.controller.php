<?php
require_once 'models/Auth.php';
require_once 'models/ActividadNueva.php';
require_once 'models/Proceso.php';
require_once 'models/Horario.php';
require_once 'models/Etapa_plantilla.php';
require_once 'models/Usuario.php';
require_once 'menu.controller.php';


class Actividades_NuevasController
{

    private $model;
    private $horario;
    private $asignacion;

    public function __CONSTRUCT()
    {
        $this->model = new ActividadNueva();
        $this->horario = new Horario();
        $this->asignacion = new Etapa_plantilla();

    }
    public function Index()
    {
        $etapas = $this->model->Listar($_REQUEST['pid']);
        require_once 'views/etapas/index.php';
    }

    public function Crud()
    {
        $Etapas = new ActividadNueva();
        $proceso = new Proceso();
        $usuario = new Usuario();
        $usuarios = $usuario->Funcionarios();
        $procesos = $proceso->Listar();
        $objetivos = $Etapas->Objetivos($_REQUEST['etapa']);
        $objetivosNuevos = $Etapas->ObjetivosNuevos($_REQUEST['etapa'], $_REQUEST['pid']);

        if (isset($_REQUEST['id'])) {
            $Etapas = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'views/actividadesNuevas/crud.php';
    }

    public function CrudExterno()
    {
        $Etapas = new ActividadNueva();
        $proceso = new Proceso();
        $usuario = new Usuario();
        $usuarios = $usuario->Funcionarios();
        $procesos = $proceso->Listar();
        //$objetivos = $Etapas->Objetivos($_REQUEST['etapa']);
        $proyectos = $this->model->Proyectos();
        if (isset($_REQUEST['id'])) {
            $Etapas = $this->model->Obtener($_REQUEST['id']);
        }
        require_once 'views/actividadesNuevas/crudExterno.php';
    }

    public function VerEtapas()
    {
        $proyecto_id = $_POST['proyecto_id'];

        // Suponiendo que tienes un modelo para obtener las etapas
        $etapas = $this->model->Etapas($proyecto_id);

        echo json_encode($etapas);
    }
    public function VerObjetivos()
    {
        $etapa_id = $_POST['etapa_id'];

        // Suponiendo que tienes un método para obtener los objetivos
        $objetivos = $this->model->ObjetivosExt($etapa_id);

        echo json_encode($objetivos);
    }


    public function Registrar()
    {
        // OBTENER EL DIA DE LA SEMANA DE LA FECHA
        // Establecer la localización en español
        setlocale(LC_TIME, 'es_ES.UTF-8');
        // Crear un objeto DateTime para la fecha especificada
        $date = new DateTime('2024-07-22');
        // Obtener el día de la semana en español
        $dia = strftime('%A', $date->getTimestamp());
        // Imprimir el día de la semana
        //echo ucfirst($dayOfWeek); // ucfirst para capitalizar la primera letra


        $actividad = new ActividadNueva();
        $actividad->objetivo_id = $_REQUEST['objetivo_id'];
        $actividad->proyecto_id = $_REQUEST['proyecto_id'];
        $actividad->actividad = $_REQUEST['actividad'];
        $actividad->proceso = $_REQUEST['proceso'];
        $actividad->soporte = $_REQUEST['soporte'];
        if ($actividad->id > 0) {
            $this->model->Actualizar($actividad);
        } else {
            $actividad_id = $this->model->Registrar($actividad);

            $asignacion = new Etapa_plantilla();
            //$asignacion->id = $_REQUEST['id'];
            $asignacion->etapa_id = $_REQUEST['etapa_id'];
            $asignacion->usuario_id = $_REQUEST['usuario_id'];
            $asignacion->proyecto_id = $_REQUEST['proyecto_id'];
            $asignacion->fecha = $_REQUEST['fecha_inicio'];
            $asignacion->fecha2 = $_REQUEST['fecha_cierre'];
            $asignacion->dia = $dia;
            $asignacion->hora1 = $_REQUEST['hora'];
            $asignacion->hora2 = $_REQUEST['hora2'];

            $plantilla = $this->asignacion->RegistrarAct($asignacion);

            $horario = new Horario();
            // $fecha = $_REQUEST['fecha_inicio'];
            // $dia = $dia;
            // $usuario_id = $_REQUEST['usuario_id'];
            // $hora1 = "00:00:00";
            // $hora2 = "00:00:00";
            // $actividad = $actividad_id;
            // $etapa = $plantilla;
            // $proyecto_id = $_REQUEST['proyecto_id'];
            // $estado = 1;
            // $check = $_REQUEST['check'];

            $horario->fecha = $_REQUEST['fecha_inicio'];
            $horario->dia = $dia;
            $horario->usuario_id = $_REQUEST['usuario_id'];
            $horario->actividad_id = $actividad_id;
            $horario->hora1 = $_REQUEST['hora'];
            $horario->hora2 = $_REQUEST['hora2'];
            $horario->etapa_plantilla_id = $plantilla;
            $horario->proyecto_id = $_REQUEST['proyecto_id'];
            $horario->estado = 0;

            $this->horario->Registrar($horario);
        }
        // $actividad->id > 0 ?
        //     $this->model->Actualizar($actividad)
        //     : $this->model->Registrar($actividad);
    }

    public function registrarExt()
    {
        setlocale(LC_TIME, 'es_ES.UTF-8');
        $date = new DateTime($_REQUEST['fecha_inicio']);
        $dayOfWeek = $date->format('w');
        $daysOfWeek = [
            '0' => 'domingo',
            '1' => 'lunes',
            '2' => 'martes',
            '3' => 'miércoles',
            '4' => 'jueves',
            '5' => 'viernes',
            '6' => 'sábado'
        ];
        $dia = $daysOfWeek[$dayOfWeek];

        $responsable = $_SESSION['uid'];
        $soporte = "Captura / foto";
        $fecha = Date('Y-m-d');


        $actividad = new ActividadNueva();
        $actividad->objetivo_id = $_REQUEST['objetivo_id'];
        $actividad->proyecto_id = $_REQUEST['proyecto_id'];
        $actividad->actividad = $_REQUEST['actividad'];
        $actividad->proceso = $_REQUEST['proceso'];
        $actividad->soporte = $soporte;
        if ($actividad->id > 0) {
            $this->model->Actualizar($actividad);
        } else {
            $actividad_id = $this->model->Registrar($actividad);

            $asignacion = new Etapa_plantilla();
            //$asignacion->id = $_REQUEST['id'];
            $asignacion->etapa_id = $_REQUEST['etapa_id'];
            $asignacion->usuario_id = $responsable;
            $asignacion->proyecto_id = $_REQUEST['proyecto_id'];
            $asignacion->fecha = $fecha;
            $asignacion->fecha2 = $fecha;
            $asignacion->dia = $dia;
            $asignacion->hora1 = $_REQUEST['hora1'];
            $asignacion->hora2 = $_REQUEST['hora2'];

            $plantilla = $this->asignacion->RegistrarAct($asignacion);

            $horario = new Horario();

            $horario->fecha = $fecha;
            $horario->dia = $dia;
            $horario->usuario_id = $responsable;
            $horario->actividad_id = $actividad_id;
            $horario->hora1 = $_REQUEST['hora1'];
            $horario->hora2 = $_REQUEST['hora2'];
            $horario->etapa_plantilla_id = $plantilla;
            $horario->proyecto_id = $_REQUEST['proyecto_id'];
            $horario->estado = 0;

            $this->horario->Registrar($horario);
        }
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

        $asignar = new ActividadNueva();

        $asignar->id = $_REQUEST['id'];
        $asignar->responsable = $_REQUEST['responsable'];
        $this->model->ReasignarEdit($asignar);

    }
}