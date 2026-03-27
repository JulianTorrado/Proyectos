<?php
class Horario
{
    private $pdo;
    public $id;
    public $etapa_plantilla_id;
    public $actividad_id;
    public $proyecto_id;
    public $usuario_id;
    public $fecha;
    public $dia;
    public $hora1;
    public $hora2;
    public $estado;
    public $prioridad;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Obtener()
    {
        $stm = $this->pdo->prepare("SELECT horarios.*,
                                            actividades.actividad,
                                            objetivos.objetivo, 
                                            CONCAT(usuarios.nombres,' ',usuarios.apellidos) AS fullName, 
                                            proyectos.nombre, 
                                            clientes.nombre as cliente
                FROM horarios, actividades ,objetivos , usuarios,proyectos ,clientes 
                WHERE                
                     horarios.actividad_id=actividades.id
                 AND actividades.objetivo_id=objetivos.id  
                 AND horarios.usuario_id=usuarios.id
                 AND proyectos.id=horarios.proyecto_id
                 AND proyectos.cliente_id=clientes.id              
                 ");
        $stm->execute();
        return $stm->fetchAll();
    }

    public function Asignado($proyecto_id, $etapa_id)
    {
        // Consulta optimizada y segura con JOINs explícitos y parámetros preparados
        $sql = "
        SELECT horarios.prioridad,
         horarios.*, 
         horarios.id as hor_id, 
         actividades.*,
         objetivos.objetivo,        
         proyectos.*,  
                CONCAT(usuarios.nombres,' ',usuarios.apellidos) as funcionario
                FROM horarios,actividades,objetivos, proyectos, usuarios
                WHERE                
            proyecto_id=:proyecto_id
         AND etapa_plantilla_id=:etapa_id
         AND horarios.usuario_id=usuarios.id 
         AND proyectos.id=horarios.proyecto_id           
         AND horarios.actividad_id=actividades.id
         AND actividades.objetivo_id=objetivos.id         
         GROUP BY actividades.id";

        $stm = $this->pdo->prepare($sql);
        $stm->execute([
            ':proyecto_id' => $proyecto_id,
            ':etapa_id' => $etapa_id
        ]);

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }




    public function AsignadoDescricion($id)
    {

        $sql = "SELECT actividades.descripcion
        FROM horarios,actividades,objetivos, procesos, equipos, proyectos, usuarios
        WHERE                
         horarios.id = $id
         AND proyectos.id=horarios.proyecto_id   
         AND horarios.actividad_id=actividades.id
         AND actividades.objetivo_id=objetivos.id 
         AND actividades.responsable=procesos.id 
         AND equipos.cliente_id=proyectos.cliente_id 
         AND actividades.responsable=equipos.proceso_id 
         AND horarios.usuario_id=usuarios.id;
         ";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public function validarActividad($etapa, $act, $pid)
    {
        try {
            // Preparar la consulta SQL
            $sql = "SELECT * FROM horarios h WHERE h.etapa_plantilla_id = :etapa AND h.actividad_id = :act AND h.proyecto_id = :pid";
            $stm = $this->pdo->prepare($sql);

            // Ejecutar la consulta con los parámetros
            $stm->execute([
                ':etapa' => $etapa,
                ':act' => $act,
                ':pid' => $pid
            ]);

            // Retornar el resultado
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            // Capturar y mostrar cualquier error de la base de datos
            echo "Error al validar la actividad: " . $e->getMessage();
            return false; // Retornar false en caso de error
        }
    }

    public function AsignadoNuevo($proyecto_id, $etapa_id)
    {

        $sql = "
           SELECT h.*, h.id as hor_id, an.*,o.objetivo,p.proceso,py.*,eq.*,  
            CONCAT(u.nombres,' ',u.apellidos) as Responsable ,
            CONCAT(u1.nombres,' ',u1.apellidos) as funcionario
         FROM actividadesNuevas an
         JOIN horarios h ON an.id = h.actividad_id
         JOIN objetivos o ON an.objetivo_id = o.id
         LEFT JOIN usuarios u ON h.usuario_id = u.id
		 LEFT JOIN usuarios u1 ON an.responsable = u1.id
         JOIN procesos p ON an.responsable = p.id
         JOIN proyectos py ON h.proyecto_id = py.id
         LEFT JOIN equipos eq ON eq.cliente_id = py.cliente_id
         WHERE an.proyecto_id = $proyecto_id
         AND h.proyecto_id = $proyecto_id
         AND o.etapa_id = $etapa_id 
         GROUP BY an.id;
         ";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    public function AsignadoNuevo2($proyecto_id, $etapa_id)
    {

        $sql = "
           SELECT h.*, h.id as hor_id, an.*,o.objetivo,p.proceso,py.*,eq.*,  
            CONCAT(u.nombres,' ',u.apellidos) as Responsable ,
            CONCAT(u1.nombres,' ',u1.apellidos) as funcionario
         FROM actividadesNuevas an
         JOIN horarios h ON an.id = h.actividad_id
         JOIN objetivosNuevos o ON an.objetivo_id = o.id
         LEFT JOIN usuarios u ON h.usuario_id = u.id
		 LEFT JOIN usuarios u1 ON an.responsable = u1.id
         JOIN procesos p ON an.responsable = p.id
         JOIN proyectos py ON h.proyecto_id = py.id
         LEFT JOIN equipos eq ON eq.cliente_id = py.cliente_id
         WHERE an.proyecto_id = $proyecto_id
         AND h.proyecto_id = $proyecto_id
         AND o.etapa_id = $etapa_id 
         GROUP BY an.id;
         ";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }


    public function Registrar(Horario $data)
    {
        try {
            // Preparar la consulta SQL para incluir el campo de prioridad
            $stm = "INSERT INTO horarios(fecha, dia, hora1, hora2, etapa_plantilla_id, actividad_id, proyecto_id, usuario_id, estado, prioridad)
                VALUES(:fecha, :dia, :hora1, :hora2, :etapa_plantilla_id, :actividad_id, :proyecto_id, :usuario_id, :estado, :prioridad)";

            $stmt = $this->pdo->prepare($stm);

            // Asignar los parámetros usando bindParam para más claridad
            $stmt->bindParam(':fecha', $data->fecha);
            $stmt->bindParam(':dia', $data->dia);
            $stmt->bindParam(':hora1', $data->hora1);
            $stmt->bindParam(':hora2', $data->hora2);
            $stmt->bindParam(':etapa_plantilla_id', $data->etapa_plantilla_id);
            $stmt->bindParam(':actividad_id', $data->actividad_id);
            $stmt->bindParam(':proyecto_id', $data->proyecto_id);
            $stmt->bindParam(':usuario_id', $data->usuario_id);
            $stmt->bindParam(':estado', $data->estado);
            $stmt->bindParam(':prioridad', $data->prioridad);

            // Ejecutar la consulta
            $stmt->execute();

            // Retornar verdadero si se ejecutó correctamente
            return true;
        } catch (PDOException $e) {
            // Retornar el mensaje de error si algo falla
            throw new Exception("Error al registrar el horario: " . $e->getMessage());
        }
    }



    public function Ver($hid)
    {
        $stm = $this->pdo->prepare("SELECT horarios.*, actividades.actividad,objetivos.objetivo 
                FROM horarios,actividades,objetivos 
                WHERE                
                horarios.id='$hid'
                 AND horarios.actividad_id=actividades.id
                 AND actividades.objetivo_id=objetivos.id                 
                 ");
        $stm->execute();
        return $stm->fetch(PDO::FETCH_OBJ);
    }

    public function Actualizar(Horario $data)
    {
        try {
            $sql = "UPDATE horarios SET estado='$data->estado' WHERE id = '$data->id'";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function Edit0(Horario $data)
    {
        try {
            $sql = "UPDATE horarios SET fecha='$data->fecha',dia='$data->dia',hora1='$data->hora1',hora2='$data->hora2', usuario_id='$data->usuario_id' WHERE id = '$data->id'";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Borrar($id)
    {

        try {
            $sql = "DELETE  FROM  horarios WHERE id=$id ";
            $this->pdo->prepare($sql)->execute();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Proceso($cliente_id)
    {

        try {
            $sql = "SELECT id, proceso, sigla FROM procesos WHERE id=:cliente_id";
            // Preparar la consulta SQL con parámetros
            $stm = $this->pdo->prepare($sql);
            // $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Equipo($cliente_id)
    {
        try {
            $sql = "SELECT id, equipo, nombres, apellidos, correo, FROM equipos WHERE cliente_id=:cliente_id";
            // Preparar la consulta SQL con parámetros
            $stm = $this->pdo->prepare($sql);
            // $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
