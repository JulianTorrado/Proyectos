<?php //print_r($asignacion); ?>

<?php if ($asignacion) { ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                    <thead class="bg-info text-white">
                        <tr>
                            <th>Estado</th>
                            <th>Actividad</th>
                            <th>Requisito</th>
                            <th>Fecha</th>


                            <!-- <th>Proceso</th>
                        <th>Responsable</th>
                        <th>Funcionario</th> -->
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($asignacion as $value): ?>
                            <tr>
                                <td style="vertical-align: middle;text-align: center;">
                                    <?php
                                    switch ($value->estado) {
                                        case 0:
                                            echo '<span class="badge badge-danger">Pendiente</span>';
                                            break;
                                        case 2:
                                            echo '<span class="badge bg-orange text-white">En progreso</span>';
                                            break;
                                        case 1:
                                            echo '<span class="badge badge-success">Hecho</span>';
                                            break;
                                        case 3:
                                            echo '<span class="badge badge-primary">Bloqueada</span>';
                                            break;
                                        case 4:
                                            echo '<span class="badge badge-success">Validada</span>';
                                            break;
                                    }
                                    ?>
                                </td>
                                <td><?php echo $value->actividad ?></td>
                                <td><?php echo $value->objetivo ?><br>
                                    <?php
                                    $badgeClass = '';

                                    switch ($value->prioridad) {
                                        case 'Muy Alta':
                                            $badgeClass = 'badge-danger'; // Rojo para Muy Alta
                                            $prioridad = $value->prioridad;
                                            break;
                                        case 'Alta':
                                            $badgeClass = 'badge-warning'; // Amarillo para Alta
                                            $prioridad = $value->prioridad;
                                            break;
                                        case 'Media':
                                            $badgeClass = 'badge-info'; // Azul claro para Media
                                            $prioridad = $value->prioridad;
                                            break;
                                        case 'Baja':
                                            $badgeClass = 'badge-success'; // Verde para Baja
                                            $prioridad = $value->prioridad;
                                            break;
                                        default:
                                            $badgeClass = 'badge-secondary'; // Gris para cualquier otro valor
                                            $prioridad = "Sin Definir";

                                            break;
                                    }
                                    ?>

                                    <p class="badge <?php echo $badgeClass; ?>"><?php echo "Prioridad: " . $prioridad; ?></p>
                                </td>
                                <td><?php echo $value->fecha ?><br>
                                    <?php echo ucwords($value->dia) ?><br>
                                    <?php echo $value->hora1 . ' a ' . $value->hora2 ?>
                                </td>




                                <td style="vertical-align: middle;text-align: center;">

                                    <button type="button" class="btn btn-default" id="soporteVer"
                                        onclick="descActividad('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                        data-target="#modelId" title="Ver descripcion actividad"><i class="fas fa-tasks"></i>
                                    </button>
                                    <button type="button" class="btn btn-default" id="soporteVer"
                                        onclick="soporteVer('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                        data-target="#modelId" title="ver soportes"><i class="far fa-file"></i> </button>
                                    <!-- <button type="button" class="btn btn-default" id="compromisosVer"
                                        onclick="compromisosVer('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                        data-target="#modelId" title="Ver compromisos"><i class="fas fa-calendar-plus"></i>
                                    </button> -->

                                    <button type="button" class="btn btn-default" id="soporte"
                                        onclick="soporte('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                        data-target="#modelId" title="registro de soportes"><i class="fas fa-paperclip"></i>
                                    </button>
                                    <!-- <button type="button" class="btn btn-default" id="compromisos"
                                    onclick="compromisos('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                    data-target="#modelId" title="registro de compromisos"><i class="fas fa-clipboard"></i>
                                </button> -->
                                    <button type="button" class="btn btn-default" id="estados"
                                        onclick="Estado('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                        data-target="#modelId" title="cambio de estado"><i class="far fa-clock"></i>
                                    </button>
                                    <!-- <button type="button" class="btn btn-default" id="estados"
                                    onclick="Editar('<?php echo $value->hor_id ?>')" data-toggle="modal"
                                    data-target="#modelId" title="Actualizar
                            "><i class="far fa-edit"></i>
                                </button> -->
                                    <!-- <a href="?c=horarios&a=borrar&id=<?php echo $value->id ?>&id=<?php echo $value->hor_id ?>"
                                    onclick="return confirm('Estás seguro que deseas eliminar la actividad, esta accion no es reversible?');"
                                    class="btn btn-default"><i class="fas fa-trash"></i></a> -->
                </div>
                </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </table>
        </div>

    </div>

    </div>

<?php } else {?>
    <div class="col-sm-12 text-center">
        <h3>No hay actividades registradas</h3>
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
        $("#info_modal").load("?c=soportes&a=crud&id=" + id, function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }
    function addActividad2(val, obj, etapa) {
        var id = val
        $("#info_modal").load("?c=actividades_nuevas&a=Crud&pid=" + id + "&obj=" + obj + "&etapa=" + etapa, function (responseTxt, statusTxt, xhr) {


            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }

    function soporteVer(val) {
        var id = val
        $("#info_modal").load("?c=soportes&a=obtener&id=" + id, function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function compromisos(val) {
        var hid = val
        $("#info_modal").load("?c=compromisos&a=crud&hid=" + hid, function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function compromisosVer(val) {
        var hid = val
        $("#info_modal").load("?c=compromisos&a=index&hid=" + hid, function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function Estado(val) {
        var hid = val
        $("#info_modal").load("?c=horarios&a=estado&hid=" + hid, function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }


    function Editar(val) {
        var hid = val
        $("#info_modal").load("?c=horarios&a=editar&hid=" + hid, function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function Borrar(val) {
        var hid = val
        $("#info_modal").load("?c=horarios&a=borrar&hid=" + hid, function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function Reasignar(act_id, cliente_id) {
        var act_id = act_id
        var cliente_id = cliente_id
        $("#info_modal").load("?c=actividades&a=reasignar&act_id=" + act_id + "&cliente_id=" + cliente_id, function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    function descActividad(val) {
        var id = val
        $("#info_modal").load("?c=actividades&a=verDescripcion&id=" + id, function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                //alert("External content loaded successfully!");
                if (statusTxt == "error")
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
        });

    }

    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });

</script>