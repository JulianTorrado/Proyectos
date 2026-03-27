<?php
//require_once 'Model/Autoload.php';
require_once 'models/Auth.php';
require_once 'models/Horario.php';
require_once 'models/Usuario.php';
require_once 'models/Tipo_usuario.php';
require_once 'models/Informe.php';
require_once 'menu.controller.php';

class MenuController
{

    public $model;
    public $practica;


    public function __CONSTRUCT()
    {
        //$this->model = new Menu();
        //$this->practica = new Practica();
        $this->model = new Usuario();
    }



    public function usuarioActual()
    {

        $cliente = new Informe();

        $clientes = $cliente->Clientes();
        $proyectos = $cliente->Proyectos();
        $planear = $cliente->Info_planear();
        $horario = $cliente->Info_crono();
        $funcionarios = $cliente->Funcionarios();
        $funci_cumplidas = $cliente->Func_cumplidas();
        $compromisos = $cliente->Compromisos();

        $actividades = $cliente->Actividadesp();
        $actividadf = $cliente->Actividadesf();
        $act = new Usuario();
        /**crm */
        $crm = $cliente->TipoCliente();
        $datosCliente = array();
        foreach ($crm as $fila) {
            $datosCliente[] = array(
                'name' => $fila->tipo_cliente,
                'value' => $fila->cantidad
            );
        }
        /**crm end */
        // Obtener los datos del modelo
        $datosActividades = $cliente->contarActividadesPorEstado();
        $d_actividad = array();
        foreach ($datosActividades as $d_a) {
            $d_actividad[] = array(
                'name' => $d_a->cumplidas,
                'value' => $d_a->no_cumplidas
            );
        }
        $ac = $cliente->ActividadesCumplidas();

        $user = $_SESSION['rol_id'];
        //echo $user ;
        $InformeActividad = $cliente->InformeActividad();
        $InformeActividadMes = $cliente->InformeActividadMes();
        switch ($user) {
            case 1:
                require_once 'views/layouts/header.php';
                require_once 'views/informes/home2.php';
                break;
            case 2:
                require_once 'views/layouts/header.php';
                require_once 'views/informes/home2.php';
                break;
            case 3:
                //ESTE ES EL LAYOUT DE OPERARIO
                require_once 'views/layouts/headerOperarioSup.php';
                require_once 'views/informes/homeOperarioSup.php';
                break;
            case 4:
                //ESTE ES EL LAYOUT DE ASESOR: la logica esta bien pero el nombre no seria headerAsesor
                require_once 'views/layouts/headerOperario.php';
                require_once 'views/informes/homeOperario.php';
                break;
            case 5:

                require_once 'views/layouts/header.php';
                require_once 'views/informes/home2.php';
                break;
        }

        require_once 'views/layouts/footer.php';
    }

    public function layout()
    {

        $user = $_SESSION['rol_id'];
        //echo $user ;
        switch ($user) {
            case 1:
                require_once 'views/layouts/header.php';
                break;
            case 2:
                require_once 'views/layouts/header.php';
                break;
            case 3:
                require_once 'views/layouts/headerOperarioSup.php';
                break;
            case 4:
                require_once 'views/layouts/headerOperario.php';
                break;
            case 5:
                require_once 'views/layouts/header.php';
                break;
        }

        //require_once 'views/layouts/footer.php';

    }
}
