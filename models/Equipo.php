<?php
class Equipo
{
    private $pdo;
    public $id;
    public $nombres;
    public $apellidos;
    public $correo;
    public $contacto;
    public $cliente_id;
    public $proceso_id;

    public $usuario_id;




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
            $stm = $this->pdo->prepare("SELECT  equipos.*, procesos.proceso FROM equipos, procesos, clientes
                                              WHERE clientes.id=$id
                                              AND equipos.cliente_id=clientes.id
                                              AND equipos.proceso_id=procesos.id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Prospectos()
    {

        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT clientes.*, clientes.id as cli_id , tipo_clientes.* 
                                              FROM clientes, tipo_clientes
                                              WHERE estado_id = 1
                                              AND clientes.tipo_cliente_id = tipo_clientes.id
                                              AND tipo_cliente_id != 3                                       
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
            $stm = $this->pdo->prepare("SELECT * FROM equipos WHERE id =$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Equipo $data)
    {
        try {

            $stm = "INSERT INTO equipos(cliente_id, proceso_id, nombres, apellidos, contacto, correo,usuario_id)
                             VALUES(?, ?, ?, ?, ?, ?,?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->cliente_id,
                $data->proceso_id,
                $data->nombres,
                $data->apellidos,
                $data->contacto,
                $data->correo,
                $data->usuario_id,
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Equipo $data)
    {
        try {
            $sql = "UPDATE equipos SET cliente_id='$data->cliente_id', proceso_id='$data->proceso_id', nombres='$data->nombres',  apellidos='$data->apellidos', contacto=$data->contacto, correo = '$data->correo'  WHERE id = $data->id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function ActualizarE(Cliente $data)
    {
        $id = $data->id;
        $tipo_cliente_id = $data->tipo_cliente_id;

        try {
            $sql = "UPDATE clientes SET  tipo_cliente_id='$tipo_cliente_id'  WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Seguimientos()
    {

        try {
            //code...
            $stm = $this->pdo->prepare("SELECT clientes.id as clie_id, seguimientos.id as segui_id, seguimientos.cliente_id , COUNT(seguimientos.id) as cant
                                        FROM clientes 
                                        LEFT JOIN seguimientos ON clientes.id  = seguimientos.cliente_id
                                        AND estado_id = 1
                                        AND tipo_cliente_id != 3
                                        GROUP BY clientes.id
                                         ");

            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
