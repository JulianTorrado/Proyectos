<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <!-- <div class="card-header"><a class="btn btn-default" onclick="Add()" data-toggle="modal" data-target="#modal-default">Nuevo</a></div> -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Proyecto</th>
                                    <th>Cliente</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Cierre</th>                                    
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($proyectos as $proyecto):?>
                                    <tr>                                        
                                        <td><?php echo  $proyecto->nombre ?></td>
                                        <td><?php echo  $proyecto->cliente ?></td>
                                        
                                        <td><?php echo  $proyecto->fecha_inicio ?></td>
                                        <td><?php echo  $proyecto->fecha_cierre ?></td>
                                        <td style="vertical-align: middle;text-align: center;">
                                            <!-- <a class="" onclick="Edit('<?php echo $proyecto->id ?>')" data-toggle="modal" data-target="#modal-default"><i class="fa fa-edit"></i></a>
                                            <a class="" onclick="Contrato('<?php echo $proyecto->id ?>')" data-toggle="modal" data-target="#modal-default"><i class="fa fa-copy"></i></a> -->
                                            <a href="?c=proyectos&a=GestionOperario&pid=<?php echo $proyecto->id ?>" ><i class="fa fa-address-book"></i> </a>
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
            url: '?c=proyectos&a=crud',
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Edit(id) {
        $.ajax({
            type: "POST",
            url: '?c=proyectos&a=crud',
            data: {
                id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }
    function Contrato(id) {
        $.ajax({
            type: "POST",
            url: '?c=soportes&a=contrato',
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
</script>