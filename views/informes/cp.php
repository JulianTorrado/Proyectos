<section>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Compromisos Pendientes</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="examplee1" class="table table-bordered table-sm" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                    <th>Proyecto/Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($compromisos as $valuec) : ?>
                                    <tr>
                                        <td><?php echo $valuec->actividad ?><spam class="badge badge-success float-right"><?php echo $valuec->cantidad ?></spam><br> <span class="float-right"><?php echo $valuec->fecha ?></span> </td>
                                        <td><?php echo $valuec->descripcion ?></td>
                                        <td><?php echo $valuec->comp_fecha ?></td>
                                        <td><?php echo $valuec->pro ?><br><?php echo $valuec->nombre ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Descripción</th>
                                    <th>Fecha</th>
                                    <th>Proyecto/Cliente</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>