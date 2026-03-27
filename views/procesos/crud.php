<?php //print_r($cliente[1]->cli_id); ?>
<section class="content">
    <div class="container-fluid">
        <div class="col-12"><i>REGISTRAR</i></div>
        <div class="col-12">
            <!-- Default box -->
            <form action="" method="post" id="formdata">
                <div class="row">
                    <div class="col-4">
                        <div class="form-group ">
                            <label for="nombre">Procesos</label>
                            <input type="text" name="proceso" class="form-control"
                                value='<?php echo $procesos->proceso ?>' required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label for="nombre">Sigla</label>
                            <input type="text" name="sigla" class="form-control" value='<?php echo $procesos->sigla ?>'
                                required>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="cliente_id">Cliente</label>
                        <select class="form-control" name="cliente_id" id="cliente_id">

                            <?php foreach ($cliente as $data) { ?>
                                <option value="<?php echo $data->cli_id ?>" <?php echo $data->cli_id == $procesos->cliente_id ? 'selected' : '' ?>>
                                    <?php echo $data->nombre ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id" class="form-control" value='<?php echo $procesos->id ?>' required>
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
    $(document).on('click', '#guardar', function (e) {
        e.preventDefault(); // Evita el comportamiento por defecto del botón

        var $boton = $(this); // Guarda una referencia al botón
        var data = $("#formdata").serialize();

        // Deshabilita el botón para evitar múltiples clics
        $boton.prop('disabled', true);

        $("#index").modal('hide'); // Oculta el modal
        $.ajax({
            data: data,
            type: "post",
            url: "?c=procesos&a=guardar",
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: 'El registro se creó con éxito',
                    showConfirmButton: false,
                });

                setTimeout(function () {
                    window.location.reload(1);
                }, 1500);
            },
            complete: function () {
                // Rehabilitar el botón después de completar la solicitud
                $boton.prop('disabled', false);
            }
        });
    });

</script>
<style>
    .modal {
        margin-top: 10% !important;
    }
</style>