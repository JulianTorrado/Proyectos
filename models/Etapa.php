<?php
class Etapa
{
	private $pdo;
	public $id;
	public $nombre;
	public $descripcion;
	public $duracion;
	public $created;
	public $modified;


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
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM etapas WHERE plantilla_id=$id ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function ListarNueva($id)
	{

		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM etapasNuevas WHERE proyecto_id =$id");
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
			$stm = $this->pdo->prepare("SELECT * FROM etapas WHERE plantilla_id = $id ");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar(Etapa $data)
	{

		try {
			$stm = "INSERT INTO etapas(plantilla_id, notacion)
                             VALUES(?, ?)";
			$result = $this->pdo->prepare($stm)->execute(array(
				$data->proyecto_id,
				$data->notacion,

			));
			return $result;
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	


	public function Actualizar(Etapa $data)
	{

		try {
			$result = array();
			$sql = "UPDATE plantillas SET nombre='$data->nombre', descripcion='$data->descripcion', duracion='$data->duracion'  modified='$data->modified'  WHERE id = '$data->id'";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Etapa_act($plantilla_id)
	{

		try {

			$sql = "SELECT etapas.notacion, etapas.id as etapa_id, COUNT(actividades.id) as actividades 
			FROM `etapas`,objetivos, actividades
			WHERE
			etapas.plantilla_id=:plantilla_id
			AND
			objetivos.etapa_id=etapas.id
			AND objetivos.id=actividades.objetivo_id
			GROUP by etapas.id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute([":plantilla_id" => $plantilla_id]);
			return $stmt->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Etapa_act0($etapa_id)
	{

		try {

			$sql = "SELECT etapas.notacion, etapas.id as etapa_id, COUNT(actividades.id) as actividades 
			FROM `etapas`,objetivos, actividades
			WHERE
			etapas.id=:id
			AND
			objetivos.etapa_id=etapas.id
			AND objetivos.id=actividades.objetivo_id
			GROUP by etapas.id";
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute([":id" => $etapa_id]);
			return $stmt->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) {
			die($e->getMessage());
		}
	}


}
