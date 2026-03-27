<?php
class Proyecto
{
	private $pdo;
	public $id;
	public $nombre;
	public $fecha_inicio;
	public $fecha_cierre;
	public $cliente_id;
	public $plantilla_id;



	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ListarOff()
	{

		try {
			$fecha_control = date('Y-m-d');
			$stm = $this->pdo->prepare("SELECT proyectos.*,clientes.nombre as cliente FROM proyectos,clientes 
						WHERE proyectos.cliente_id= clientes.id AND fecha_cierre >='$fecha_control'

						ORDER BY proyectos.fecha_inicio DESC");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function proyectosPorPersona($id)
	{

		try {
			$fecha_control = date('Y-m-d');
			$stm = $this->pdo->prepare("SELECT  p.id, h.usuario_id, p.nombre FROM  horarios h
										JOIN proyectos p ON h.proyecto_id = p.id
										WHERE h.usuario_id = $id
										GROUP BY p.id;");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function proyectosPorOperarioSup($id)
	{

		try {
			$fecha_control = date('Y-m-d');
			$stm = $this->pdo->prepare("SELECT p.*, c.nombre as cliente FROM proyectos p 
												JOIN equipos e ON p.cliente_id = e.cliente_id
												JOIN clientes c ON p.cliente_id = c.id
												WHERE e.usuario_id = $id AND fecha_cierre >='$fecha_control'
												GROUP BY p.id;");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function tareasAsignadas($proyecto_id, $user_id)
    {

        $sql = "SELECT horarios.prioridad, horarios.*, horarios.id as hor_id, actividades.*,objetivos.objetivo,procesos.proceso, equipos.*, proyectos.*,  CONCAT(usuarios.nombres,' ',usuarios.apellidos) as funcionario
        FROM horarios,actividades,objetivos, procesos, equipos, proyectos, usuarios
        WHERE                
         proyecto_id= $proyecto_id AND horarios.usuario_id = $user_id
         AND proyectos.id=horarios.proyecto_id   
         AND horarios.actividad_id=actividades.id
         AND actividades.objetivo_id=objetivos.id 
         /*AND actividades.responsable=procesos.id */
         /*AND equipos.cliente_id=proyectos.cliente_id */
        /* AND actividades.responsable=equipos.proceso_id */
         AND horarios.usuario_id=usuarios.id
		 GROUP BY actividades.id
         ";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

	public function tareasAsignadasOperario($proyecto_id, $user_id , $etapa)
    {

        $sql = "SELECT horarios.prioridad, horarios.*, horarios.id as hor_id, actividades.*,objetivos.objetivo,procesos.proceso, equipos.*, proyectos.*,  CONCAT(usuarios.nombres,' ',usuarios.apellidos) as funcionario
        FROM horarios,actividades,objetivos, procesos, equipos, proyectos, usuarios
        WHERE                
         proyecto_id= $proyecto_id  AND horarios.etapa_plantilla_id = $etapa
         AND proyectos.id=horarios.proyecto_id   
         AND horarios.actividad_id=actividades.id
         AND actividades.objetivo_id=objetivos.id 
         AND actividades.responsable=procesos.id 
         AND equipos.cliente_id=proyectos.cliente_id 
         AND actividades.responsable=equipos.proceso_id 
         AND horarios.usuario_id=usuarios.id
		 GROUP BY actividades.id
         ";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

	public function tareasAsignadasTotal($user_id)
    {

        $sql = "SELECT horarios.prioridad, horarios.*, horarios.id as hor_id, actividades.*,objetivos.objetivo,procesos.proceso, equipos.*, proyectos.*,  CONCAT(usuarios.nombres,' ',usuarios.apellidos) as funcionario
        FROM horarios,actividades,objetivos, procesos, equipos, proyectos, usuarios
        WHERE                
         horarios.usuario_id = $user_id
         AND proyectos.id=horarios.proyecto_id   
         AND horarios.actividad_id=actividades.id
         AND actividades.objetivo_id=objetivos.id 
         AND actividades.responsable=procesos.id 
         AND equipos.cliente_id=proyectos.cliente_id 
         AND actividades.responsable=equipos.proceso_id 
         AND horarios.usuario_id=usuarios.id
		 GROUP BY actividades.id
         ";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

	public function Listar()
	{

		try {

			$stm = $this->pdo->prepare("SELECT proyectos.*,clientes.nombre as cliente FROM proyectos,clientes WHERE proyectos.cliente_id= clientes.id ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}


	public function Obtener($id)
	{

		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM proyectos WHERE id = $id ");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}
	public function Obtener0($id)
	{

		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM proyectos WHERE cliente_id = $id ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function Registrar0(Proyecto $data)
	{
		//print_r($data);
		try {
			$stm = "INSERT INTO proyectos(plantilla_id, cliente_id, fecha_inicio,fecha_cierre, nombre)
                             VALUES(?, ?, ?, ?, ?)";
			$this->pdo->prepare($stm)->execute(array(
				$data->plantilla_id,
				$data->cliente_id,
				$data->fecha_inicio,
				$data->fecha_cierre,
				$data->nombre
			));
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function Actualizar(Proyecto $data)
	{

		try {
			$result = array();
			$sql = "UPDATE proyectos SET plantilla_id='$data->plantilla_id', cliente_id='$data->cliente_id', 	fecha_inicio='$data->fecha_inicio',  fecha_cierre='$data->fecha_cierre', nombre='$data->nombre'  WHERE id = '$data->id'";
			$this->pdo->prepare($sql)->execute();

		} catch (Exception $e) {
			die($e->getMessage());
		}

	}










}