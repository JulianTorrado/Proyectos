<?php //print_r($etapasNuevas) ?>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-2">
            <!-- <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">General</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                 <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item active">
                            <a class="nav-link" id="ver">
                                <i class="fas fa-eye"></i> Ver
                               
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="etapas">
                                <i class="fas fa-box"></i></i> Etapas
                                <span
                                    class="badge bg-warning float-right"><?php echo count($etapas) + count($etapasNuevas); ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="obj" class="nav-link">
                                <i class="far fa-envelope"></i> Objetivos
                                <span class="badge bg-warning float-right"><?php echo $objetivos->num_obj; ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a id="hora" class="nav-link">
                                <i class="far fa-file-alt"></i> Actividades
                                <span class="badge bg-warning float-right"><?php echo count($act_pro) ?></span>
                            </a>
                        </li>
                    </ul>
                </div> 
               
            </div> -->
            <!-- /.card -->
            <!-- <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Asignación</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <?php foreach ($etapas as $value): ?>
                            <li class="nav-item active">
                                <a class="nav-link"
                                    onclick="Act_val('<?php echo $_REQUEST['pid'] ?>','<?php echo $value->id ?>')">
                                    <?php echo $value->notacion ?>
                                    <span class="badge bg-primary float-right"><i class="fas fa-eye"></i></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                         <?php foreach ($etapasNuevas as $value): ?>
                            <li class="nav-item active">
                                <a class="nav-link" onclick="Act_val('<?php echo $_REQUEST['pid'] ?>','<?php echo $value->id ?>')">
                                    <?php echo $value->notacion ?>
                                </a>
                            </li>
                        <?php endforeach; ?> 
                    </ul>
                </div>
                
            </div>  -->
            <!-- /.card -->
            <!-- /.card -->
            <div class="card collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">Gestión</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="nav nav-pills flex-column">
                        <?php foreach ($etapas as $value): ?>
                            <li class="nav-item active">
                                <a class="nav-link"
                                    onclick="Act_val_ges('<?php echo $_REQUEST['pid'] ?>','<?php echo $value->id ?>','0')">
                                    <!--  <i class="fas fa-eye"></i>--> <?php echo $value->notacion ?>
                                    <!--<span class="badge bg-primary float-right">12</span>-->
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <?php foreach ($etapasNuevas as $value): ?>
                            <li class="nav-item active">
                                <a class="nav-link"
                                    onclick="Act_val_ges('<?php echo $_REQUEST['pid'] ?>','<?php echo $value->id ?>','1')">
                                    <!--  <i class="fas fa-eye"></i>--> <?php echo $value->notacion ?>
                                    <!--<span class="badge bg-primary float-right">12</span>-->
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        <!-- /.col -->
        <div class="col-md-10" id="info" class="info"></div>
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#ver').click(function () {
            $('#info').html("<h5>Cargando Complementos</h5>");
            $.ajax({
                async: true,
                type: "POST",
                url: '?c=plantillas&a=proyecto&pid=<?php echo $_REQUEST['pid'] ?>',
                //data: 'pid=' + ,
                success: function (resp) {
                    $('#info').html(resp);
                    $('#respuesta').html("");
                }
            });
        });

        $('#etapas').click(function () {
            $('#info').html("<h5>Cargando Complementos</h5>");
            $.ajax({
                async: true,
                type: "POST",
                url: '?c=proyectos&a=etapa_index&pid=<?php echo $_REQUEST['pid'] ?>',
                //url: '?c=etapas_nuevas&a=index&pid=<?php echo $_REQUEST['pid'] ?>',
                // url: '?c=proyectos&a=etapa_add&pid=<?php echo $_REQUEST['pid'] ?>',

                //data: 'pid=' + ,
                success: function (resp) {
                    $('#info').html(resp);
                    //$('#info').html("");
                }
            });
        });

        $('#horario').click(function () {
            $('#info').html("<h5>Cargando Complementos</h5>");
            $.ajax({
                async: true,
                type: "POST",
                url: './views/horarios/obtener.php?pid=<?php echo $_REQUEST['pid'] ?>',
                //data: 'pid=' + ,
                success: function (resp) {
                    $('#info').html(resp);
                    $('#respuesta').html("");
                }
            });
        });

        $('#objet').click(function () {
            $('#info').html("<h5>Cargando Complementos</h5>");
            $.ajax({
                async: true,
                type: "POST",
                url: '?c=objetivos&a=ver&pid=<?php echo $_REQUEST['pid']; ?>',
                //data: 'pid=' + ,
                success: function (resp) {
                    $('#info').html(resp);
                    $('#respuesta').html("");
                }
            });
        });

        $('#act_val').click(function () {
            $('#info').html("<h5>Cargando Complementos</h5>");
            $.ajax({
                async: true,
                type: "POST",
                url: '?c=proyectos&a=ver_gestion&pid=<?php echo $_REQUEST['pid']; ?>',
                //data: 'pid=' + ,
                success: function (resp) {
                    $('#info').html(resp);
                    $('#respuesta').html("");
                }
            });
        });
    });

    function Act_val(val1, val2) {
        $('#info').html("<h5>Cargando Complementos</h5>");
        $.ajax({
            async: true,
            type: "POST",
            url: '?c=proyectos&a=ver',
            data: {
                val01: val1,
                val02: val2
            },
            success: function (resp) {
                $('#info').html(resp);
                $('#respuesta').html("");
            }
        });
    }

    function Act_val_ges(val1, val2, nueva) {
        $('#info').html("<h5>Cargando Complementos</h5>");
        $.ajax({
            async: true,
            type: "POST",
            url: '?c=proyectos&a=TareasDeOperarioSup',
            data: {
                val01: val1,
                val02: val2,
                nueva: nueva
            },
            success: function (resp) {
                $('#info').html(resp);
                $('#respuesta').html("");
            }
        });
    }
</script>