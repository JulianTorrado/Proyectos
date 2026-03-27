<?php //print_r($asignacion); 
?>
<div class="col-md-12">
    <h3 class="text-center">

        <?php
        //  echo '<pre>';
        //  print_r($asignacionNuevo);
        //  echo '</pre>';

        // print_r($_REQUEST['val01']);
        // print_r($obj_id);
        if (!empty($asignacion))
            echo $asignacion[0]->objetivo;
        else
            echo '<h4 class="text-center">No hay actividades programadas</h4>';
        ?>
    </h3>
</div>
<div class="col-md-12 mb-3">
    <!-- <a href="?c=actividadesNuevas&a=crud&pid=<?php echo $_REQUEST['pid'] ?>" class="btn btn-info" data-toggle="modal" data-target="#modelId">Agregar causa</a> -->
    <button type="button" class="btn btn-info" id="agregarActividad"
        onclick="addActividad2('<?php echo $_REQUEST['val01'] ?>','<?php echo $obj_id ?>','<?php echo $_REQUEST['val02'] ?>')"
        data-toggle="modal" data-target="#modelId" title="Agregar nueva actividad"><i class="fas fa-plus"></i>Agregar
        actividad </button>
</div>
<div class="col-md-12">
    <div class="row">
        <?php


        foreach ($asignacion as $value): ?>
            <div style="min-height: 250px;" class="col-md-4">
                <!-- Widget: user widget style 2 -->
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="card-header bg-info">
                        <?php
                        switch ($value->estado) {
                            case 0:
                                echo '<span class=" float-right badge badge-danger">Pendiente</span>';
                                break;
                            case 2:
                                echo '<span class=" float-right badge bg-orange text-white">En progreso</span>';
                                break;
                            case 1:
                                echo '<span class=" float-right badge badge-success">Hecho</span>';
                                break;
                            case 3:
                                echo '<span class=" float-right badge badge-primary">Bloqueada</span>';
                                break;
                            case 4:
                                echo '<span class=" float-right badge badge-success">Validado</span>';
                                break;
                        }
                        ?>
                        <!-- /.widget-user-image -->
                        <h5 class="widget"><?php echo $value->actividad ?></h5>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Fecha <span class="float-right badge bg-primary"><?php echo $value->fecha ?></span>
                                </a>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link">
                                    Dia <span class="float-right badge bg-success"><span
                                            class="badge float-right"><?php echo ucwords($value->dia) ?></span></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Horario <span
                                        class="float-right badge bg-info"><?php echo $value->hora1 . ' a ' . $value->hora2 ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link"
                                    onclick="Reasignar('<?php echo $value->actividad_id ?>','<?php echo $value->cliente_id ?>')"
                                    data-toggle="modal" data-target="#modelId">
                                    <?php $proceso = $asignaciones->Proceso($value->responsable);?>

                                    Proceso asociado <span class="float-right badge bg-info"><?php echo $proceso->proceso?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Responsable <span
                                        class="float-right badge bg-info"> Lider Del Proceso<?php //echo $value->nombres . ' ' . $value->apellidos 
                                                                            ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    Funcionario <span
                                        class="float-right badge bg-info"><?php echo $value->funcionario ?></span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <?php if ($value->prioridad != null) { ?>
                                    <a href="#" class="nav-link">
                                        prioridad <span class="float-right badge bg-info"><?php echo $value->prioridad ?></span>
                                    </a>
                                <?php } else { ?>
                                    <a href="#" class="nav-link">
                                        prioridad <span class="float-right badge bg-info">Sin definir</span>
                                    </a>
                                <?php } ?>


                            </li>
                        </ul>
                        <div class="card-footer d-flex justify-content-between flex-wrap">
                            <button type="button" class="btn btn-default" id="soporteVer"
                                onclick="descActividad('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                data-target="#modelId" title="Ver descripcion actividad"><i class="fas fa-tasks"></i>
                            </button>
                            <button type="button" class="btn btn-default" id="soporteVer"
                                onclick="soporteVer('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                data-target="#modelId" title="ver soportes"><i class="far fa-file"></i>
                            </button>
                            <button type="button" class="btn btn-default" id="compromisosVer"
                                onclick="compromisosVer('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                data-target="#modelId" title="Ver compromisos"><i class="fas fa-calendar-plus"></i>
                            </button>
                            <button type="button" class="btn btn-default" id="soporte"
                                onclick="soporte('<?php echo $value->hor_id ?>')" data-toggle="modal" data-target="#modelId"
                                title="registro de soportes"><i class="fas fa-paperclip"></i>
                            </button>
                            <button type="button" class="btn btn-default" id="compromisos"
                                onclick="compromisos('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                data-target="#modelId" title="registro de compromisos"><i class="fas fa-clipboard"></i>
                            </button>
                            <button type="button" class="btn btn-default" id="estados"
                                onclick="Estado('<?php echo $value->hor_id ?>')" data-toggle="modal" data-target="#modelId"
                                title="cambio de estado"><i class="far fa-clock"></i>
                            </button>
                            <button type="button" class="btn btn-default" id="estados"
                                onclick="Editar('<?php echo $value->hor_id ?>')" data-toggle="modal" data-target="#modelId"
                                title="Actualizar"><i class="far fa-edit"></i>
                            </button>
                            <a href="?c=horarios&a=borrar&id=<?php echo $value->id ?>&id=<?php echo $value->hor_id ?>"
                                onclick="return confirm('Estás seguro que deseas eliminar la actividad, esta accion no es reversible?');"
                                class="btn btn-default"><i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
        <?php endforeach;

        // echo '<pre>';
        // print_r($asignacion);
        // echo '</pre>';

        ?>
    </div>
    <!-- /.col -->
