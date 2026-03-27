<section>
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Soportes</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <!-- <th>Nombre Archivo0</th> -->
                        <th>Enlace</th>
                        <th>Tamaño</th>
                        <th>menu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                   // print_r($soportes);
                    foreach ($soportes as $value) : ?>
                        <tr>
                            <!-- <td>
                                <?php
                                // $filepath = $value->ruta_soporte;
                                // $filename = preg_replace('/^.+[\\\\\\/]/', '', $filepath);  // filename.jpg
                                // echo $filename ?>
                                
                            </td> -->

                            <td>
                                <a href="<?php echo  $value->enlace; ?>" target="_blank"><i class="fa fa-paperclip"></i></a>
                            </td>

                            <td>

                                <?php 
                                if(empty($value->enlace)):
                                    echo @filesize($filepath) . ' kb';
                                else:
                                    echo "0";
                                endif;
                                
                                 ?>
                            </td>
                            <td style="vertical-align: middle;text-align: center;" class="text-right py-0 align-middle">
                                
                                    <a href="<?php echo $value->ruta_soporte ?>" class="" target="_blank"><i class="fas fa-eye"></i></a>
                                    <a href="?c=soportes&a=eliminar&id=<?php echo $value->id ?>&path=<?php echo $value->ruta_soporte ?>" onclick="return confirm('Estás seguro que deseas eliminar el soporte?');" class=""><i class="fas fa-trash"></i></a>
                               
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>