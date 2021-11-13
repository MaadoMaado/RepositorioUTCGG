<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb- item text-success">home</li>
</ol>
</nav>
<div class="container-fluid">
<div class="row">
	<div class="col-lg-12">
		<button class="btn btn-success float-right btn-md" id="new_user">
			<i class="fa fa-plus"></i>Registrar Alumno
		</button>
	</div>
</div>
<br>
<div class="row">
	<div class="card col-lg-12">
		<div class="card-body">
			<table class="table-triped table-bordered col-md-12">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Usuario</th>
						<th class="text-center">Carrera</th>
						<th class="text-center">Cuatrimestre</th>
						<th class="text-center">Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php
						include 'db_connect.php';
						$users = $conn->query("SELECT * FROM users where type='3' order by name asc");
							$i = 1;
								while ($row  = $users->fetch_assoc()):
						?>
						<tr>
							<td class="text-center">
								<?php echo $i++ ?>
							</td>
							<td class="text-center">
								<?php echo $row['name']?>
							</td>
							<td class="text-center">
								<?php echo $row['username'] ?>
							</td>
							<td class="text-center">
								<?php echo $row['carrera']?>
							</td>
							<td class="text-center">
								<?php echo $row['cuatrimestre'] ?>
							</td>
							<td>
								<center>
									<div class="btn-group">
										<button type="button" class="btn btn-success">Acción</button>
								  <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								    <span class="sr-only">Toggle Dropdown</span>
								  </button>
								  <div class="dropdown-menu">
								  	<a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Editar</a>
								    <div class="dropdown-divider"></div>
								    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Borrar</a>
								  </div>
									</div>
								</center>
							</td>
						</tr>
						<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<script>
$('#new_user').click(function(){
	uni_modal('Nuevo Usuario','manage_user_docente.php')
})
$('.edit_user').click(function(){
	uni_modal('Editar Usuario','manage_user_docente.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(e){
	e.preventDefault()
		_conf("¿Estás seguro de querer eliminar esta carpeta?",'delete_user',[$(this).attr('data-id')])
})

function delete_user($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_user',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("usuario eliminado correctamente.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}
</script>