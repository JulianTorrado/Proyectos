<div class="card card-primary card-outline">
  <div class="card-header">
    <span class="badge badge-primary float-right" id="add_etapa"><i class="fa fa-plus"></i></span>
  </div>
  <div class="card-body p-0">
    <div class="mailbox-read-info">
      <table id="" class="table table-bordered">
        <thead>
          <tr>
            <th>Notacion</th>
            <th>menu</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($etapas as $etapa):?>
          <tr>
            <td><?php echo $etapa->notacion?></td>
            <td><a id="obj">Objetivo</a></td>
          </tr>
          <?php endforeach;?>
        </tbody>
        <tfoot>
          <tr>
            <th>Notacion</th>
            <th>menu</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#add_etapa').click(function() {
      $('#info').html("<h5>Cargando Complementos</h5>");
      $.ajax({
        type: "POST",
        url: '?c=etapas&a=crud&pid=<?php echo $_REQUEST['pid'] ?>',
        //data: 'pid=' + ,
        success: function(resp) {
          $('#info').html(resp);
          $('#respuesta').html("");
        }
      });
    });

    $('#obj').click(function() {
      $('#info').html("<h5>Cargando Complementos</h5>");
      $.ajax({
        type: "POST",
        url: '?c=objetivos&a=crud&pid = <?php echo $etapa->id ?>',
        //data: 'pid=' + ,
        success: function(resp) {
          $('#info').html(resp);
          $('#respuesta').html("");
        }
      });
    });


  });
</script>