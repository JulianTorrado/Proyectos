<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header"><a class="btn btn-default" onclick="Add()" data-toggle="modal" data-target="#modal-default">Nuevo</a></div>
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nit</th>
                                    <th>Ubicacion</th>
                                    <th>Tipo</th>
                                    <th>Soporte</th>
                                    <th>Potencial</th>
                                    <th>Estado</th>
                                    <th>Equipo</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $cliente) : ?>
                                    <tr>
                                        <td><?php echo  strtoupper($cliente->nombre.' '.$cliente->apellidos); ?>
                                            <?php foreach ($seguimientos as $seguimiento) : ?>
                                                <?php if ($seguimiento->cliente_id == $cliente->cli_id) : ?>
                                                    <a href="?c=seguimientos&a=index&cli_id=<?php echo $cliente->cli_id ?>"><span class="right badge badge-success"><?php echo  $seguimiento->cant ?> Seguimientos</span></a>
                                            <?php endif;
                                            endforeach; ?>
                                        </td>
                                        <td><?php echo  $cliente->nit ?></td>
                                        <td><?php echo  $cliente->ubicacion ?></td>
                                        <td><?php echo  $cliente->tipo_cliente ?></td>
                                        
                                        <td class="text-center"><?php
                                            foreach ($soportes as $value) :
                                                if ($cliente->cli_id == $value->cliente_id) : ?>
                                                    <a href="<?php echo $value->link ?>" target="_blank"><i class="fa fa-folder-open"></i></a>
                                                <?php else : ?>
                                                   
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td><?php echo  $cliente->potencial ?></td>
                                        <td><?php echo  $cliente->estado_id ? 'Activo' : 'Inactivo'; ?></td>
                                        <td style="vertical-align: middle;text-align: center;">
                                            <?php if ($cliente->tipo_cliente == 'Cliente') : ?>
                                                <a class="" onclick="Equipo('<?php echo $cliente->cli_id ?>')" data-toggle="modal" data-target="#modal-default" title="Registrar miembro del equipo de trabajo "><i  class="fa fa-user"></i></a>
                                                <!-- ASIGNAR USUARIO A EQUIPO Y PROCESO -->
                                                <a class="" onclick="asignarUsuarios('<?php echo $cliente->cli_id ?>')" data-toggle="modal" data-target="#modal-default" title="Asignar usuario al equipo"><i style="color:orange" class="fa fa-user-plus"></i></a>

                                                <a href="?c=equipos&a=index&cli_id=<?php echo $cliente->cli_id ?>" class="" title="Gestionar Equipo de trabajo "><i style="color:green" class="fa fa-users"></i></a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a class="" onclick="Edit('<?php echo $cliente->cli_id ?>')" data-toggle="modal" data-target="#modal-default" title="Actualizar datos"><i class="fa fa-edit"></i> </a>
                                            <a class="" onclick="Soporte('<?php echo $cliente->cli_id ?>')" data-toggle="modal" data-target="#modal-default" title="Anexar link Soportes"><i class="fa fa-database"></i> </a>

                                            <?php if ($cliente->tipo_cliente != 'Cliente') : ?>
                                                <a class="" onclick="Seguimiento('<?php echo $cliente->cli_id ?>')" data-toggle="modal" data-target="#modal-default" title="Registrar Seguimiento"><i class="fa fa-address-book"></i> </a>
                                                <a class="" onclick="Estado('<?php echo $cliente->cli_id ?>')" data-toggle="modal" data-target="#modal-default" title="Cambiar el status "><i class="fa fa-user"></i></a>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
</div>
<div class="modal fade" id="modal-default">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Botón de cerrar -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="index" id="index">
                </div>
            </div>
            <!-- /.modal-body -->
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>



<script>
    function Add() {
        $.ajax({
            type: "POST",
            url: '?c=clientes&a=crud',
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Edit(id) {
        $.ajax({
            type: "POST",
            url: '?c=clientes&a=crud',
            data: {
                id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Estado(id) {
        $.ajax({
            type: "POST",
            url: '?c=clientes&a=estado',
            data: {
                id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Seguimiento(id) {
        $.ajax({
            type: "POST",
            url: '?c=seguimientos&a=crud',
            data: {
                clie_id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }


    function Equipo(id) {
        $.ajax({
            type: "POST",
            url: '?c=equipos&a=crud',
            data: {
                clie_id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function asignarUsuarios(id) {
        $.ajax({
            type: "POST",
            url: '?c=equipos&a=CrudAsignar',
            data: {
                clie_id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }


    function Soporte(id) {
        $.ajax({
            type: "POST",
            url: '?c=clientes&a=soporte',
            data: {
                clie_id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }
</script>