</div>

<div>
    <hr>
</div>
<?php if ($asignacionNuevo) { ?>
    <div class="col-md-12">
        <div class="row">
            <?php foreach ($asignacionNuevo as $value): ?>
                <div class="col-md-4">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="card-header bg-info">
                            <?php
                            switch ($value->estado) {
                                case 0:
                                    echo '<span class=" float-right badge badge-danger">Pendiente</span>';
                                    break;
                                case 2:
                                    echo '<span class=" float-right badge bg-orange text-white">En progreso</span>';
                                    break;
                                case 1:
                                    echo '<span class=" float-right badge badge-success">Hecho</span>';
                                    break;
                                case 3:
                                    echo '<span class=" float-right badge badge-primary">Bloqueada</span>';
                                    break;
                                case 4:
                                    echo '<span class=" float-right badge badge-success">Validado</span>';
                                    break;
                            }
                            ?>
                            <!-- /.widget-user-image -->
                            <h5 class="widget"><?php echo $value->actividad ?></h5>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Fecha <span class="float-right badge bg-primary"><?php echo $value->fecha ?></span>
                                    </a>
                                </li>
                                <li class="nav-item"><a href="#" class="nav-link">
                                        Dia <span class="float-right badge bg-success"><span
                                                class="badge float-right"><?php echo ucwords($value->dia) ?></span></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Horario <span
                                            class="float-right badge bg-info"><?php echo $value->hora1 . ' a ' . $value->hora2 ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link"
                                        onclick="Reasignar('<?php echo $value->actividad_id ?>','<?php echo $value->cliente_id ?>')"
                                        data-toggle="modal" data-target="#modelId">
                                        Proceso <span class="float-right badge bg-info"><?php echo $value->proceso ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Responsable <span
                                            class="float-right badge bg-info"><?php echo $value->Responsable ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <?php if ($value->funcionario == NULL) {
                                    ?>
                                        <a href="#" class="nav-link">
                                            Funcionario <span class="float-right badge bg-info">No se encontró</span>
                                        </a>

                                    <?php
                                    } else { ?>
                                        <a href="#" class="nav-link">
                                            Funcionario <span
                                                class="float-right badge bg-info"><?php echo $value->funcionario ?></span>
                                        </a>
                                    <?php } ?>
                                </li>
                            </ul>
                            <div class="card-footer">
                                <button type="button" class="btn btn-default" id="soporteVer"
                                    onclick="descActividad('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                    data-target="#modelId" title="Ver descripcion actividad"><i class="fas fa-tasks"></i>
                                </button>
                                <div class="float-right">
                                    <button type="button" class="btn btn-default" id="soporteVer"
                                        onclick="soporteVer('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                        data-target="#modelId" title="ver soportes"><i class="far fa-file"></i> </button>
                                    <button type="button" class="btn btn-default" id="compromisosVer"
                                        onclick="compromisosVer('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                        data-target="#modelId" title="Ver compromisos"><i class="fas fa-calendar-plus"></i>
                                    </button>
                                </div>
                                <button type="button" class="btn btn-default" id="soporte"
                                    onclick="soporte('<?php echo $value->hor_id ?>')" data-toggle="modal" data-target="#modelId"
                                    title="registro de soportes"><i class="fas fa-paperclip"></i> </button>
                                <button type="button" class="btn btn-default" id="compromisos"
                                    onclick="compromisos('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                    data-target="#modelId" title="registro de compromisos"><i class="fas fa-clipboard"></i>
                                </button>
                                <button type="button" class="btn btn-default" id="estados"
                                    onclick="Estado('<?php echo $value->hor_id ?>')" data-toggle="modal" data-target="#modelId"
                                    title="cambio de estado"><i class="far fa-clock"></i> </button>
                                <button type="button" class="btn btn-default" id="estados"
                                    onclick="Editar('<?php echo $value->hor_id ?>')" data-toggle="modal" data-target="#modelId"
                                    title="Actualizar
                            "><i class="far fa-edit"></i> </button>
                                <a href="?c=horarios&a=borrar&id=<?php echo $value->id ?>&id=<?php echo $value->hor_id ?>"
                                    onclick="return confirm('Estás seguro que deseas eliminar la actividad, esta accion no es reversible?');"
                                    class="btn btn-default"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div><?php endforeach; ?>
        </div>
        <!-- /.col -->
    </div>

<?php } ?>
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="info_modal"></div>
        </div>
    </div>
