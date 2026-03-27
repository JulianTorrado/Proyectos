<?php //print_r($procesos) ?>
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
                                    <th>Proceso</th>
                                    <th>Sigla</th>
                                    <th>Empresa</th>

                                    <th></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($procesos as $value) : ?>
                                    <tr>
                                        <td><?php echo  $value->proceso;  ?>
                                            
                                        </td>
                                        <td><?php echo  $value->sigla ?></td>   
                                        <td><?php echo  $value->nombre.$value->apellidos;  ?>

                                        <td style="vertical-align: middle;text-align: center;">
                                            <a class="" onclick="Edit('<?php echo $value->proceso_id ?>')" data-toggle="modal" data-target="#modal-default"><i class="fa fa-edit"></i> </a>
                                            <a class="" onclick="Borrar('<?php echo $value->proceso_id ?>')" ><i class="fa fa-trash"></i> </a>
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
            url: '?c=procesos&a=crud',
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Edit(id) {
        $.ajax({
            type: "POST",
            url: '?c=procesos&a=crud',
            data: {
                id: id
            },
            success: function(resp) {
                $('#index').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Borrar(id) {

        if (!confirm('Realmente desea eliminar?')) {
             event.preventDefault();
           }else{
        $.ajax({
            type: "POST",
            url: '?c=procesos&a=eliminar',
            data: {
                id: id
            },


            success: function(data) {
                Swal.fire({
                        icon: 'success',
                        title: 'El registro se elimino con exito',
                        showConfirmButton: false,
                        timer: 1500
                    },
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1500)
                )
            }
        });
    }}
</script>