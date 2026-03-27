<?php
class ActividadNueva
{
	private $pdo;
	public $id;
	public $objetivo_id;
	public $proyecto_id;
	public $proceso;

	public $soporte;
	public $actividad;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar($pid, $obj)
	{

		try {
			$stm = $this->pdo->prepare("SELECT * FROM actividades WHERE objetivo_id=$pid ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Obtener($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM plantillas WHERE id = $id ");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Proyectos()
	{
		try {
			$stm = $this->pdo->prepare("SELECT proyectos.*,clientes.nombre as cliente FROM proyectos,clientes WHERE proyectos.cliente_id= clientes.id AND fecha_cierre >= CURDATE(); ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Etapas($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * From(
						SELECT p.plantilla_id FROM proyectos p
						WHERE p.id = $id) as dato, etapas e
						WHERE e.plantilla_id = dato.plantilla_id;");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function ObjetivosExt($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM `objetivos`
											WHERE etapa_id = $id;");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Objetivos($id)
	{
		try {
			$stm = $this->pdo->prepare("SELECT *  FROM `objetivos` WHERE `etapa_id` = $id ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function ObjetivosNuevos($id, $pid)
	{
		try {
			$stm = $this->pdo->prepare("SELECT *  FROM `objetivosNuevos` WHERE `etapa_id` = $id AND proyecto_id = $pid ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar(ActividadNueva $data)
	{


		try {
			$stm = "INSERT INTO actividadesNuevas(objetivo_id, proyecto_id, actividad, responsable, soporte)
                    VALUES(:objetivo_id, :proyecto_id, :actividad, :responsable, :soporte)";

			$stmt = $this->pdo->prepare($stm);

			// foreach ($data->actividad as $key => $cantidad) {
			$stmt->bindParam(':objetivo_id', $data->objetivo_id);
			$stmt->bindParam(':proyecto_id', $data->proyecto_id);
			$stmt->bindParam(':actividad', $data->actividad);
			$stmt->bindParam(':responsable', $data->proceso);
			$stmt->bindParam(':soporte', $data->soporte);

			$stmt->execute();
			// }

			// Obtener el ID del último registro insertado
			$lastInsertedId = $this->pdo->lastInsertId();

			return $lastInsertedId;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


	public function Actualizar(ActividadNueva $data)
	{

		try {
			$result = array();
			$sql = "UPDATE plantillas SET nombre='$data->nombre', descripcion='$data->descripcion', duracion='$data->duracion'  modified='$data->modified'  WHERE id = '$data->id'";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Obj_pro($pid)
	{
		/*consultar todos los objetivos  de todo el proyecto*/
		try {
			$stm = $this->pdo->prepare("SELECT COUNT(objetivos.objetivo) AS num_obj FROM  plantillas, etapas, objetivos 
										WHERE plantillas.id=$pid
										AND plantillas.id= etapas.plantilla_id
										AND etapas.id=objetivos.etapa_id 
										ORDER BY etapas.id");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	public function Act_Pro($pid)
	{
		/*consultar todos los objetivos de todo el proyecto*/
		try {
			$stm = $this->pdo->prepare("SELECT etapas.*, etapas.id as et_id ,objetivos.id as obj_id, objetivos.objetivo as obj, actividades.actividad as act,  actividades.id as act_id
			                            FROM  etapas, objetivos, actividades 
										WHERE 
										     etapas.plantilla_id=$pid
										AND etapas.id = objetivos.etapa_id
										AND objetivos.id = actividades.objetivo_id
										ORDER BY etapas.id ASC");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Act_Pro_eta($eid)
	{
		/*consultar todos los objetivos de todo el proyecto*/
		try {
			$stm = $this->pdo->prepare("SELECT etapas.*, etapas.id as et_id ,objetivos.id as obj_id, objetivos.objetivo as obj, actividades.actividad as act,  actividades.id as act_id
			                            FROM  etapas, objetivos, actividades 
										WHERE 
										     etapas.id=$eid
										AND etapas.id = objetivos.etapa_id
										AND objetivos.id = actividades.objetivo_id
										ORDER BY etapas.id ASC");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Proceso()
	{
		try {
			$stm = $this->pdo->prepare("SELECT * FROM procesos");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}

	}

	public function ReasignarEdit(ActividadNueva $data)
	{

		try {
			$result = array();
			$sql = "UPDATE actividades SET responsable='$data->responsable'  WHERE id = '$data->id'";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


}