<?php
class Actividad
{
	private $pdo;
	public $id;
	public $objetivo_id;
	public $actividad;
	public $descripcion;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar($id)
	{

		try {
			$stm = $this->pdo->prepare("SELECT * FROM actividades WHERE objetivo_id=$id ");
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

	public function Registrar(Actividad $data)
	{
		foreach ($data->actividad as $key => $cantidades) {
			try {
				// Agregar el nuevo campo 'descripcion' en la consulta SQL
				$stm = "INSERT INTO actividades(objetivo_id, actividad, responsable, soporte, descripcion)
                    VALUES(?, ?, ?, ?, ?)";

				// Ejecutar la consulta con los valores correspondientes
				$this->pdo->prepare($stm)
					->execute(
						array(
							$data->objetivo_id,
							$data->actividad[$key],
							$data->proceso[$key],
							$data->soporte[$key],
							$data->descripcion[$key] // Nuevo campo de descripción
						)
					);
			} catch (Exception $e) {
				die($e->getMessage());
			}
		}
	}



	public function Actualizar(Actividad $data)
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

	public function ReasignarEdit(Actividad $data)
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