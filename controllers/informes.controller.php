<?php
require_once 'models/Auth.php';
require_once 'models/Informe.php';
require_once 'models/Cliente.php';
require_once 'models/Proyecto.php';
require_once 'models/Usuario.php';
require_once 'menu.controller.php';


class InformesController
{
    private $model;
    private $usuario;
    private $Proyectos;
  

    public function __CONSTRUCT()
    {
        $this->model = new Informe();
        $this->usuario = new Usuario();
        $this->Proyectos = new Proyecto();
 
    }

    public function Etapas()
    {
        /*consultar el avance en elcumplimiento de los objetivos*/
        //  echo $_REQUEST['pid'];
        $etapas = $this->model->Etapas($_REQUEST['pid']);
        // print_r($etapas);
        $etapas0 = $this->model->Etapas0($_REQUEST['pid']);
        // print_r($etapas0);
        require_once 'views/informes/etapas.php';
    }
    public function Objetivos()
    {

        $objetivos = $this->model->Objetivo($_REQUEST['pid']);
        $objetivos0 = $this->model->Objetivo0($_REQUEST['pid']);
        require_once 'views/informes/objetivos.php';
    }
    public function TareasAsignadas(){
        $asignacion = $this->Proyectos->tareasAsignadasTotal($_SESSION['user_id']);
		//print_r($proyectos);
		$menu = new MenuController();
        $menu->layout();
		require_once 'views/proyectos/tareasOperario.php';
		require_once 'views/layouts/footer.php';
    }

    public function Reportes()
    {

        $cliente = new Cliente();
        $clientes = $cliente->Listar0();
        //print_r($clientes);
        $menu = new MenuController();
        $menu->layout();
       // require_once 'views/layouts/header.php';
        require_once 'views/informes/reporte.php';
        require_once 'views/layouts/footer.php';
    }
    public function Proyectos()
    {

        $proyecto = new Proyecto();
        $proyectos = $proyecto->Obtener0($_REQUEST['cliente']);
        // print_r($proyectos);

        echo '<label>Proyectos</label>';
        echo '<select name="proyecto_id" id="proyecto_id" class="form-control">';
        foreach ($proyectos as $value0) :
            echo '<option value="';
            echo  $value0->id;
            echo '">';
            echo  $value0->nombre . '</option>';
        endforeach;
        echo  '</select>';
    }
    public function Resultado()
    {
        $reporte = $this->model->Reporte($_REQUEST['proyecto_id']);
        require_once 'views/informes/resultado.php';
        require_once 'views/layouts/footerfiltro.php';
    }
    /**dashboard  actividades  logradas**/

    public function Al()
    {
        $actividadf=$this->model->Actividadesf();
        $menu = new MenuController();
        $menu->layout();
        //require_once 'views/layouts/header.php';     
        require_once 'views/informes/al.php';
        require_once 'views/layouts/footer.php';
    }
    public function Ap()
    {
        $fecha = date('Y-m-d');
        $actividades =$this->model->Actividadesp();
        $asignacionNuevo =$this->model->ActividadesAsignadas($_SESSION['uid'], $fecha);
        $menu = new MenuController();
        $menu->layout();
        // require_once 'views/layouts/header.php';     
        // require_once 'views/informes/ap.php';
        require_once 'views/informes/ActividadesDeHoy.php';
        require_once 'views/layouts/footer.php';
    }
    public function Cp()
    {
        $compromisos = $this->model->Compromisos();
        $menu = new MenuController();
        $menu->layout();
        // require_once 'views/layouts/header.php';     
        require_once 'views/informes/cp.php';
        require_once 'views/layouts/footer.php';
    }
    public function Pf()
    {
        $funcionarios = $this->model->Funcionarios();
        $funci_cumplidas = $this->model->Func_cumplidas();
        $menu = new MenuController();
        $menu->layout();
        //require_once 'views/layouts/header.php';     
        require_once 'views/informes/pf.php';
        require_once 'views/layouts/footer.php';
    }

    public function EstProyecto()
    {

        $cliente = new Informe();

        $clientes = $cliente->Clientes();
        $proyectos = $cliente->Proyectos();
        $planear = $cliente->Info_planear();
        $horario = $cliente->Info_crono();

        $funcionarios = $cliente->Funcionarios();
        $funci_cumplidas = $cliente->Func_cumplidas();

        $compromisos = $cliente->Compromisos();
        $actividades =$cliente->Actividadesp();
        $actividadf=$cliente->Actividadesf();
        
        $act= new Usuario();   
        $menu = new MenuController();
        $menu->layout();
        //require_once 'views/layouts/header.php';        
        require_once 'views/informes/est_proyectos.php';
        require_once 'views/layouts/footer.php';
    }

}
