<?php
require_once 'models/Auth.php';
require_once 'models/Cliente.php';
require_once 'menu.controller.php';


class ClientesController
{

    private $model;
    public $estado_id;
    public $tipo_cliente_id;

    public function __CONSTRUCT()
    {
        $this->model = new Cliente();
    }

    public function Index()
    {
        $menu = new MenuController();
        $menu->layout();
        // require_once 'views/layouts/header.php';
        $soportes = $this->model->ListarSoportes();
        $seguimientos = $this->model->Seguimientos();

        if (isset($_REQUEST['tp'])):
            $clientes = $this->model->Prospectos();
        else:
            $clientes = $this->model->Listar();

        endif;

        require_once 'views/clientes/index.php';
        require_once 'views/layouts/footer.php';
    }

    public function Interesados()
    {
        $interesados = $this->model->Interesados();
        // require_once 'views/layouts/header.php';
        $menu = new MenuController();
        $menu->layout();
        require_once 'views/clientes/interesados.php';
        require_once 'views/layouts/footer.php';
    }

    public function Crud()
    {
        $cliente = new Cliente();
        if (isset($_REQUEST['id'])) {
            $cliente = $this->model->Obtener($_REQUEST['id']);
        }
        ;
        require_once 'views/clientes/crud.php';

    }

    public function Estado()
    {
        $cliente = new Cliente();
        if (isset($_REQUEST['id'])) {
            $cliente = $this->model->Obtener($_REQUEST['id']);
        }
        ;
        require_once 'views/clientes/estado.php';

    }

    public function Guardar()
    {
        //sleep(10);
        $cliente = new Cliente();

        $cliente->id = $_REQUEST['id'];
        $cliente->nombre = $_REQUEST['nombre'];
        $cliente->apellidos = $_REQUEST['apellidos'];
        $cliente->empresa = $_REQUEST['empresa'];
        $cliente->correo = $_REQUEST['correo'];
        $cliente->telefono = $_REQUEST['telefono'];
        $cliente->nit = $_REQUEST['nit'];
        $cliente->ubicacion = $_REQUEST['ubicacion'];
        $cliente->potencial = $_REQUEST['potencial'];
        $cliente->interesado_en = $_REQUEST['interesado_en'];
        $cliente->como_se_entero = $_REQUEST['como_se_entero'];
        $cliente->tipo_cliente_id = $_REQUEST['tipo_cliente_id'];
        $cliente->estado_id = 1;

        $cliente->id > 0
            ? $this->model->Actualizar($cliente)
            : $this->model->Registrar($cliente);

    }
    public function GuardarE()
    {
        //sleep(10);
        $cliente = new Cliente();

        $cliente->id = $_REQUEST['id'];

        $cliente->tipo_cliente_id = $_REQUEST['tipo_cliente_id'];

        $this->model->ActualizarE($cliente);


    }


    public function Soporte()
    {
        $soporte = new Cliente();
        if (isset($_REQUEST['id'])) {
            $soporte = $this->model->Soporte($_REQUEST['id']);
        }
        ;
        require_once 'views/clientes/soportes.php';
    }

    public function SoporteCrud()
    {
        $soporte = new Cliente();
        $soporte->link = $_REQUEST['link'];
        $soporte->cliente_id = $_REQUEST['cliente_id'];

        $_REQUEST['link'] > 0 ?
            $this->model->SoporteEdit($soporte) :
            $this->model->SoporteAdd($soporte);




    }
}
