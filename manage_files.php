<?php 
include('db_connect.php');
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM files where id=".$_GET['id']);
	if($qry->num_rows > 0){
		foreach($qry->fetch_array() as $k => $v){
			$meta[$k] = $v;
		}
	}
}
?>
<div class="container-fluid">
	<form action="" id="manage-files">
		<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
		<input type="hidden" name="folder_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] :'' ?>">
		<div class="form-group">
			<label for="namealum" class="control-label">Nombre del alumno:</label>
			<input type="text" name="namealum" id="namealum" class="form-control" <?php echo isset($meta['namealum']) ? $meta['namealum']: '' ?> required>
		</div>
		<div class="form-group">
			<label for="nameproy" class="control-label">Nombre del repositorio:</label>
			<input type="text" name="nameproy" id="nameproy" class="form-control"<?php echo isset($meta['nameproy']) ? $meta['nameproy'] :'' ?> >
		</div>
		<div class="form-group">
			<label for="" class="control-label">Agregar una descripción:</label>
			<textarea name="description" id="description" cols="30" rows="10" class="form-control"><?php echo isset($meta['description']) ? $meta['description'] :'' ?></textarea>
		</div>
		<!-- <div class="form-group">
			<label for="name" class="control-label">File name</label>
			<input type="text" name="name id="" value="<?php echo isset($meta['name']) ? $meta['name'] :'' ?>" class="form-control">
		</div> -->
		<?php if(!isset($_GET['id']) || empty($_GET['id'])): ?>
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text">Archivo del Aplicativo</span>
		  </div>
		  <div class="custom-file">
		    <input type="file" class="custom-file-input" name="upload" id="upload" onchange="displayname(this,$(this))">
		    <label class="custom-file-label" for="upload">Selecciona el archivo...</label>
		  </div>
		</div>
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text">Manual de Usuario</span>
		  </div>
		  <div class="custom-file">
		    <input type="file" class="custom-file-input" name="upload1" id="upload1" onchange="displayname(this,$(this))">
		    <label class="custom-file-label" for="upload1">Selecciona el archivo...</label>
		  </div>
		</div>
		<div class="input-group mb-3">
		  <div class="input-group-prepend">
		    <span class="input-group-text">Manual de Tecnico</span>
		  </div>
		  <div class="custom-file">
		    <input type="file" class="custom-file-input" name="upload2" id="upload2" onchange="displayname(this,$(this))">
		    <label class="custom-file-label" for="upload2">Selecciona el archivo...</label>
		  </div>
		</div>
	<?php endif; ?>
		<div class="form-group">
			<label for="tipo_proy">Tipo de Proyecto:</label>
			<select name="tipo_proy" id="tipo_proy" class="custom-select">
				<option value="Integradora" <?php echo isset($meta['tipo_proy']) && $meta['tipo_proy'] == 'Integradora' ? 'selected': '' ?>>Integradora</option>
				<option value="Estadía" <?php echo isset($meta['tipo_proy']) && $meta['tipo_proy'] == 'Estadía' ? 'selected': '' ?>>Estadía</option>
				<option value="Proyecto Especial" <?php echo isset($meta['tipo_proy']) && $meta['tipo_proy'] == 'Proyecto Especial' ? 'selected': '' ?>>Proyecto Especial</option>
			</select>
		</div>
		<div class="form-group">
			<label for="nivel_proy">Nivel de Proyecto:</label>
			<select name="nivel_proy" id="nivel_proy" class="custom-select">
				<option value="TSU" <?php echo isset($meta['nivel_proy']) && $meta['nivel_proy'] == 'TSU' ? 'selected': '' ?>>TSU</option>
				<option value="Ingeniería" <?php echo isset($meta['nivel_proy']) && $meta['nivel_proy'] == 'Ingeniería' ? 'selected': '' ?>>Ingeniería</option>
			</select>
		</div>
	</form>
</div>
<script>
	$(document).ready(function(){
		$('#manage-files').submit(function(e){
			e.preventDefault()
			start_load();
		$('#msg').html('')
		$.ajax({
			url:'ajax.php?action=save_files',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(typeof resp != undefined){
					resp = JSON.parse(resp);
					if(resp.status == 1){
						alert_toast("Nuevo archivo agregado correctamente.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
					}else{
						$('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')
						end_load()
					}
				}
			}
		})
		})
	})
	function displayname(input,_this) {
			    if (input.files && input.files[0]) {
			        var reader = new FileReader();
			        reader.onload = function (e) {
            			_this.siblings('label').html(input.files[0]['name'])
			        }

			        reader.readAsDataURL(input.files[0]);
			    }
			}
</script>