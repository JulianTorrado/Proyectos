<?php
class Informe
{
    private $pdo;
    public $id;
    public $horario_id;
    public $ruta_soporte;
    public $fecha_reg;

    public function __CONSTRUCT()
    {
        try {
            $this->pdo = Database::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Clientes()
    {
        try {
            $stm = $this->pdo->prepare("SELECT tipo_clientes.tipo_cliente, 
            COUNT(*) as cantidad 
            FROM clientes, tipo_clientes 
            WHERE estado_id = 1 
            AND clientes.tipo_cliente_id = tipo_clientes.id 
             GROUP BY tipo_cliente_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Proyectos()
    {
        try {
            $stm = $this->pdo->prepare("SELECT proyectos.nombre, COUNT(*) as cantidad FROM proyectos, clientes WHERE  proyectos.cliente_id = clientes.id  GROUP BY plantilla_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Info_planear()
    {
        try {
            $stm = $this->pdo->prepare("SELECT C.id as c_id, C.nombre as cli_nom, P.nombre, P.id as p_id ,P.fecha_inicio, P.fecha_cierre
                                        FROM   clientes C
                                            INNER JOIN  proyectos P ON C.id=P.cliente_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    } //proyectos P, etapas E, objetivos O, actividades A

    public function Info_crono()
    {
        try {
            $stm = $this->pdo->prepare("SELECT H.id, H.fecha, H.dia, H.hora1, H.hora2, H.etapa_plantilla_id 
                                        FROM   proyectos P
                                            INNER JOIN  horarios H ON H.proyecto_id=P.id
                                            WHERE
                                                 P.id=1");
            $stm->execute();
            $Data = array();

            while ($row = $stm->fetch(PDO::FETCH_ASSOC)) {

                $Data[] = $row;
            }

            // echo json_encode($Data);

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Info_fechamin($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT  MIN(fecha) as finicio 
                                        FROM   horarios
                                          WHERE
                                               horarios.proyecto_id=$id");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Info_fechamax($id)
    {
        try {
            $stm = $this->pdo->prepare("SELECT  MAX(fecha) as ffin 
                                        FROM   horarios
                                          WHERE
                                               horarios.proyecto_id=$id");
            $stm->execute();
            return $stm->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }



    public function Info_desarrollo()
    {
        try {
            $stm = $this->pdo->prepare("SELECT proyectos.nombre, COUNT(*) as cantidad FROM proyectos, clientes WHERE  proyectos.cliente_id = clientes.id  GROUP BY plantilla_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Etapas($id)
    { //todas las act
        try {
            $stm = $this->pdo->prepare("SELECT COUNT(actividad_id) As total_Act, etapas.notacion, horarios.etapa_plantilla_id,horarios.proyecto_id 
                                        FROM horarios, etapas 
                                        WHERE proyecto_id=$id  
                                        AND etapas.id=horarios.etapa_plantilla_id  
                                        
                                        GROUP BY etapa_plantilla_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Etapas0($id)
    { //todas las act
        try {
            $stm = $this->pdo->prepare("SELECT COUNT(actividad_id) As total_Act, etapas.notacion, horarios.etapa_plantilla_id,horarios.proyecto_id 
                                        FROM horarios, etapas  
                                        WHERE proyecto_id=$id  
                                        AND etapas.id=horarios.etapa_plantilla_id  
                                        AND horarios.estado!=0 
                                        GROUP BY etapa_plantilla_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Objetivo($id)
    { //todas las act
        try {
            $stm = $this->pdo->prepare("SELECT COUNT(horarios.id) As actividades , objetivos.objetivo, objetivos.id as obj_id, etapas.notacion
                                        FROM actividades
                                          LEFT JOIN horarios ON actividades.id=horarios.actividad_id
                                          LEFT JOIN objetivos ON actividades.objetivo_id =objetivos.id
                                          INNER JOIN etapas on objetivos.etapa_id=etapas.id
                                        WHERE horarios.proyecto_id=$id
                                        
                                        group by actividades.objetivo_id
                                        ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Objetivo0($id)
    { //todas las act
        try {
            $stm = $this->pdo->prepare("SELECT COUNT(horarios.id) As actividades , objetivos.objetivo, objetivos.id as obj_id
                                        FROM actividades
                                          LEFT JOIN horarios ON actividades.id=horarios.actividad_id
                                          LEFT JOIN objetivos ON actividades.objetivo_id =objetivos.id
                                        WHERE horarios.proyecto_id=$id
                                        AND
                                        horarios.estado = 1
                                        group by actividades.objetivo_id
                                        ");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Funcionarios()
    {

        try {
            $stm = $this->pdo->prepare("SELECT COUNT(horarios.id) As amount, TIMEDIFF(horarios.hora1, horarios.hora2) as horas, CONCAT(usuarios.nombres,' ',usuarios.apellidos) as fullName , usuarios.id as user_id
                                        FROM horarios
                                          LEFT JOIN usuarios ON usuarios.id=horarios.usuario_id                                          
                                        group by horarios.usuario_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Func_cumplidas()
    {

        try {
            $stm = $this->pdo->prepare("SELECT COUNT(horarios.id) As amount, TIMEDIFF(horarios.hora1, horarios.hora2) as horas, usuarios.id as user_id
                                        FROM horarios
                                          LEFT JOIN usuarios ON usuarios.id=horarios.usuario_id  
                                          where horarios.estado = 1                                        
                                        group by horarios.usuario_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }





    public function Compromisos()
    {
        try {
            $stm = $this->pdo->prepare("SELECT COUNT(compromisos.id) AS cantidad,  actividades.actividad, horarios.fecha, compromisos.descripcion,compromisos.fecha as comp_fecha,proyectos.nombre as pro, clientes.nombre 
                                        FROM actividades
                                         INNER JOIN horarios ON actividades.id=horarios.actividad_id
                                         INNER JOIN compromisos ON horarios.id=compromisos.horario_id
                                         INNER JOIN proyectos ON proyectos.id=horarios.proyecto_id
                                         INNER JOIN clientes ON  proyectos.cliente_id = clientes.id 
                                         AND compromisos.estado != 1
                                         GROUP BY horarios.actividad_id");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Actividadesp()
    {
        try {
            $stm = $this->pdo->prepare("SELECT actividades.actividad, horarios.id AS hid,horarios.fecha AS hfecha,proyectos.nombre as pro, clientes.nombre 
                                        FROM actividades
                                         INNER JOIN horarios ON actividades.id=horarios.actividad_id
                                         INNER JOIN proyectos ON proyectos.id=horarios.proyecto_id
                                         INNER JOIN clientes ON  proyectos.cliente_id = clientes.id 
                                         AND horarios.estado != 1
                                         AND horarios.proyecto_id NOT IN (10,11,8)
                                         ORDER BY horarios.fecha");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ActividadesAsignadas($usuario, $fecha)
    {

        try {
            $stm = $this->pdo->prepare("SELECT h.*, h.id as hor_id, an.*,o.objetivo,p.proceso,py.*,eq.*,  
            CONCAT(u.nombres,' ',u.apellidos) as Responsable,
            CONCAT(u1.nombres,' ',u1.apellidos) as funcionario
             FROM actividadesNuevas an
             JOIN horarios h ON an.id = h.actividad_id
             JOIN objetivos o ON an.objetivo_id = o.id
             LEFT JOIN usuarios u ON h.usuario_id = u.id
             LEFT JOIN usuarios u1 ON an.responsable = u1.id
             JOIN procesos p ON an.responsable = p.id
             JOIN proyectos py ON h.proyecto_id = py.id
             LEFT JOIN equipos eq ON eq.cliente_id = py.cliente_id
             WHERE h.usuario_id = $usuario AND h.fecha = '$fecha'
             GROUP BY an.id;");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Actividadesf()
    {
        try {
            $stm = $this->pdo->prepare("SELECT actividades.actividad, horarios.id AS hid,horarios.fecha AS hfecha,proyectos.nombre as pro, clientes.nombre 
                                        FROM actividades
                                         INNER JOIN horarios ON actividades.id=horarios.actividad_id
                                         INNER JOIN proyectos ON proyectos.id=horarios.proyecto_id
                                         INNER JOIN clientes ON  proyectos.cliente_id = clientes.id 
                                         AND horarios.estado != 0
                                         AND horarios.proyecto_id NOT IN (10,11,8)
                                         ORDER BY horarios.fecha");
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Reporte($pid)
    {
        $hoy = date('Y-m-d');
        $sql = "SELECT  CONCAT( usuarios.nombres,' ',usuarios.apellidos) AS fullName,   actividades.actividad,etapas.notacion, horarios.fecha,horarios.estado, proyectos.nombre as pro, clientes.nombre 
            FROM actividades
             JOIN horarios ON actividades.id=horarios.actividad_id  
              JOIN usuarios ON  horarios.usuario_id = usuarios.id            
              JOIN proyectos ON proyectos.id=horarios.proyecto_id
              JOIN etapas ON etapas.id= horarios.etapa_plantilla_id
              JOIN clientes ON  proyectos.cliente_id = clientes.id             
                WHERE proyectos.id=$pid 
                -- AND horarios.estado=0 
             ";
        try {
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    public function TipoCliente()
    {
        //    $sql="SELECT tipo_cliente_id, COUNT(*) AS cantidad FROM clientes GROUP BY tipo_cliente_id";
        $sql = "SELECT tipo_clientes.tipo_cliente, COUNT(clientes.id) as cantidad
       FROM clientes
       JOIN tipo_clientes ON clientes.tipo_cliente_id = tipo_clientes.id
       GROUP BY tipo_clientes.tipo_cliente;
       ";
        $stm = $this->pdo->prepare($sql);
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

    function contarActividadesPorEstado()
    {

        $sql = "SELECT 
                    COUNT(CASE WHEN horarios.estado = 1 THEN 1 END) AS cumplidas,
                    COUNT(CASE WHEN horarios.estado = 0 THEN 1 END) AS no_cumplidas,
                    COUNT(*) AS total
                FROM 
                    actividades
                    INNER JOIN horarios ON actividades.id = horarios.actividad_id
                WHERE 
                    horarios.proyecto_id NOT IN (10, 11, 8)";

        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();

        $resultado = $consulta->fetchAll(PDO::FETCH_OBJ);

        return $resultado;
    }
    public function ActividadesCumplidas()
    {
        $sql = "SELECT COUNT(horarios.id) AS amount,
        TIMEDIFF(horarios.hora1, horarios.hora2) AS horas,
        CONCAT(usuarios.nombres, ' ', usuarios.apellidos) AS fullName,
        usuarios.id AS user_id,
        SUM(CASE WHEN horarios.estado = 1 THEN 1 ELSE 0 END) AS completed_activities,
        SUM(CASE WHEN horarios.estado = 1 THEN 1 ELSE 0 END)/COUNT(horarios.id)*100 AS percentage_completed
        FROM horarios
        LEFT JOIN usuarios ON usuarios.id = horarios.usuario_id
        GROUP BY horarios.usuario_id
        ORDER BY COUNT(horarios.id) DESC;";

        $consulta = $this->pdo->prepare($sql);
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_OBJ);
    }

    public function InformeActividad()
    {
        try {
            // Consulta a la vista
            $sql = "SELECT * FROM informe_actividad";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            // Obtener resultados
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultados;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public function InformeActividadMes()
    {
        try {
            // Consulta a la vista
            $sql = "SELECT * FROM informe_actividad_mes";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            // Obtener resultados
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultados;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
