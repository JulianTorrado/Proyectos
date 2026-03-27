
<div class="card card-primary card-outline">
  <div class="card-header ">
    <h2>ETAPAS</h2>
  </div>
  <div class="card-body p-0">
    <div class="mailbox-read-info">
      <div class="col-md-12">
        <div class="row">
          <?php foreach ($etapas as $etapa) : ?>
            <?php foreach ($etapasActs as $etapasAct) : ?>
               <?php if($etapa->id == $etapasAct->etapa_id): ?>
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <div class="card-title"><?php echo $etapa->notacion ?>   </div><span class="badge badge-success float-right"> Actividades:  <?php echo $etapasAct->actividades ?></span>
                </div>
                <div class="card-body"> <a class="btn btn-default btn-block" id="obj" onclick="InfoEtapa('<?php echo $etapa->id ?>')" data-toggle="modal" data-target="#modelId" ><i class="fa fa-edit"></i> Agregar info </a>
                </div>
              </div>
            </div>
            <?php 
                  endif; 
                  endforeach; ?>
            <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
  Launch
</button> -->
<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header">
                        <h5 class="modal-title">INGRESAR DATOS DE LA ETAPA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                    </div>
            <div class="modal-body" id="infoetapa">
                <div class="container-fluid">
                    
                </div>
            </div>            
        </div>
    </div>
</div>
<script>
    $('#exampleModal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var modal = $(this);
        // Use above variables to manipulate the DOM        
    });
</script>
<script>
  
  $(document).ready(function() {
    $('#add_etapa').click(function() {
      $('#info').html("<h5>Cargando Complementos</h5>");
      $.ajax({
        async: true,
        type: "POST",
        url: '?c=etapas&a=crud&pid=<?php echo $_REQUEST['pid'] ?>',
        //data: 'pid=' + ,
        success: function(resp) {
          $('#info').html(resp);
          $('#respuesta').html("");
        }
      });
    });
  });

  function InfoEtapa(val) {

    var eid= val;
    var pid=<?php echo $_REQUEST['pid'] ?>;
    
    $.ajax({
      async: true,
      type: "POST",
      url: '?c=proyectos&a=etapa_add',
      data: {
        eid:eid,
        pid:pid
      },
      success: function(resp) {
        $('#infoetapa').html(resp);
        $('#respuesta').html("");
      }
    });
  }
</script>