</div>
<script>
    function soporte(val) {
        var id = val
        $("#info_modal").load("?c=soportes&a=crud&id=" + id, function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }

    function addActividad2(val, obj, etapa) {
        var id = val
        $("#info_modal").load("?c=actividades_nuevas&a=Crud&pid=" + id + "&obj=" + obj + "&etapa=" + etapa, function(responseTxt, statusTxt, xhr) {


            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }

    function soporteVer(val) {
        var id = val
        $("#info_modal").load("?c=soportes&a=obtener&id=" + id, function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function descActividad(val) {
        var id = val
        $("#info_modal").load("?c=actividades&a=verDescripcion&id=" + id, function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function compromisos(val) {
        var hid = val
        $("#info_modal").load("?c=compromisos&a=crud&hid=" + hid, function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function compromisosVer(val) {
        var hid = val
        $("#info_modal").load("?c=compromisos&a=index&hid=" + hid, function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function Estado(val) {
        var hid = val
        $("#info_modal").load("?c=horarios&a=estado&hid=" + hid, function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }


    function Editar(val) {
        var hid = val
        $("#info_modal").load("?c=horarios&a=editar&hid=" + hid, function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function Borrar(val) {
        var hid = val
        $("#info_modal").load("?c=horarios&a=borrar&hid=" + hid, function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function Reasignar(act_id, cliente_id) {
        var act_id = act_id
        var cliente_id = cliente_id
        $("#info_modal").load("?c=actividades&a=reasignar&act_id=" + act_id + "&cliente_id=" + cliente_id, function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }
</script>