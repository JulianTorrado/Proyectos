<?php //print_r($_SESSION['uid']) ?>
<div class="card">
    <div class="card-header">
        ::REGISTRO DE ACTIVIDADES::
        <div id="tools"></div>
    </div>
    <form id="form-act" name="form-act">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="nombre">Proyecto</label>
                        <select name="proyecto_id" id="proyecto_id" onchange="CargarEtapas();" class="form-control">
                            <option>Seleccionar</option>
                            <?php foreach ($proyectos as $value): ?>
                                <option value="<?php echo $value->id ?>"><?php echo $value->nombre ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-4" id="Etapas">
                    <div class="form-group">
                        <label for="nombre">Etapa</label>
                        <select name="etapa_id" id="etapa_id" onchange="CargarObjetivos();" class="form-control">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="col-4" id="Objetivos">
                    <div class="form-group">
                        <label for="nombre">Objetivos</label>
                        <select name="objetivo_id" id="objetivo_id" class="form-control">
                            <option>Seleccionar</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <label for="">Actividad</label>
                    <input name="actividad" id="actividad" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="proceso">Proceso Responsable</label>
                    <select name="proceso" id="proceso" class="form-control">
                        <?php foreach ($procesos as $value): ?>
                            <option value="<?php echo $value->id ?>"><?php echo $value->sigla . '-' . $value->proceso ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-4">
                            <div class="form-group">
                                <label for="hora1">Hora Inicio</label>
                                <input type="time" name="hora1" id="hora1" class="form-control" value='08:00'
                                    min="08:00" max="18:00" required>
                                <small>De 8am a 6pm</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="hora2">Hora Fin</label>
                                <input type="time" name="hora2" id="hora2" class="form-control" value='08:00'
                                    min="08:00" max="18:00" required>
                                <small>De 8am a 6pm</small>
                            </div>
                        </div>
                <!-- <div class="col-md-4">
                    <label for="soporte">Soporte Esperado</label>
                    <input name="soporte" id="soporte" class="form-control" required>
                </div> -->
            </div>

            <!-- <div class="col-12"> -->
                <!-- Default box -->
                <!-- <form action="" method="post" id="form_etapa"> -->
                    <div class="row">
                        <!-- <div class="col-6">
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha Inicio</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value=''
                                    required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fecha_cierre">Fecha Cierre</label>
                                <input type="date" name="fecha_cierre" id="fecha_cierre" class="form-control" value=''
                                    required>
                            </div>
                        </div> -->

                        <!-- <div class="col-4">
                            <div class="form-group">
                                <label for="usuario_id">Responsable</label>
                                <select name="usuario_id" id="usuario_id" class="form-control">
                                    <?php foreach ($usuarios as $value): ?>
                                        <option value="<?php echo $value->user_id ?>"><?php echo $value->fullName ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div> -->
                    </div>
                <!-- </form> -->
            <!-- </div> -->
        </div>
    </form>
    <div class="card-footer">
        <button id="save-act" class="btn btn-success"><i class="fa fa-save"></i> Guardar </button>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#save-act').click(function () {
            if ($('#actividad').val() != "") {
                var datos = $('#form-act').serialize();
                $.ajax({
                    async: true,
                    type: "POST",
                    url: "?c=actividades_nuevas&a=registrarExt",
                    data: datos,
                    success: function (r) {
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

    function CargarEtapas() {
        var proyecto_id = $('#proyecto_id').val();
        $.ajax({
            type: "POST",
            url: "?c=actividades_nuevas&a=VerEtapas",
            data: { proyecto_id: proyecto_id },
            success: function (response) {
                var etapas = JSON.parse(response);
                var etapasSelect = $('#etapa_id');
                etapasSelect.empty();
                if (etapas.length === 0) {
                    etapasSelect.append('<option>Sin etapas disponibles</option>');
                } else {
                    etapasSelect.append('<option>Seleccionar</option>');
                    $.each(etapas, function (index, etapa) {
                        etapasSelect.append('<option value="' + etapa.id + '">' + etapa.notacion + '</option>');
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron cargar las etapas.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }

    function CargarObjetivos() {
        var etapa_id = $('#etapa_id').val();
        $.ajax({
            type: "POST",
            url: "?c=actividades_nuevas&a=VerObjetivos",
            data: { etapa_id: etapa_id },
            success: function (response) {
                var objetivos = JSON.parse(response);
                var objetivosSelect = $('#objetivo_id');
                objetivosSelect.empty();
                if (objetivos.length === 0) {
                    objetivosSelect.append('<option>Sin objetivos disponibles</option>');
                } else {
                    objetivosSelect.append('<option>Seleccionar</option>');
                    $.each(objetivos, function (index, objetivo) {
                        objetivosSelect.append('<option value="' + objetivo.id + '">' + objetivo.objetivo + '</option>');
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron cargar los objetivos.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    }
</script>