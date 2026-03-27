<div class="card">
    <div class="card-header">
        Estado de la Actividad
        <small><br><span><?php /*print_r($horarios);*/ echo $horarios->actividad ?></span></small>
    </div>
    <div class="card-body">
        <div class="col-md-12">
            <form action="" name="form-horario" id="form-horario">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="text" id="notacion" name="notacion" placeholder="" class="form-control"
                                value="<?php echo $horarios->fecha ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dia</label>
                            <input type="text" id="notacion" name="notacion" placeholder="" class="form-control"
                                value="<?php echo $horarios->dia ?>" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Hora Inicio</label>
                            <input type="text" id="proyecto_id" name="proyecto_id"
                                value="<?php echo $horarios->hora1 ?>" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Hora Cierre</label>
                            <input type="text" id="proyecto_id" name="proyecto_id"
                                value="<?php echo $horarios->hora2 ?>" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Estado Actividad</label>
                            <select name="estado" id="estado" class="form-control">
                                <option value="">Seleccionar</option> <!-- este era el 0 -->
                                <option value="0">Pendiente</option> <!-- este era el 0 -->
                                <option value="2">En progreso</option>
                                <option value="1">Hecho</option> <!-- este era el 1 -->
                                <?php if($_SESSION['rol_id'] != 4) {?>
                                <option value="4">Validado</option> <!-- este era el 1 -->
                                <?php }?>

                                <option value="3">Bloqueada</option>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" id="id" name="id" value="<?php echo $horarios->id ?>">
                    <button id="botonenviar" class=" btn btn-default btn-block">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#botonenviar').click(function () {
            if (($('#estado').val() != "")) {
                var datos = $('#form-horario').serialize();
                $.ajax({
                    type: "POST",
                    url: "?c=horarios&a=actualizar",
                    data: datos,
                    success: function (r) {
                        if (r == 1) {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'danger',
                                title: 'El Estado no se Actualizo con exito',
                                showConfirmButton: false,
                                timer: 1500
                            },
                                setTimeout(function () {
                                    window.location.reload(1);
                                }, 1500)
                            )
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'El Estado se Actualizo con exito',
                                showConfirmButton: false,
                                timer: 1500
                            },
                                setTimeout(function () {
                                    window.location.reload(1);
                                }, 1500)
                            )
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