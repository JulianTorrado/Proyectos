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
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Empresa</th>
                                    <th>Correo</th>
                                    <th>Identificacion</th>
                                    <th>Telefono</th>
                                    <th>Asunto</th>
                                    <th>Fecha de registro</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($interesados as $cliente) : ?>
                                    <tr>
                                        <td><?php echo  strtoupper($cliente->nombres); ?>

                                        </td>
                                        <td><?php echo  $cliente->apellidos ?></td>
                                        <td><?php echo  $cliente->nombreEmpresa ?></td>
                                        <td><?php echo  $cliente->correo ?></td>
                                        <td><?php echo  $cliente->identificacion ?></td>


                                        <td><?php echo  $cliente->telefono ?></td>
                                        <td><?php echo  $cliente->asunto ?></td>
                                        <td><?php echo  $cliente->reg_fec ?></td>
                                        <td>
                                            <a class="" onclick="Edit('<?php echo $cliente->cli_id ?>')" data-toggle="modal" data-target="#modal-default" title="Actualizar datos"><i class="fa fa-edit"></i> </a>
                                            <a class="" onclick="Soporte('<?php echo $cliente->cli_id ?>')" data-toggle="modal" data-target="#modal-default" title="Anexar link Soportes"><i class="fa fa-database"></i> </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>Identificacion</th>
                                    <th>Telefono</th>
                                    <th>Asunto</th>
                                    <th>Fecha de registro</th>
                                    <th>Menu</th>
                                </tr>
                            </tfooter>
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
                <div class="index" id="index">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
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