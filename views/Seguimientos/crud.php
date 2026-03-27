
<section class="content">
    <div class="container-fluid">
        <div class="col-12"><i>Seguimiento</i></div>
        <div class="col-12">
            <!-- Default box -->
            <form action="" method="post" id="formdata">
                <div class="row">

                    <div class="col-4">
                        <div class="form-group ">
                            <label for="fecha_control">Fecha Control</label>
                            <input type="date" name="fecha_control" class="form-control" value='<?php echo $seguimiento->fecha_control ?>' required>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group ">
                            <label for="fecha_control">Propuesta</label>
                              <select name="propuesta" id="propuesta" class="form-control">
                                <option value="">Seleccionar </option>
                                <option value="Sin Propuesta">Sin Propuesta </option>
                                <option value="Certificacion">Certificacion </option>
                                <option value="Medicina laboral">Medicina laboral </option>
                                <option value="Software">Software </option>
                                <option value="Otro">Otro </option>
                            </select>

                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group ">
                            <label for="">Metodo de Envio/contacto</label>
                            <select name="m_envio" id="m_envio" class="form-control">
                                <option value="">Seleccionar </option>
                                <option value="Telefonico">Telefonico </option>
                                <option value="E-mail">E-mail </option>
                                <option value="Mensajeria">Mensajeria </option>
                                <option value="En persona">En persona </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="info1">Informacion entregada</label>
                            <textarea type="text" name="info1" class="form-control" value='<?php echo $seguimiento->observacion ?>' required></textarea>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="form-group">
                            <label for="info2">Respuesta prospecto</label>
                            <textarea type="text" name="info2" class="form-control" value='<?php echo $seguimiento->observacion ?>' required></textarea>
                        </div>
                    </div>

                </div>
                <input type="hidden" name="creacion" value='<?php echo date('Y-m-d') ?>'>
                <input type="hidden" name="cliente_id" value='<?php echo $_REQUEST['clie_id'] ?>'>
                <input type="hidden" name="usuario_id" value='<?php echo  $_SESSION['uid'] ?>'>
                <input type="hidden" name="id" value='<?php echo $seguimiento->id ?>'>
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
    $(document).on('click', '#guardar', function(e) {
        var data = $("#formdata").serialize();
        $("#index").modal('hide'); //ocultamos el modal
        $.ajax({
            data: data,
            type: "post",
            url: "?c=seguimientos&a=guardar",
            success: function(data) {
                Swal.fire({
                    
                        icon: 'success',
                        title: 'El seguimiento se creo con exito',
                        showConfirmButton: false,
                        timer: 1500
                    },
                    setTimeout(function() {
                        window.location.reload(1);
                    }, 1500)
                )
            }
        });
    });
</script>
<style>
    .modal {
        margin-top: 10% !important;
    }
</style>