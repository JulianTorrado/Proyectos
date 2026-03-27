<?php
class Proceso
{
    private $pdo;
    public $id;
    public $proceso;
    public $sigla;

    public $cliente_id;
    public $proceso_id;


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ListarIndex()
    {
        try {
            $stm = $this->pdo->prepare("SELECT *,p.id as proceso_id  FROM procesos p JOIN clientes c ON p.cliente_id = c.id;");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function ListarPorCliente($id)
    {

        try {
            $stm = $this->pdo->prepare("SELECT * FROM procesos WHERE procesos.cliente_id = $id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Listar()
    {

        try {
            $stm = $this->pdo->prepare("SELECT * FROM procesos");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener($id)
    {

        try {
            $stm = $this->pdo->prepare("SELECT * FROM procesos WHERE id =$id ");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Registrar(Proceso $data)
    {

        try {

            $stm = "INSERT INTO procesos(proceso, sigla, cliente_id)
                             VALUES(?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->proceso,
                $data->sigla,
                $data->cliente_id,
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actualizar(Proceso $data)
    {
        $id = $data->id;
        $proceso = $data->proceso;
        $sigla = $data->sigla;
        $cliente_id = $data->cliente_id;

        try {
            $sql = "UPDATE procesos SET proceso='$proceso', sigla='$sigla', cliente_id='$cliente_id'  WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Eliminar($id)
    {

        try {
            $sql = "DELETE  FROM  procesos WHERE id=$id ";
            $this->pdo->prepare($sql)->execute();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
