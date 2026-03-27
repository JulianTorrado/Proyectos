<section class="content">
    <div class="container-fluid">
        <div class="col-12"><i>REGISTRAR</i></div>
        <div class="col-12">
            <!-- Default box -->
            <form action="" method="post" id="formdata">
                <div class="row">

                    <div class="col-4">
                        <div class="form-group ">
                            <label for="nombre">Nombre</label>
                            <input type="text" name="nombre" class="form-control"
                                value='<?php echo $proyectos->nombre ?>' required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group ">
                            <label for="nombre">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" class="form-control"
                                value='<?php echo $proyectos->fecha_inicio ?>' required>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="nombre">Fecha cierre</label>
                            <input type="date" name="fecha_cierre" class="form-control"
                                value='<?php echo $proyectos->fecha_cierre ?>' required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="nombre">Cliente</label>
                            <select name="cliente_id" id="cliente_id" class="form-control">
                                <?php foreach ($clientes as $cliente): ?>
                                    <option value="<?php echo $cliente->cli_id ?>" <?php echo ($cliente->cli_id == $proyectos->cliente_id) ? 'selected' : '' ?>>
                                        <?php echo $cliente->cli_id . $cliente->nombre ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="form-group">
                            <label for="nombre">Plantilla</label>
                            <select name="plantilla_id" id="plantilla_id" class="form-control">
                                <?php foreach ($plantillas as $plantilla): ?>
                                    <option value="<?php echo $plantilla->id ?>" <?php echo ($plantilla->id == $proyectos->plantilla_id) ? 'selected' : '' ?>>
                                        <?php echo $plantilla->nombre . ' ' . $plantilla->descripcion ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                </div>
                <input type="hidden" name="id" value='<?php echo $proyectos->id ?>'>
                <input type="button" id="guardar" class="btn btn-default btn-block" value="Enviar">
            </form>
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
    $(document).on('click', '#guardar', function (e) {
        var data = $("#formdata").serialize();
        $("#index").modal('hide'); //ocultamos el modal
        $.ajax({
            data: data,
            type: "post",
            url: "?c=proyectos&a=Registrar0",
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Proyecto registrado con éxito',
                    showConfirmButton: false,
                    timer: 1500
                },
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 1500)
                )
            }
        });
    });
</script>