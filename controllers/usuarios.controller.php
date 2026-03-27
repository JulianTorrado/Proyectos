<?php
require_once 'models/Auth.php';
require_once 'models/Usuario.php';
require_once 'models/Tipo_usuario.php';
require_once 'models/Informe.php';
require_once 'menu.controller.php';





class UsuariosController
{

    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new Usuario();
    }
    public function Index()
    {
        require_once 'views/layouts/login.php';
        require_once 'views/usuarios/login.php';
    }

    public function Home()
    {
        $cliente = new Informe();
        /*$clientes = $cliente->Clientes();
        $proyectos = $cliente->Proyectos();
        $planear = $cliente->Info_planear();
        $horario = $cliente->Info_crono();
        $funcionarios = $cliente->Funcionarios();
        $funci_cumplidas = $cliente->Func_cumplidas();
        $compromisos = $cliente->Compromisos();

        $actividades = $cliente->Actividadesp();
        $actividadf = $cliente->Actividadesf();
        $act = new Usuario();
      
        $crm = $cliente->TipoCliente();
        $datosCliente = array();
        foreach ($crm as $fila) {
            $datosCliente[] = array(
                'name' => $fila->tipo_cliente,
                'value' => $fila->cantidad
            );
        }*/
        /**crm end */
        // Obtener los datos del modelo
        /*$datosActividades = $cliente->contarActividadesPorEstado();
        $d_actividad = array();
        foreach ($datosActividades as $d_a) {
            $d_actividad[] = array(
                'name' => $d_a->cumplidas,
                'value' => $d_a->no_cumplidas
            );
        }
         $ac=$cliente->ActividadesCumplidas();*/
        $menu = new MenuController();
        $menu->usuarioActual();
        //require_once 'views/layouts/header.php';
       // require_once 'views/informes/home2.php';
       // require_once 'views/layouts/footer.php';
    }




    public function Cerrar()
    {

        session_reset();
        session_destroy();
        if (isset($_REQUEST['fail'])) :
            header('Location: ../Proyectos?fail=0');
        else :
            header('Location: ../Proyectos');
        endif;
    }
    
    public function Login()
    {
        
        
        $seguridad = new Auth();
        @$clave = md5($_REQUEST['clave']);
        
        if(isset($_REQUEST['cc'])){
            @session_start();
            $clave = md5($_REQUEST['cc']);
            $datos = $seguridad->Auth($_REQUEST['cc'], $clave);
        }else{
            $datos = $seguridad->Auth($_REQUEST['usuario'], $clave);
        }
       
        //echo $_REQUEST['clave']." - ".$_REQUEST['usuario']." - ".$_REQUEST['origen'] ;
        
        if (!empty($datos)) :
           
            //session_start();
            $_SESSION['uid'] = $datos->id;
            $_SESSION['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION['fullName'] = $datos->nombres . ' ' . $datos->apellidos;
            $_SESSION['user_id'] = $datos->id;
            $_SESSION['rol_id'] = $datos->tipo_usuario;

             //print_r ($_SESSION);
            if(isset($_REQUEST['origen'])){
                echo "<script type='text/javascript'>
                window.location.href = 'https://documental.calidadsg.com/Proyectos/?c=usuarios&a=home';
                </script>";  
            }else{
              echo "<script type='text/javascript'>
                window.location.href = '?c=usuarios&a=home';
                </script>";  
            }
            

        else :
            if(isset($_REQUEST['origen'])){
                echo 0;
            }else{
              echo "<script type='text/javascript'>                 
            window.location.href = '?c=usuarios&a=cerrar&fail=0';
            </script>"; 
            }
           


        endif;
    }

    public function Usuarios()
    {
        $tipoUsuario = new Tipousuario;
        $tipoUsuarios = $tipoUsuario->Tipos_usuarios();
        $usuarios = $this->model->Listar();

        $menu = new MenuController();
        $menu->layout();
        //require_once 'views/layouts/header.php';
        require_once 'views/usuarios/index.php';
        require_once 'views/layouts/footer.php';
    }

    public function Crud()
    {
        $usuario = new Usuario;
        $tipoUsuario = new Tipousuario;
        $tipoUsuarios = $tipoUsuario->Tipos_usuarios();
        if (isset($_REQUEST['id'])) {
            $usuario =  $this->model->Obtener($_REQUEST['id']);
            //   print_r($usuario);
        }
        require_once 'views/layouts/validaciones.php';
        require_once 'views/usuarios/crud.php';
    }

    public function Config()
    {
        $usuario = new Usuario;
        $tipoUsuario = new Tipousuario;
        $tipoUsuarios = $tipoUsuario->Tipos_usuarios();
        if (isset($_REQUEST['id'])) {
            $usuario =  $this->model->Obtener($_REQUEST['id']);
            //   print_r($usuario);
        }
        require_once 'views/layouts/validaciones.php';
        require_once 'views/usuarios/config.php';
    }





    public function Registrar()
    {
        $usuario = new Usuario;
        $usuario->id = $_REQUEST['id'];
        $usuario->tipo_identificacion = $_REQUEST['tipo_identificacion'];
        $usuario->num_identificacion = $_REQUEST['num_identificacion'];
        $usuario->nombres = $_REQUEST['nombres'];
        $usuario->apellidos = $_REQUEST['apellidos'];
        $usuario->telefono = $_REQUEST['telefono'];
        $usuario->correo = $_REQUEST['correo'];
        $usuario->usuario = $_REQUEST['num_identificacion'];
        $usuario->clave = md5($_REQUEST['num_identificacion']);
        $usuario->estado = $_REQUEST['estado'];
        $usuario->tipo_usuario = $_REQUEST['tipo_usuario'];
        $usuario->created = $_REQUEST['created'];
        $usuario->modified = $_REQUEST['modified'];
        $usuario->id > 0 ?
            $this->model->Actualizar($usuario)
            : $this->model->Registrar($usuario);
    }

    public function Actualizar()
    {

        $usuario = new Usuario;
        $usuario->clave = md5($_REQUEST['num_identificacion']);
        $usuario->estado = $_REQUEST['estado'];
        $usuario->tipo_usuario = $_REQUEST['tipo_usuario'];
        require_once 'views/layouts/validaciones.php';
    }
    public function Config0()
    {
        $usuario = new Usuario;
        $usuario->id = $_REQUEST['id'];
        $usuario->clave = md5($_REQUEST['clave']);
        $usuario->estado = $_REQUEST['estado'];
        $usuario->tipo_usuario = $_REQUEST['tipo_usuario'];
        $usuario->modified = date('Y-m-d');

        $this->model->UpdateConfig($usuario);
    }

    public function Borrar()
    {
        $tipoUsuario = new Tipousuario;
        $tipoUsuarios = $tipoUsuario->Tipos_usuarios();
        require_once 'views/usuarios/add.php';
    }
}
