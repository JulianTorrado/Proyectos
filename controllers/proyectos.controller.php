<?php
require_once 'models/Auth.php';
require_once 'models/Plantilla.php';
require_once 'models/Etapa.php';
require_once 'models/Objetivo.php';
require_once 'models/Actividad.php';
require_once 'models/Proyecto.php';
require_once 'models/Usuario.php';
require_once 'models/Etapa_plantilla.php';
require_once 'models/Horario.php';
require_once 'models/Cliente.php';
require_once 'models/ActividadNueva.php';
require_once 'menu.controller.php';




class ProyectosController
{

	private $model;
	private $actividadNueva;

	public function __CONSTRUCT()
	{
		$this->model = new Proyecto();
		$this->actividadNueva = new ActividadNueva();

	}
	public function Index()
	{
		$proyectos = $this->model->ListarOff();
		//print_r($proyectos);
		$menu = new MenuController();
		$menu->layout();
		require_once 'views/proyectos/index.php';
		require_once 'views/layouts/footer.php';
	}
	public function Indexoff()
	{
		$proyectos = $this->model->Listar();
		//print_r($proyectos);
		$menu = new MenuController();
		$menu->layout();
		//require_once 'views/layouts/header.php';
		require_once 'views/proyectos/indexoff.php';
		require_once 'views/layouts/footer.php';
	}

	public function IndexOperario()
	{
		$proyectos = $this->model->proyectosPorPersona($_SESSION['user_id']);
		//print_r($proyectos);
		$menu = new MenuController();
		$menu->layout();
		require_once 'views/proyectos/indexOperario.php';
		require_once 'views/layouts/footer.php';
	}


	public function TareasDeOperario()
	{
		$asignacion = $this->model->tareasAsignadas($_REQUEST['pid'], $_SESSION['user_id']);
		//print_r($proyectos);
		$menu = new MenuController();
		$menu->layout();
		require_once 'views/proyectos/tareasOperario.php';
		require_once 'views/layouts/footer.php';
	}





	public function Etapa_index()
	{
		$plantillas = new Proyecto();
		$proyectos = $this->model->Listar();

		$etapa = new Etapa();

		$plantillas = $this->model->Obtener($_REQUEST['pid']);
		$etapas = $etapa->Listar($plantillas->plantilla_id);
		$etapasActs = $etapa->Etapa_act($plantillas->plantilla_id);
		//print_r($etapasActs);
		require_once 'views/proyectos/etapa_index.php';
	}



	public function Crud()
	{

		$cliente0 = new Cliente();
		$clientes = $cliente0->Listar();
		//print_r($clientes);
		$plantilla0 = new Plantilla();
		$plantillas = $plantilla0->Listar();
		$proyectos = new Proyecto();
		if (isset($_REQUEST['id'])) {
			$proyectos = $this->model->Obtener($_REQUEST['id']);
		}
		require_once 'views/proyectos/crud.php';
	}


	public function Registrar0()
	{

		$proyectos = new Proyecto();
		$proyectos->id = $_REQUEST['id'];
		$proyectos->nombre = $_REQUEST['nombre'];
		$proyectos->fecha_inicio = $_REQUEST['fecha_inicio'];
		$proyectos->fecha_cierre = $_REQUEST['fecha_cierre'];
		$proyectos->cliente_id = $_REQUEST['cliente_id'];
		$proyectos->plantilla_id = $_REQUEST['plantilla_id'];

		$proyectos->id > 0
			? $proyec = $proyectos->Actualizar($proyectos)
			: $proyec = $proyectos->Registrar0($proyectos);
	}



