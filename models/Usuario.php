<?php
class Usuario
{
	private $pdo;
	public $id;
	public $tipo_identificacion;
	public $num_identificacion;
	public $nombres;
	public $apellidos;
	public $telefono;
	public $direccion;
	public $correo;
	public $foto;
	public $username;
	public $password;
	public $estado;
	public $infraestructura_id;
	public $tipo_usuario;
	public $tsangre;
	public $created;
	public $modified;
	public $alergias;
	public $genero;
	public $mreducida;

	public function __CONSTRUCT()
	{
		try {
			$this->pdo = Database::StartUp();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Listar()
	{

		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT usuarios.*,  usuarios.id as id_user , tipo_usuarios.tipo
										FROM usuarios, tipo_usuarios 
										WHERE tipo_usuario !='5'
										AND 
										usuarios.tipo_usuario=tipo_usuarios.id
										");
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
			$stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = $id ");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Registrar(Usuario $data)
	{

		try {
			$stm = "INSERT INTO usuarios(tipo_identificacion, num_identificacion, nombres, apellidos, telefono,
			                              correo, 	usuario, clave, estado, tipo_usuario, created, modified)
                             VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$this->pdo->prepare($stm)->execute(array(
				$data->tipo_identificacion,
				$data->num_identificacion,
				$data->nombres,
				$data->apellidos,
				$data->telefono,
				$data->correo,
				$data->usuario,
				$data->clave,
				$data->estado,
				$data->tipo_usuario,
				$data->created,
				$data->modified
			));
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

 public function UpdateConfig(Usuario $data){
	try {
	print_r($data);
		$sql = "UPDATE usuarios SET  clave='$data->clave', estado='$data->estado', tipo_usuario='$data->tipo_usuario', modified='$data->modified'  WHERE id = '$data->id'";
		$this->pdo->prepare($sql)->execute();
	} catch (Exception $e) {
		die($e->getMessage());
	}

 }

	public function Actualizar(Usuario $data)
	{

		try {
			$result = array();
			$sql = "UPDATE usuarios SET tipo_identificacion='$data->tipo_identificacion', num_identificacion='$data->num_identificacion', nombres='$data->nombres', apellidos='$data->apellidos', telefono='$data->telefono',
			correo='$data->correo', usuario='$data->usuario', estado='$data->estado', tipo_usuario='$data->tipo_usuario', modified='$data->modified'  WHERE id = '$data->id'";
			$this->pdo->prepare($sql)->execute();
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}

	public function Funcionarios()
	{
		try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT usuarios.id As user_id,  CONCAT(nombres,' ',apellidos) aS fullName FROM usuarios WHERE tipo_usuario IN(2,3,4) ");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	}
	
	function Hechas($proyecto_id){
	    try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT count(id) as hecha FROM horarios WHERE estado=1 AND proyecto_id='$proyecto_id' ");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	    
	    
	}
	function NoHechas($proyecto_id){
	    try {
			$result = array();
			$stm = $this->pdo->prepare("SELECT count(id) as nohecha FROM horarios WHERE estado=0 AND proyecto_id='$proyecto_id' ");
			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) {
			die($e->getMessage());
		}
	    
	    
	}
}
