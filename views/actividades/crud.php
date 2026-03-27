<div class="card">
    <div class="card-header">
        ::REGISTRO DE ACTIVIDADES::
        <div id="tools"></div>
    </div>
    <form id="form-act" name="form-act">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <button id="addRow" type="button" class="btn btn-default"> <i class='fa fa-plus'></i> Agregar Item</button>
                </div>
                <input type="hidden" name="objetivo_id" value="<?php echo $_REQUEST['oid'] ?>">
                
                <div class="col-md-4">
                    <label for="">Actividad</label>
                    <input name="actividad[]" id="actividad" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label for="">Proceso Responsable</label>
                    <select name="proceso[]" id="proceso" class="form-control">
                        <?php foreach ($procesos as $value) {
                            echo'<option value="'.$value->id.'">'.$value->sigla.'-'.$value->proceso.'</option>';
                        } ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="">Soporte Esperado</label>
                    <input name="soporte[]" id="soporte" class="form-control" required>
                </div>
                
                <!-- Agregar el textarea para la descripción -->
                <div class="col-md-12 mt-3">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion[]" id="descripcion" class="form-control" rows="3" required></textarea>
                </div>
                
                <div id="newRow" class="col-md-12 p-0 mt-2"></div>
            </div>
        </div>
    </form>
    <div class="card-footer">
        <button id="save-act" class="btn btn-success"><i class="fa fa-save"></i> Guardar </button>
    </div>
</div>

<script type="text/javascript">
    // agregar registro
    $("#addRow").click(function() {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="col-md-12 p-0">';
        html += '<div class="input-group">';

        html += '<div class="col-md-4">';
        html += '<label for="">Actividad</label>';
        html += '<div class="input-group">';
        html += '<input name="actividad[]" id="actividad" class="form-control">';
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
        html += '<input name="soporte[]" id="soporte" class="form-control">';
        html += '<span class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
        html += '</span>';
        html += '</div>';
        html += '</div>';

        // Campo de descripción agregado
        html += '<div class="col-md-12 mt-3">';
        html += '<label for="descripcion">Descripción</label>';
        html += '<textarea name="descripcion[]" id="descripcion" class="form-control" rows="3"></textarea>';
        html += '</div>';

        html += '</div>';
        html += '</div>';
        $('#newRow').append(html);
    });

    // borrar registro
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#save-act').click(function() {
            if ($('#actividad').val() != "" && $('#descripcion').val() != "") {
                var datos = $('#form-act').serialize();
                $.ajax({
                    async: true,
                    type: "POST",
                    url: "?c=actividades&a=registrar",
                    data: datos,
                    success: function(r) {
                        if (r == 1) {
                            alert("Fallo al agregar");
                        } else {
                            Swal.fire({
                                title: '¡Registro Exitoso!',
                                text: 'Actividad registrada con éxito.',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.reload();
                                }
                            });
                        }
                    }
                });
            } else {
                alert('Campos vacíos');
            }
            return false;
        });
    });
</script>
