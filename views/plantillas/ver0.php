<div class="card card-primary card-outline">
    <div class="card-header"><?php echo $proyecto->nombre; ?>
        <span class="badge badge-primary float-right">Creación: <?php echo $proyecto->created; ?></span>
    </div>
    <div class="card-body p-0">
        <div class="container">
            <div class="mailbox-read-info">
                <h6> <span class="badge badge-secondary float-right">Duración: <?php echo $proyecto->duracion; ?></span></h6>
                <p class="text-justify"> <strong>Descripción: </strong> <?php echo $proyecto->descripcion; ?></p>
            </div>
            <div class="row">
                <?php $etapas = $etapa->Listar($proyecto->id); ?>
                <?php foreach ($etapas as $etapa) : ?>
                    <?php $objetivos = $obj->Listar($etapa->id); ?>
                    <?php foreach ($objetivos as $objetivo) : ?>
                        <?php $actividades = $act->Listar($objetivo->id); ?>
                        <div class="col-md-6">
                            <!-- Widget: user widget style 2 -->
                            <div class="card card-widget widget-user-2 collapsed-card">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header bg-orange">
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool float-right text-white" data-card-widget="collapse">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="widget-user-image">
                                        <img class="img-circle elevation-2" src="assets/dist/img/etapa.png" alt="User Avatar">
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h5 class="widget-user-username text-white"><?php echo  ucwords($etapa->notacion) ?></h5>
                                    <h6 class="text-white"><?php echo ucfirst(strtolower($objetivo->objetivo)) ?></h6>
                                </div>
                                <div class="card-footer p-0">
                                    <ul class="nav flex-column">
                                        <?php foreach ($actividades as $actividade) : ?>
                                            <li class="nav-item">
                                                <a href="#" class="nav-link">
                                                    <?php echo  $actividade->actividad ?> <span class="float-right badge bg-primary"></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.widget-user -->
                        </div>
                    <?php endforeach; ?>
                    <!-- /.col -->
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>