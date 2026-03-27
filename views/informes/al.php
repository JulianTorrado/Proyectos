<section>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Actividades Logradas</h3>                    
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="actividadesf" class="table table-bordered table-sm" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Fecha</th>
                                    <th>Proyecto/Cliente</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($actividadf as $valuuec) : ?>
                                    <tr>
                                        <td><?php echo $valuuec->actividad ?> </td>
                                        <td><?php echo $valuuec->hfecha ?></td>
                                        <td><?php echo $valuuec->pro ?><br><?php echo $valuuec->nombre ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Actividad</th>
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