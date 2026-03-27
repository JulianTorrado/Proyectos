    <div class="responsive">
        <table id="ejemplo3" class="table table-bordered">
            <thead>
                <!-- <tr>
                    <th colspan="5" class="bg-success">Actividades Por Realizar</th>
                </tr> -->
                <tr>
                    <th>Etapa</th>
                    <th>Actividad</th>
                    <th>Estado</th>
                    <th>Planeado</th>
                    <th>Responsable</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                
                $i=0;
                foreach ($reporte as $value) :
                     $value->fecha <= date('Y-m-d')? $class='alert alert-warning':$class='alert alert-success';
                     
                     ?>
                    <tr >
                        <td><?php echo $value->notacion ?></td>
                        <td><?php echo $value->actividad ?></td>
                        <td><?php echo $value->estado==0?'<span class=" float-right badge badge-danger">Pendiente</span>':'<span class=" float-right badge badge-success">Hecho</span>' ?></td>
                        <td class="<?=$class?>"><?php echo $value->fecha ?></td>
                        <td class="<?=$class?>"><?php echo $value->fullName ?></td>
                    </tr>
                <?php $i++; endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Etapa</th>
                    <th>Actividad</th>
                    <th>Estado</th>
                    <th>Ejecución</th>
                    <th>Responsable</th>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
    