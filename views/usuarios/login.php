<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets\dist\css\estilos.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script>
        setTimeout(function () {
            $("#alert").fadeOut('slow');
        }, 2000);
    </script>
</head>

<body>
    <section class="login-block">
        <div id="login_content" class="container">
            <div class="row">
                <div class="col-sm-6 login-sec">
                    <img src="assets\dist\img\logoNuevo.png" alt="" width="100px" height="auto" class="user">
                    <br>
                    <h2 class="text-center">Inicia sesión ahora </h2>
                    <?php if (isset($_REQUEST['fail'])): ?>
                        <div id="alert" class="alert alert-danger">
                            Clave o usuario incorrecto, verifica y trata de nuevo
                        </div>
                    <?php endif; ?>
                    <form action="?c=usuarios&a=login" method="POST" name="form-login" id="formulario">
                        <div class="formulario__grupo" id="grupo__usuario">
                            <label for="usuario" class="formulario__label">Usuario</label>
                            <div class="formulario__grupo-input">
                                <input type="text" class="formulario__input" maxlength="10" name="usuario" id="usuario"
                                    placeholder="usuario">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">El usuario tiene que ser de 4 a 10 dígitos y solo puede
                                contener numeros, letras y guion bajo.</p>
                        </div>
                        <br>
                        <div class="formulario__grupo" id="grupo__clave">
                            <label for="clave" class="formulario__label">Contraseña</label>
                            <div class="formulario__grupo-input">
                                <input type="password" class="formulario__input" maxlength="12" name="clave"
                                    placeholder="contraseña" id="clave">
                                <i class="formulario__validacion-estado fas fa-times-circle"></i>
                            </div>
                            <p class="formulario__input-error">La contraseña tiene que ser de minimo 6 maximo 12
                                digitos.</p>
                        </div>
                        <br>
                        <div class="form-check text-center">
                            <button id="login" class="btn btn-login waves-effect">Iniciar Sesión</button>
                        </div>
                    </form>
                    <div class="copy-text">Creado por Calidadsg.com A.o.A
                        </a>
                    </div>
                </div>
                <!-- <div class="col-md-4 col-lg-4 baner-sec">
                    <img src="assets\dist\img\logoNuevo.png" alt="" width="400px" height="auto" class="ml">
                </div>-->
            </div>
        </div>
    </section>
    <script src="assets\dist\js\validaciones.js"></script>
</body>

</html>
<style type="text/css">
    @import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");

    .login-block {
        background-color: #ecf0f3;
        align-items: center;
        display: flex;
        float: right;
        width: 100vw;
        height: 100vh;
        padding: 50px 0;
    }

    .banner-sec {
        background: url(https://static.pexels.com/photos/33972/pexels-photo.jpg) no-repeat left bottom;
        background-size: cover;
        min-height: 500px;
        border-radius: 0 10px 10px 0;
        padding: 0;
    }

    .container {
        border-radius: 10px;
        align-items: center;
        margin-top: 30px;
        margin-left: 10%;

    }

    .ml {
        margin: auto;
        display: block;
        position: relative;
        margin-top: 20%;
        margin-left: 20%;
    }

    .user {
        margin: auto;
        display: flex;
    }

    .baner-sec {
        justify-content: center;
        margin-top: 5%;
    }

    .form-control:focus {
        border-color: beige;
        box-shadow: 0px 0px 1px 2px #e67817;
    }


    .login-sec {
        padding: 50px 30px;
        position: relative;
        background-color: #ecf0f3;
        border-radius: 10px;
        box-shadow: -5px -5px 10px #fff,
            5px 5px 10px #c1c1c1,
            inset 0px 0px 0px #fff,
            inset 0px 0px 0px #c1c1c1;
    }

    .login-sec .copy-text {
        position: absolute;
        width: 90%;
        bottom: 10px;
        font-size: 13px;
        text-align: center;
    }

    .login-sec .copy-text i {
        color: #FEB58A;
    }

    .login-sec .copy-text a {
        color: #E36262;
    }

    .login-sec h2 {
        margin-bottom: 30px;
        font-weight: 800;
        font-size: 30px;
        color: #707578;
    }

    .login-sec h2:after {
        content: " ";
        width: 100px;
        height: 5px;
        background: #e67817;
        display: block;
        margin-top: 20px;
        border-radius: 3px;
        margin-left: auto;
        margin-right: auto
    }

    .btn-login {
        background: #e5e5e5;
        background-size: 55px;
        text-shadow: 1px 1px 1px #c0c0c0;
        color: #000000;
        border-radius: 10px;
        box-shadow: -10px -10px 15px #fff,
            10px 10px 15px #c1c1c1,
            inset 0px 0px 0px #fff,
            inset 0px 0px 0px #c1c1c1;
        cursor: pointer;
        transition: all 300ms ease;


    }

    .btn-login:hover {
        box-shadow: 0px 0px 0px #fff,
            0px 0px 0px #c1c1c1,
            inset -10px -10px 15px #fff,
            inset 10px 10px 15px #c1c1c1;
        color: #000;
        text-shadow: 0px 0px 0px #c0c0c0;

    }

    .banner-text {
        width: 70%;
        position: absolute;
        bottom: 40px;
        padding-left: 20px;
    }

    .banner-text h2 {
        color: #fff;
        font-weight: 600;
    }

    .banner-text h2:after {
        content: " ";
        width: 100px;
        height: 5px;
        background: #FFF;
        display: block;
        margin-top: 20px;
        border-radius: 3px;
    }

    .banner-text p {
        color: #fff;
    }

    @media (max-width: 720px) {
        #Graficas {
            display: none !important;
        }

        .res-tittle {
            font-size: 0.75rem !important;
        }

        .login-sec {
            width: 100% !important;
            margin-left: 3%;
            padding: 6%;
            background-color: #ecf0f3;
            border-radius: 10px;
            box-shadow: 0px;
        }
        #login_content{
            padding-right: 50px;
        }
        #login{
            margin-bottom: 20px;
        }

    }
</style>