	public function Registrar()
	{
		$proyecto = new Etapa_plantilla();

		$proyecto->id = $_REQUEST['id'];
		$proyecto->etapa_id = $_REQUEST['etapa_id'];
		$proyecto->usuario_id = $_REQUEST['usuario_id'];
		$proyecto->fecha1 = $_REQUEST['fecha_inicio'];
		$proyecto->fecha2 = $_REQUEST['fecha_cierre'];
		$proyecto->dias = @$_REQUEST['dia1'] . '-' . @$_REQUEST['dia2'] . '-' . @$_REQUEST['dia3'] . '-' . @$_REQUEST['dia4'] . '-' . @$_REQUEST['dia5'] . '-' . @$_REQUEST['dia6'];
		$proyecto->hora1 = $_REQUEST['hora'];
		$proyecto->hora2 = $_REQUEST['hora2'];
		//$proyecto->prioridad = $_REQUEST['prioridad'];
		$dias = $proyecto->dias;
		$fechaInicio = strtotime($proyecto->fecha1);
		$fechaFin = strtotime($proyecto->fecha2);
		@$lunes = $_REQUEST['dia1'];
		@$martes = $_REQUEST['dia2'];
		@$miercoles = $_REQUEST['dia3'];
		@$jueves = $_REQUEST['dia4'];
		@$viernes = $_REQUEST['dia5'];
		@$sabados = $_REQUEST['dia6'];
		$dias = array($lunes, $martes, $miercoles, $jueves, $viernes, $sabados);
		$lista = list($l, $m, $mi, $j, $v, $s) = $dias;

		//Recorro las fechas y con la función strotime obtengo los lunes
		for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400) {
			//Sacar el dia de la semana con el modificador N de la funcion date
			$dia = date('N', $i);
			if ($dia == 1 && $l != "") {
				//  echo "Lunes" . date("Y-m-d", $i) .$proyecto->hora1.' '. $proyecto->hora2 . "<br>";

				$proyecto->dia = "Lunes";
				$proyecto->fecha = date("Y-m-d", $i);
				$proyecto->hora1 = $proyecto->hora1;
				$proyecto->hora2 = $proyecto->hora2;
				$proyecto->etapa_id = $_REQUEST['etapa_id'];
				$proyecto->proyecto_id = $_REQUEST['proyecto_id'];
				$proyecto->usuario_id = $_REQUEST['usuario_id'];
				$registrar = $proyecto->Registrar($proyecto);
			}
			if ($dia == 2 && $m != "") {

				$proyecto->dia = "Martes";
				$proyecto->fecha = date("Y-m-d", $i);
				$proyecto->hora1 = $proyecto->hora1;
				$proyecto->hora2 = $proyecto->hora2;
				$proyecto->etapa_id = $_REQUEST['etapa_id'];
				$proyecto->proyecto_id = $_REQUEST['proyecto_id'];
				$proyecto->usuario_id = $_REQUEST['usuario_id'];
				$registrar = $proyecto->Registrar($proyecto);
				// echo "Martes" . date("Y-m-d", $i) .$proyecto->hora1.' '. $proyecto->hora2 . "<br>";
			}
			if ($dia == 3 && $mi != "") {
				$proyecto->dia = "Miercoles";
				$proyecto->fecha = date("Y-m-d", $i);
				$proyecto->hora1 = $proyecto->hora1;
				$proyecto->hora2 = $proyecto->hora2;
				$proyecto->etapa_id = $_REQUEST['etapa_id'];
				$proyecto->proyecto_id = $_REQUEST['proyecto_id'];
				$proyecto->usuario_id = $_REQUEST['usuario_id'];
				$registrar = $proyecto->Registrar($proyecto);
				//echo "Miercoles" . date("Y-m-d", $i) .$proyecto->hora1.' '. $proyecto->hora2 . "<br>";
			}
			if ($dia == 4 && $j != "") {
				$proyecto->dia = "jueves";
				$proyecto->fecha = date("Y-m-d", $i);
				$proyecto->hora1 = $proyecto->hora1;
				$proyecto->hora2 = $proyecto->hora2;
				$proyecto->etapa_id = $_REQUEST['etapa_id'];
				$proyecto->proyecto_id = $_REQUEST['proyecto_id'];
				$proyecto->usuario_id = $_REQUEST['usuario_id'];
				$registrar = $proyecto->Registrar($proyecto);
				// echo "jueves" . date("Y-m-d", $i) .$proyecto->hora1.' '. $proyecto->hora2 . "<br>";
			}
			if ($dia == 5 && $v != "") {
				$proyecto->dia = "Viernes";
				$proyecto->fecha = date("Y-m-d", $i);
				$proyecto->hora1 = $proyecto->hora1;
				$proyecto->hora2 = $proyecto->hora2;
				$proyecto->etapa_id = $_REQUEST['etapa_id'];
				$proyecto->proyecto_id = $_REQUEST['proyecto_id'];
				$proyecto->usuario_id = $_REQUEST['usuario_id'];
				$registrar = $proyecto->Registrar($proyecto);
				// echo "Viernes" . date("Y-m-d", $i) .$proyecto->hora1.' '. $proyecto->hora2 . "<br>";
			}
			if ($dia == 6 && $s != "") {
				$proyecto->dia = "Sabado";
				$proyecto->fecha = date("Y-m-d", $i);
				$proyecto->hora1 = $proyecto->hora1;
				$proyecto->hora2 = $proyecto->hora2;
				$proyecto->etapa_id = $_REQUEST['etapa_id'];
				$proyecto->proyecto_id = $_REQUEST['proyecto_id'];
				$proyecto->usuario_id = $_REQUEST['usuario_id'];
				$registrar = $proyecto->Registrar($proyecto);
				// echo "Sabado" . date("Y-m-d", $i) .$proyecto->hora1.' '. $proyecto->hora2 . "<br>";
			}
		}
	}



	public function Gestion()
	{
		//@session_start();
		$plantillas = new Proyecto();
		$etapa = new Etapa();
		$objetivo = new Objetivo();
		$actividades = new Actividad();
		$proyecto = $this->model->Obtener($_REQUEST['pid']);

		$etapas = $etapa->Listar($proyecto->plantilla_id);
		$etapasNuevas = $etapa->ListarNueva($_REQUEST['pid']);
		$objetivos = $objetivo->Obj_pro($proyecto->plantilla_id);
		$objindex = $objetivo->Obj_index($proyecto->plantilla_id);
		$act_pro = $actividades->Act_Pro($proyecto->plantilla_id);
		$_SESSION['pid'] = $proyecto->plantilla_id;

		$menu = new MenuController();
		$menu->layout();
		//require_once 'views/layouts/header.php';
		require_once 'views/proyectos/gestion.php';
		require_once 'views/layouts/footer.php';
	}

	public function Proyecto()
	{
		$plantillas = new Proyecto();
		$etapa = new Etapa();
		$obj = new Objetivo();
		$act = new Actividad();
		$proyecto = $this->model->Obtener($_REQUEST['pid']);
		require_once 'views/plantillas/ver.php';
	}

	//-----------etapas info gestion--------//
	public function Etapa_add()
	{
		$usuario = new Usuario();
		$usuarios = $usuario->Funcionarios();
		require_once 'views/proyectos/etapa_add.php';
	}
	//-----------etapas info gestion--------//

	public function Ver()
	{
		/*$etapa = new Etapa();
									 $etapas = $etapa->Obtener($_REQUEST['pid']);*/
		$actividades = new Actividad();
		$act_pro = $actividades->Act_Pro_eta($_REQUEST['val02']);
		$horario = new Etapa_plantilla();
		$horarios = $horario->Listar($_REQUEST['val01'], $_REQUEST['val02']);

		$usuario = new Usuario();
		$usuarios = $usuario->Funcionarios();
		require_once 'views/proyectos/ver.php';
	}


	public function Ver_gestion()
	{
		$actividades = new Actividad();
		$asignaciones = new Horario();
		$act_pro = $actividades->Act_Pro_eta($_REQUEST['val02']);
		/*HORARIOS  ASIGNADOS*/
		$asignacion = $asignaciones->Asignado($_REQUEST['val01'], $_REQUEST['val02']);
		$proyecto_id = $_REQUEST['val01'];
		$obj_id = 0;
		$asignacionNuevo = false;
		$asignacionNuevo = $asignaciones->AsignadoNuevo($_REQUEST['val01'], $_REQUEST['val02']);
		$asignacionNuevo2 = $asignaciones->AsignadoNuevo2($_REQUEST['val01'], $_REQUEST['val02']);
		
		require_once 'views/proyectos/ver_gestion.php';
	}
	public function Horario()
	{
		$fecha = $_REQUEST['fecha'];
		$dia = $_REQUEST['dia'];
		$usuario_id = $_REQUEST['usuario_id'];
		$hora1 = $_REQUEST['hora1'];
		$hora2 = $_REQUEST['hora2'];
		$actividad = $_REQUEST['actividad_id'];
		$etapa = $_REQUEST['etapa_plantilla_id'];
		$proyecto_id = $_REQUEST['proyecto_id'];
		$estado = $_REQUEST['estado'];
		$check = $_REQUEST['check'];
		$prioridad = $_REQUEST['prioridad']; // Nueva línea para obtener el campo prioridad


		var_dump($check); // Muestra el array check
		

		if (!empty($check)) { // Verifica que haya al menos un checkbox marcado
			foreach ($check as $key => $value):
				// Crear una nueva instancia del modelo Horario en cada iteración
				$horario = new Horario();

				$horario->fecha = $fecha[$value];
				$horario->dia = $dia[$value];
				$horario->usuario_id = $usuario_id[$value];
				$horario->actividad_id = $actividad[$value];
				$horario->hora1 = $hora1[$value];
				$horario->hora2 = $hora2[$value];
				$horario->etapa_plantilla_id = $etapa;
				$horario->proyecto_id = $proyecto_id;
				$horario->estado = $estado;
				$horario->prioridad = $prioridad[$value]; // Asigna la prioridad

				// Validar la actividad antes de registrar
				$validar = $horario->validarActividad($etapa, $actividad[$value], $proyecto_id);
				print_r( $validar);
				if (!$validar) {
					// Registrar solo si la validación no bloquea el proceso
					echo "Se puede registrar";
					$resultado = $horario->Registrar($horario);
					echo $resultado;
					if (!$resultado) {
						// Si el registro falla, mostrar error o detener el proceso
						echo "Error al registrar la actividad con ID: " . $value;
					}
				}
			endforeach;
		} else {
			echo "No se seleccionó ninguna actividad.";
		}
	}



	//GESTION DEL ROL OPERARIO: ESTA POR ENCIMA DE ASESOR
	public function IndexOperarioSup()
	{
		$proyectos = $this->model->proyectosPorOperarioSup($_SESSION['user_id']);
		//print_r($proyectos);
		$menu = new MenuController();
		$menu->layout();
		require_once 'views/proyectos/indexOperarioSup.php';
		require_once 'views/layouts/footer.php';
	}


	public function TareasDeOperarioSup()
	{
		$asignacion = $this->model->tareasAsignadasOperario($_REQUEST['val01'], $_SESSION['user_id'], $_REQUEST['val02']);
		//print_r($proyectos);
		// $menu = new MenuController();
		// $menu->layout();
		require_once 'views/proyectos/tareasOperario.php';
		//require_once 'views/layouts/footer.php';
	}
	public function GestionOperario()
	{
		//@session_start();
		$plantillas = new Proyecto();
		$etapa = new Etapa();
		$objetivo = new Objetivo();
		$actividades = new Actividad();
		$proyecto = $this->model->Obtener($_REQUEST['pid']);

		$etapas = $etapa->Listar($proyecto->plantilla_id);
		$etapasNuevas = $etapa->ListarNueva($_REQUEST['pid']);
		$objetivos = $objetivo->Obj_pro($proyecto->plantilla_id);
		$objindex = $objetivo->Obj_index($proyecto->plantilla_id);
		$act_pro = $actividades->Act_Pro($proyecto->plantilla_id);
		$_SESSION['pid'] = $proyecto->plantilla_id;

		$menu = new MenuController();
		$menu->layout();
		//require_once 'views/layouts/header.php';
		require_once 'views/proyectos/gestionOperarioSup.php';
		require_once 'views/layouts/footer.php';
	}

}
