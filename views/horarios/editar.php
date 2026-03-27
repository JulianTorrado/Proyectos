<div class="card">
    <div class="card-header">
        Datos de la Actividad <small><br><span><?php  echo $horarios->actividad ?></span></small>
    </div>
    <div class="card-body">
        <div class="col-md-12">

            <form action="" name="form-horario" id="form-horario">

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" id="fecha" name="fecha" placeholder="" class="form-control" value="<?php echo $horarios->fecha ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Dia</label>
                            <input type="text" id="dia" name="dia" placeholder="" class="form-control" value="<?php echo $horarios->dia ?>" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Hora Inicio</label>
                            <input type="time" id="hora1" name="hora1" value="<?php echo $horarios->hora1 ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Hora Cierre</label>
                            <input type="time" id="hora2" name="hora2" value="<?php echo $horarios->hora2 ?>" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="">Responsable</label>
                            <select name="responsable" id="responsable" class="form-control">
                                <?php  foreach($funcionarios as $value): ?>
                                <option <?php echo $value->user_id == $horarios->usuario_id ? 'selected':''?> value="<?php echo $value->user_id ?>"  ><?php echo $value->fullName ?></option>
                                 <?php  endforeach ?>
                            </select>
                        </div>
                    </div>

                       

                    <input type="hidden" id="id" name="id" value="<?php echo $horarios->id ?>">
                    <button id="botonenviar" class=" btn btn-success btn-block">Guardar</button>
                    
                </div>

            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#botonenviar').click(function() {
            if (($('#estado').val() != "")) {
                var datos = $('#form-horario').serialize();
                $.ajax({
                    type: "POST",
                    url: "?c=horarios&a=edit0",
                    data: datos,
                    success: function(r) {
                        if (r == 1) {
                            Swal.fire({
                        position: 'top-end',
                        icon: 'danger',
                        title: 'El Estado no se Actualizo con exito',
                        showConfirmButton: false,
                        timer: 1500
                    },
                    setTimeout(function() {
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
                                setTimeout(function() {
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