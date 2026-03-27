<?php //print_r($objetivosNuevos) ?>

<div class="card">
    <div class="card-header">
        ::REGISTRO DE ACTIVIDADES::

        <div id="tools"></div>
    </div>
    <form id="form-act" name="form-act">
        <div class="card-body">
            <div class="row">
                <!-- <div class="col-md-12 mb-2">
                    <button id="addRow" type="button" class="btn btn-default"> <i class='fa fa-plus'></i> Agregar
                        Item</button>
                </div> -->
                <!-- <input type="hidden" name="objetivo_id" value="<?php echo $_REQUEST['obj'] ?>"> -->
                <input type="hidden" name="proyecto_id" id="proyecto_id" value="<?php echo $_REQUEST['pid'] ?>">
                <input type="hidden" name="etapa_id" value="<?php echo $_REQUEST['etapa'] ?>">

                <div class="col-md-4">
                    <label for="">Actividad</label>
                    <input name="actividad" id="actividad" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="">Proceso Reponsable</label>
                    <select name="proceso" id="proceso" class="form-control">
                        <?php foreach ($procesos as $value) {
                            echo '<option value="' . $value->id . '">' . $value->sigla . '-' . $value->proceso . '</option>';
                        } ?>

                    </select>


                </div>
                <div class="col-md-4">
                    <label for="">Soporte Esperado</label>
                    <input name="soporte" id="soporte" class="form-control" required>
                </div>
                <div class="col-12">
                    <!-- Default box -->
                    <form action="" method="post" id="form_etapa">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group ">
                                    <label for="nombre">Fecha Inicio</label>
                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control"
                                        value='' oninput="calculardiasDiscount()" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="nombre">Fecha cierre</label>
                                    <input type="date" name="fecha_cierre" id="fecha_cierre" class="form-control"
                                        value='' oninput="calculardiasDiscount()" required>
                                </div>
                            </div>

                            

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nombre">Hora Inicio</label>
                                    <input type="time" name="hora" id="hora1" class="form-control" value='08:00'
                                        min="08:00" max="18:00" required>
                                    <small>De 8am a 6pm</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nombre">Hora Fin</label>
                                    <input type="time" name="hora2" id="hora2" class="form-control" value='08:00'
                                        min="08:00" max="18:00" required>
                                    <small>De 8am a 6pm</small>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nombre">Responsable</label>
                                    <select name="usuario_id" id="usuario_id" class="form-control">
                                        <?php foreach ($usuarios as $value): ?>
                                            <option value="<?php echo $value->user_id ?>"><?php echo $value->fullName ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="nombre">Objetivo</label>
                                    <select name="objetivo_id" id="objetivo_id" class="form-control">
                                        <option>Seleccionar</option>
                                        <?php foreach ($objetivos as $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->objetivo ?>
                                            </option>
                                        <?php endforeach; ?>
                                        <?php foreach ($objetivosNuevos as $value): ?>
                                            <option value="<?php echo $value->id ?>"><?php echo $value->objetivo ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- <div class="col-12">
                    <div class="form-group">
                        <label>Responsable</label>
                        <select name="usuario_id" id="usuario_id" class="form-control">
                            <?php foreach ($usuarios as $val): ?>
                                <option value="<?php echo $val->user_id ?>">
                                    <?php echo $val->fullName ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div id="newRow" class="col-md-12 p-0 mt-2"></div> -->
            </div>
        </div>
    </form>
    <div class="card-footer">
        <button id="save-act" class="btn btn-success"><i class="fa fa-save"></i> Guardar </button>
    </div>
</div>

<script type="text/javascript">
    // agregar registro
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="col-md-12 p-0">';
        html += '<div class="input-group">';

        html += '<div class="col-md-4">';
        html += '<label for="">Actividad</label>';
        html += '<div class="input-group">';
        html += '<input name="actividad[]" id="actividad" class="form-control" >';
        html += '</div>';
        html += '</div>';

        html += '<div class="col-md-4">';
        html += '<label for="">Proceso Responsable</label>';
        html += '<div class="input-group">';
        html += '<select name="proceso[]" id="proceso" class="form-control">';
        <?php foreach ($procesos as $value) { ?>
            html += '<option value="<?php echo $value->id; ?>"><?php echo $value->sigla . '-' . $value->proceso; ?></option>';
        <?php } ?>
        html += '</select>';
        html += '</div>';
        html += '</div>';

        html += '<div class="col-md-4">';
        html += '<label for="">Soporte Esperado</label>';
        html += '<div class="input-group">';
        html += '<input name="soporte[]" id="soporte" class="form-control" >';
        html += '<span class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
        html += '</span>';
        html += '</div>';
        html += '</div>';

        html += '</div>';
        html += '</div>';
        $('#newRow').append(html);
    });

    // borrar registro
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#save-act').click(function () {
            if (($('#actividad').val() != "")) {
                var datos = $('#form-act').serialize();
                $.ajax({
                    async: true,
                    type: "POST",
                    url: "?c=actividades_nuevas&a=registrar",
                    data: datos,
                    success: function (r) {
                        if (r == 1) {
                            alert("Fallo al agregar");
                        } else {
                            // alert("Agregado con éxito!!");
                            // window.location.reload();
                            Swal.fire({
                                title: '¡Registro Exitoso!',
                                text: 'Actividad registrada con éxito.',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Recargar la página al cerrar la alerta
                                    window.location.reload();
                                }
                            });
                        }
                    }
                });
            } else {
                alert('campos vacíos');
            }
            return false;
        });
    });
</script>