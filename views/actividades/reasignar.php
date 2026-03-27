<div class="card">
    <div class="card-header">
        ::Actualizar Asignación::
        <div id="tools"></div>
    </div>
    <form id="form-act" name="form-act">
        <div class="card-body">
            <div class="row">                
                <input type="hidden" name="id" value="<?php echo $_REQUEST['act_id'] ?>">
                <div class="col-md-12">
                    <label for="">Responsable</label>
                        <select name="responsable" id="responsable" class="form-control">
                           <?php foreach ($proceso as $value):?> 
                            <option value="<?php echo $value->id ?>"><?php echo $value->sigla." ".$value->proceso ?> </option>
                            <?php endforeach; ?> 
                        </select>
                </div>
            </div>
            
   
    <div class="card-footer">
        <input type="button" id="save-act1" value="Guardar" class="btn btn-success">
        
    </div>
 </form>
</div>
<script src="assets/plugins/jquery/jquery.js"></script>
<script >
    $(document).ready(function() {
        $('#save-act1').click(function() {
           
                var datos = $('#form-act').serialize();
                $.ajax({
                    
                    type: "POST",
                    url: "?c=actividades&a=ReasignarEdit",
                    data: datos,
                    success: function(data) {
                      
                            Swal.fire({                                   
                                    icon: 'success',
                                    title: 'la Asignación se Actualizo con éxito',
                                    showConfirmButton: false,
                                    timer: 1500
                                },
                                setTimeout(function() {
                                  window.location.reload();
                                }, 1500)
                            )
                        
                    }
                });
          
        });
    });
</script>