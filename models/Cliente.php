<?php
class Cliente
{
    private $pdo;
    public $id;
    public $nombre;
    public $apellidos;
    public $empresa;
    public $correo;
    public $telefono;
    public $nit;
    public $ubicacion;
    public $potencial;
    public $interesado_en;
    public $como_se_entero;
    public $tipo_cliente_id;
    public $clie_id;
    public $link;
    public $estado_id;



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
            $stm = $this->pdo->prepare("SELECT clientes.* , clientes.id as cli_id  , tipo_clientes.*
                                              FROM clientes, tipo_clientes
                                              WHERE estado_id=1
                                              AND clientes.tipo_cliente_id = tipo_clientes.id
                                              AND tipo_cliente_id = 3 
                                            ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarSoportes()
    {

        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * FROM clientes_soportes ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Listar0()
    {

        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT clientes.nombre , clientes.id as cli_id
                                              FROM proyectos
                                              INNER JOIN  clientes ON proyectos.cliente_id= clientes.id
                                            ");
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

public function Interesados()
    {

        try {
            $result = array();
            $stm = $this->pdo->prepare("SELECT * from interesados");
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
            $stm = $this->pdo->prepare("SELECT * FROM clientes WHERE id =$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Cliente $data)
    {

        try {

            $stm = "INSERT INTO clientes(nombre, apellidos, nombreEmpresa, correo, telefono, nit,   ubicacion, potencial, interesado_en, como_se_entero, estado_id, tipo_cliente_id)
                             VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $result = $this->pdo->prepare($stm)->execute(array(
                $data->nombre,
                $data->apellidos,
                $data->empresa,
                $data->correo,
                $data->telefono,
                $data->nit,
                $data->ubicacion,
                $data->potencial,
                $data->interesado_en,
                $data->como_se_entero,
                $data->estado_id,
                $data->tipo_cliente_id
            ));
            if($result){
                echo "Registro existoso";
            }else{
                echo "Fallo en el registro";
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actualizar(Cliente $data)
    {
        $id = $data->id;
        $nombre = $data->nombre;
        $nit = $data->nit;
        $correo = $data->correo;
        $telefono = $data->telefono;
        $ubicacion = $data->ubicacion;
        $potencial =       $data->potencial;
        $interesado_en =       $data->interesado_en;
        $como_se_entero =       $data->como_se_entero;
        $tipo_cliente_id = $data->tipo_cliente_id;

        try {
            $sql = "UPDATE clientes SET nombre='$nombre', nit='$nit', correo='$correo', telefono='$telefono', ubicacion='$ubicacion', potencial='$potencial', interesado_en='$interesado_en', como_se_entero='$como_se_entero', tipo_cliente_id='$tipo_cliente_id'  WHERE id = $id";
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


    public function Soporte($id)
    {

        try {
            $stm = $this->pdo->prepare("SELECT * FROM clientes_soportes WHERE cliente_id = $id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function SoporteAdd(Cliente $data)
    {
        print_r($data);
       
        try {
            $stm = 'INSERT INTO clientes_soportes(link, cliente_id)
                     VALUES(?, ?)';
            $this->pdo->prepare($stm)->execute(array($data->link, $data->cliente_id));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function SoporteEdit(Cliente $data)
    {

        try {
            $sql = "UPDATE clientes_soportes SET  link='$data->link'  WHERE id = '$data->id'";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
