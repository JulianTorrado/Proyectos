<?php //print_r($usuarios) ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12"><i>REGISTRAR</i></div>
        <div class="col-12">
            <!-- Default box -->
            <form action="" method="post" id="formdata">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nombre">Usuario</label>
                            <select name="usuario_data" id="usuario_data" class="form-control">
                                <option value=""> Seleccionar</option>
                                <?php foreach ($usuarios as $data): ?>
                                    <option value="<?php echo $data->id ?>">
                                        <?php echo $data->nombres . " " . $data->apellidos ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nombre">Proceso</label>
                            <select name="proceso_id" id="proceso_id" class="form-control">
                                <option value=""> Seleccionar</option>
                                <?php foreach ($procesos as $proceso): ?>
                                    <option <?php echo $proceso->id == $equipo->proceso_id ? 'selected' : '' ?>
                                        value="<?php echo $proceso->id ?>">
                                        <?php echo $proceso->proceso . '-' . $proceso->sigla ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <?php if ($equipo->id > 0): ?>
                    <input type="hidden" name="cliente_id" value='<?php echo $equipo->cliente_id ?>'>
                <?php else: ?>
                    <input type="hidden" name="cliente_id" value='<?php echo $_REQUEST['clie_id'] ?>'>
                <?php endif; ?>
                <input type="hidden" name="id" value='<?php echo $equipo->id ?>'>
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
        e.preventDefault(); // Prevenir el envío por defecto del formulario
        var $btn = $(this); // Guardar una referencia al botón
        $btn.prop('disabled', true); // Deshabilitar el botón para evitar múltiples clics

        var data = $("#formdata").serialize();
        $("#index").modal('hide'); // Ocultar el modal

        $.ajax({
            data: data,
            type: "post",
            url: "?c=equipos&a=guardar",
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: 'El registro se creó con éxito',
                    showConfirmButton: false,
                });

                setTimeout(function () {
                    // Aquí puedes recargar la página o realizar otra acción
                     window.location.reload();
                }, 1500);
            },
            error: function () {
                // En caso de error, reactivar el botón para permitir reintento
                $btn.prop('disabled', false);
                Swal.fire({
                    icon: 'error',
                    title: 'Ocurrió un error, por favor intenta nuevamente',
                });
            }
        });
    });

</script>
<style>
    .modal {
        margin-top: 10% !important;
    }
</style>