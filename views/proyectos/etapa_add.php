<?php @session_start(); ?>
<section class="content">
	<div class="container-fluid">
		<div class="col-12">
			<!-- Default box -->
			<form action="" method="post" id="form_etapa">
				<div class="row">
					<div class="col-6">
						<div class="form-group ">
							<label for="nombre">Fecha Inicio</label>
							<input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value='' oninput="calculardiasDiscount()" required>
						</div>
					</div>

					<div class="col-6">
						<div class="form-group">
							<label for="nombre">Fecha cierre</label>
							<input type="date" name="fecha_cierre" id="fecha_cierre" class="form-control" value='' oninput="calculardiasDiscount()" required>
						</div>
					</div>

					<div class="col-12">
						<div class="form-group">
							<label for="">Dias Ejecución</label>

							<table class="table table-bordered float-center">
								<thead>
									<tr>
										<th>Lunes</th>
										<th>Martes</th>
										<th>Miercoles</th>
										<th>Jueves</th>
										<th>viernes</th>
										<th>Sabado</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="text-center">

											<input type="checkbox" class="form-check-input" name="dia1" id="l" value="Lunes">

										</td>
										<td class="text-center">

											<input type="checkbox" class="form-check-input" name="dia2" id="m" value="Martes">

										</td>
										<td class="text-center">

											<input type="checkbox" class="form-check-input" name="dia3" id="mi" value="Miercoles">

										</td>
										<td class="text-center">

											<input type="checkbox" class="form-check-input" name="dia4" id="j" value="Jueves">

										</td>
										<td class="text-center">

											<input type="checkbox" class="form-check-input" name="dia5" id="v" value="Viernes">

										</td>
										<td class="text-center">

											<input type="checkbox" class="form-check-input" name="dia6" id="s" value="Sabado">

										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="col-4">
						<div class="form-group">
							<label for="nombre">Hora Inicio</label>
							<input type="time" name="hora" id="hora1" class="form-control" value='08:00' min="08:00" max="18:00" required>
							<small>De 8am a 6pm</small>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="nombre">Hora Fin</label>
							<input type="time" name="hora2" id="hora2" class="form-control" value='08:00' min="08:00" max="18:00" required>
							<small>De 8am a 6pm</small>
						</div>
					</div>
					<div class="col-4">
						<div class="form-group">
							<label for="nombre">Responsable</label>
							<select name="usuario_id" id="usuario_id" class="form-control">
								<?php foreach($usuarios as $value): ?>
									<option  value="<?php echo $value->user_id ?>"><?php echo $value->fullName  ?></option>
									<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<input type="hidden" name="id" value=''>
				<input type="hidden" id="etapa_id" name="etapa_id" value="<?php echo $_REQUEST['eid'] ?>">
				<input type="hidden" id="proyecto_id" name="proyecto_id" value="<?php echo $_REQUEST['pid'] ?>">
		</div>

		<input type="button" id="guardar" class="btn btn-success btn-block" value="Guardar">
		</form>

	</div>
	</div>
</section>

<!-- /.content -->
</div>
<div class="modal fade" id="modal-default">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body">
				<div class="index" id="index">
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
</div>
<script>
	$(document).on('click', '#guardar', function(e) {
		var data = $("#form_etapa").serialize();
		$("#index").modal('hide'); //ocultamos el modal
		$.ajax({
			data: data,
			type: "post",
			url: "?c=proyectos&a=Registrar",
			success: function(data) {
				Swal.fire({
						icon: 'success',
						title: 'se creo con exito',
						showConfirmButton: true,
						timer: 1500
					},
					setTimeout(function() {
						window.location.reload(1);
					}, 1500)
				)
			}
		});
	});

	/*	function calculardiasDiscount() {
			var timeStart = new Date(document.getElementById("fecha_inicio").value);
			var timeEnd = new Date(document.getElementById("fecha_cierre").value);
			var dia = document.getElementById("dia").value;
			var actualDate = new Date();
			if (timeEnd > timeStart) {
				var diff = timeEnd.getTime() - timeStart.getTime();
				document.getElementById("daysDiscount").value = Math.round(diff / (1000 * 60 * 60 * 24)) / 4 + ' ' + dia;
			} else if (timeEnd != null && timeEnd < timeStart) {
				alert("La fecha final de la promoción debe ser mayor a la fecha inicial");
				document.getElementById("daysDiscount").value = 0;
			}
		}*/
</script>