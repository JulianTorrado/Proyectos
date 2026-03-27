<?php
class Etapa_plantilla
{
    private $pdo;
    public $id;
    public $etapa_id;
    public $usuario_id;
    public $fecha1;
    public $fecha2;
    public $hora1;
    public $hora2;
    public $dias;
    public $proyecto_id;
    public $fecha;
    public $dia;

    //public $prioridad;
   


    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


 
    public function Registrar(Etapa_plantilla $data)
    {

        try {

            $stm = "INSERT INTO etapa_plantillas(etapa_id, proyecto_id,usuario_id, fecha,dia, hora1, hora2)
                             VALUES(?, ?, ?, ?, ?, ?, ?)";
            $this->pdo->prepare($stm)->execute(array(
                $data->etapa_id,
                $data->proyecto_id,
                $data->usuario_id,
                $data->fecha,
                $data->dia,
                $data->hora1,
                $data->hora2                
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarAct(Etapa_plantilla $data)
    {
        try {
            $stm = "INSERT INTO etapa_plantillas(etapa_id, proyecto_id, usuario_id, fecha, dia, hora1, hora2)
                    VALUES(:etapa_id, :proyecto_id, :usuario_id, :fecha, :dia, :hora1, :hora2)";
    
            $stmt = $this->pdo->prepare($stm);
            
            $stmt->bindParam(':etapa_id', $data->etapa_id);
            $stmt->bindParam(':proyecto_id', $data->proyecto_id);
            $stmt->bindParam(':usuario_id', $data->usuario_id);
            $stmt->bindParam(':fecha', $data->fecha);
            $stmt->bindParam(':dia', $data->dia);
            $stmt->bindParam(':hora1', $data->hora1);
            $stmt->bindParam(':hora2', $data->hora2);
    
            $stmt->execute();
    
            // Obtener el ID del último registro insertado
            $lastInsertedId = $this->pdo->lastInsertId();
    
            return $lastInsertedId;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    
    public function Actualizar(Etapa_plantilla $data)
    {
        $id = $data->id;
        $nombre = $data->nombre;
        $nit = $data->nit;
        $ubicacion = $data->ubicacion;
        $potencial =       $data->potencial;
        $interesado_en =       $data->interesado_en;
        $como_se_entero =       $data->como_se_entero;
        $tipo_cliente_id = $data->tipo_cliente_id;

        try {
            $sql = "UPDATE clientes SET nombre='$nombre', nit='$nit', ubicacion='$ubicacion', potencial='$potencial', interesado_en='$interesado_en', como_se_entero='$como_se_entero', tipo_cliente_id='$tipo_cliente_id'  WHERE id = $id";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
 
    public function Listar($pro,$eta){

        try {
            $stm = $this->pdo->prepare("SELECT * FROM etapa_plantillas WHERE etapa_id = $eta and proyecto_id=$pro ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (\Throwable $th) {
            //throw $th;
        }

    }


    

    
}
