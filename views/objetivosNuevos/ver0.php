<div class="card card-primary card-outline">
    <div class="card-header">
        <h3>OBJETIVOS</h3>
    </div>
    <div class="card-body p-0">
        <div class="mailbox-read-info">
            <div class="col-md-12">
                <div class="row">
                    <?php foreach ($objindex as $objindexs):?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-orange">
                                    <div class="card-title text-white">
                                        <small class="float-right"><?php echo ucwords(strtolower($objindexs->obj)) ?>
                                            <i>-<?php echo ucwords(strtolower($objindexs->notacion)) ?></i>
                                        </small>
                                    </div>
                                </div>
                                <div class="card-body"> <a id="obj" class="btn btn-default btn-block" onclick="Act('<?php echo $objindexs->obj_id ?>')"> <i class="fa fa-calendar-week"> </i> Agregar Actividades</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function Act(val) {
        $.ajax({
            async: true,
            type: "POST",
            url: '?c=actividades&a=crud&oid=' + val,
            //data: 'pid=' + ,
            success: function(resp) {
                $('#info').html(resp);
                $('#respuesta').html("");
            }
        });
    };
</script>