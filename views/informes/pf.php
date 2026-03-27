<section>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Progreso de funcionarios</h3>                    
                </div>
                <div class="card-body">
                <?php foreach ($funcionarios as $value1) : ?>
                                <div class="progress-group">
                                    <?php echo $value1->fullName ?>
                                    <?php foreach ($funci_cumplidas as $value3) :
                                        if ($value3->user_id == $value1->user_id) : ?>
                                            <?php $porcentaje = ($value3->amount / $value1->amount) * 100;

                                            if (($porcentaje >= 0) && ($porcentaje < 50)) {
                                                $bg = 'bg-danger';
                                            }
                                            if (($porcentaje > 50) && ($porcentaje <= 100)) {
                                                $bg = 'bg-success';
                                            }
                                            ?>
                                            <label><?php echo  number_format($porcentaje, 1) . '%' ?></label>
                                            <span class="float-right"><b><?php echo $value3->amount ?></b>/<?php echo $value1->amount ?></span>
                                            <div class="progress progress-sm">

                                                <div class="progress-bar <?php echo $bg ?>" style="width: <?php echo  number_format($porcentaje, 1) . '%' ?>"></div>
                                            </div>
                                    <?php
                                        endif;
                                    endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>