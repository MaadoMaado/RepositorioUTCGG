<?php 
include('db_connect.php');
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM users where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>

<div class="container-fluid">
	<form action="" id="manage-user">
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Nombre:</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="username">Usuario:</label>
			<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" class="form-control" value="<?php echo isset($meta['password']) ? $meta['id']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="carrera">Carrera:</label>
			<select name="carrera" id="carrera" class="custom-select">
				<option value="Ing. en Procesos Alimentarios" <?php echo isset($meta['carrera']) && $meta['carrera'] == 'Ing. en Procesos Alimentarios' ? 'selected': '' ?>>Ing. en Procesos Alimentarios</option>
				<option value="Ing. en Mantenimiento Industrial" <?php echo isset($meta['carrera']) && $meta['carrera'] == 'Ing. en Mantenimiento Industrial' ? 'selected': '' ?>>Ing. en Mantenimiento Industrial</option>
				<option value="Ing. en Desarrollo y Gestión de Software" <?php echo isset($meta['carrera']) && $meta['carrera'] == 'Ing. en Desarrollo y Gestión de Software' ? 'selected': '' ?>>Ing. en Desarrollo y Gestión de Software</option>
				<option value="Ing. en Energías Renovables" <?php echo isset($meta['carrera']) && $meta['carrera'] == 'Ing. en Energías Renovables' ? 'selected': '' ?>>Ing. en Energías Renovables</option>
				<option value="Lic. en Gestión del Capital Humano" <?php echo isset($meta['carrera']) && $meta['carrera'] == 'Lic. en Gestión del Capital Humano' ? 'selected': '' ?>>Lic. en Gestión del Capital Humano</option>
				<option value="Ing. en Metal Mecánica" <?php echo isset($meta['carrera']) && $meta['carrera'] == 'Ing. en Metal Mecánica' ? 'selected': '' ?>>Ing. en Metal Mecánica</option>
				<option value="Ing. en Logística Internacional" <?php echo isset($meta['carrera']) && $meta['carrera'] == 'Ing. en Logística Internacional' ? 'selected': '' ?>>Ing. en Logística Internacional</option>
				<option value="Lic. en Gestión y Desarrollo Turístico" <?php echo isset($meta['carrera']) && $meta['carrera'] == 'Lic. en Gestión y Desarrollo Turístico' ? 'selected': '' ?>>Lic. en Gestión y Desarrollo Turístico</option>
				<option value="Lic. en Gastronomía" <?php echo isset($meta['carrera']) && $meta['carrera'] == 'Lic. en Gastronomía' ? 'selected': '' ?>>Lic. en Gastronomía</option>
			</select>
		</div>
		<div class="form-group">
			<label for="cuatrimestre">Cuatrimestre:</label>
			<select name="cuatrimestre" id="cuatrimestre" class="custom-select">
			<option value=" " <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == ' ' ? 'selected': '' ?>> </option>
				<option value="1ro" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '1ro' ? 'selected': '' ?>>1ro</option>
				<option value="2do" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '2do' ? 'selected': '' ?>>2do</option>
				<option value="3ro" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '3ro' ? 'selected': '' ?>>3ro</option>
				<option value="4to" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '4to' ? 'selected': '' ?>>4to</option>
				<option value="5to" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '5to' ? 'selected': '' ?>>5to</option>
				<option value="6to" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '6to' ? 'selected': '' ?>>6to</option>
				<option value="7mo" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '7mo' ? 'selected': '' ?>>7mo</option>
				<option value="8vo" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '8vo' ? 'selected': '' ?>>8vo</option>
				<option value="9no" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '9no' ? 'selected': '' ?>>9no</option>
				<option value="10mo" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '10mo' ? 'selected': '' ?>>10mo</option>
				<option value="11vo" <?php echo isset($meta['cuatrimestre']) && $meta['cuatrimestre'] == '11vo' ? 'selected': '' ?>>11vo</option>
			</select>
		</div>
		<div class="form-group">
			<label for="type">Tipo de Usuario:</label>
			<select name="type" id="type" class="custom-select">
					<option value="3" <?php echo isset($meta['type']) && $meta['type'] == 3 ? 'selected': '' ?>>Alumno</option>
			</select>
		</div>
	</form>
</div>

<script>
	$('#manage-user').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=save_user',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Datos guardados con éxito.",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})
</script>