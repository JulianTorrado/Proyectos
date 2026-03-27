<div class="card">
    <div class="card-header">
        ::REGISTRO DE OBJETIVOS::
        <div id="tools"></div>
    </div>
    <form id='form-obj' name="form-obj">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <button id="addRow" type="button" class="btn btn-default"> <i class='fa fa-plus'></i> Agregar
                        Item</button>
                </div>
                <input type="hidden" name="etapa_id" value="<?php echo $_REQUEST['eid'] ?>">
                <div class="col-md-12">
                    <br>
                    <label for="">OBJETIVO</label>
                    <textarea name="objetivo[]" class="form-control" required> </textarea>
                </div>
                <div id="newRow" class="col-md-12"></div>
            </div>
        </div>
    </form>
    <div class="card-footer">
        <button id="save-obj" class="btn btn-success"><i class="fa fa-save"></i> Guardar </button>
    </div>
</div>

<script type="text/javascript">
    // agregar registro
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">'
        html += '<div class="input-group">'
        html += '<div class="col-md-12">';
        html += '<label for="">OBJETIVO</label>';
        html += '<div class="input-group">';
        html += '<textarea name="objetivo[]" class="form-control" min="1"> </textarea>';
        html += '<span class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger "><i class="fa fa-trash"><i></button>';
        html += '</span>';
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
        $('#save-obj').click(function () {
            if (($('#objetivo').val() != "")) {
                var datos = $('#form-obj').serialize();
                $.ajax({
                    async: true,
                    type: "POST",
                    url: "?c=objetivos&a=registrar",
                    data: datos,
                    success: function (r) {
                        if (r == 1) {
                            alert("Fallo al agregar");
                        } else {
                            // alert("Agregado con éxito!!");
                            // window.location.reload();
                            Swal.fire({
                                title: '¡Registro Exitoso!',
                                text: 'Tu registro se ha completado satisfactoriamente.',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Recargar la página al cerrar la alerta
                                    location.reload();
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