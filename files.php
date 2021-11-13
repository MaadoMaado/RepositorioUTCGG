<?php 
include 'db_connect.php';
$files = $conn->query("SELECT * FROM files where user_id = '".$_SESSION['login_id']."'  order by nameproy asc");
?>

<style>
	.folder-item{
		cursor: pointer;
	}
	.folder-item:hover{
		background: #eaeaea;
	    color: black;
	    box-shadow: 3px 3px #0000000f;
	}
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
}
a.custom-menu-list {
    width: 100%;
    display: flex;
    color: #4c4b4b;
    font-weight: 600;
    font-size: 1em;
    padding: 1px 11px;
}
.file-item{
	cursor: pointer;
}
a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    background: #80808024;
}
table th,td{
	/*border-left:1px solid gray;*/
}
a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
}
</style>
<div class="container-fluid">
	<div class="col-lg-12">
	<div class="row">
			<div class="col-md-12"><center><h4><b>Repositorios:</b></h4></center></div>
		</div>
		<br>
		<hr>
		<div class="row">
			<div class="col-lg-12">
			<div class="row">
			<button class="btn btn-success btn-sm ml-4" id="new_file"><i class="fa fa-upload"></i> Subir Archivo</button>
			<div class="col-md-4 input-group offset-4">
  				<input type="text" class="form-control" id="search" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
  				<div class="input-group-append">
   					 <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa fa-search"></i></span>
  				</div>
			</div>
			</div>
			<br>
			<!-- aqui se creara una cadena o tabla que contenga los datos de filtros a aplicar en el buscador-->
			<div class="col-md-17 input-group">
				<select name="carrera" id="carrera" class="custom-select">
					<option value=""></option>
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

				<div class="col-md-7 input-group">
				<select name="tipo_proy" id="tipo_proy" class="custom-select">
					<option value=""></option>
					<option value="Integradora" <?php echo isset($meta['tipo_proy']) && $meta['tipo_proy'] == 'Integradora' ? 'selected': '' ?>>Integradora</option>
					<option value="Estadía" <?php echo isset($meta['tipo_proy']) && $meta['tipo_proy'] == 'Estadía' ? 'selected': '' ?>>Estadía</option>
					<option value="Proyecto Especial" <?php echo isset($meta['tipo_proy']) && $meta['tipo_proy'] == 'Proyecto Especial' ? 'selected': '' ?>>Proyecto Especial</option>
				</select>
				<div class="col-md-5 input-group">
				<select name="nivel_proy" id="nivel_proy" class="custom-select">
					<option value=""></option>
					<option value="TSU" <?php echo isset($meta['nivel_proy']) && $meta['nivel_proy'] == 'TSU' ? 'selected': '' ?>>TSU</option>
					<option value="Ingeniería" <?php echo isset($meta['nivel_proy']) && $meta['nivel_proy'] == 'Ingeniería' ? 'selected': '' ?>>Ingeniería</option>
				</select>
				</div>
				</div>
				<!--  se crea un boton que hace un reload a la pagina para borrar los filtross-->
				<div class="row">
				<button class="btn btn-success btn-sm ml-4" id="reset"><i class="fa fa-retweet" aria-hidden="true"></i> Reiniciar Filtro</button>
				</div>
				</div>
			</div>
			</div>
		<div class="row">
		</div>
		<hr>
		<div class="row">
			<div class="card col-md-12">
				<div class="card-body">
					<table width="100%">
						<tr>
							<th width="13%" class="">Nombre del Alumno:</th>
							<th width="13%" class="">Nombre del Repositorio:</th>
							<th width="13%" class="">Descripción:</th>
							<th width="13%" class="">Archivo del Aplicativo:</th>
							<th width="12%" class="">Manual de Usuario:</th>
							<th width="12%" class="">Manual Técnico:</th>
							<th width="12%" class="">Carrera:</th>
							<th width="12%" class="">Tipo de Proyecto:</th>
							<th width="12%" class="">Nivel de Proyecto:</th>
						</tr>
						<?php 
					while($row=$files->fetch_assoc()):
						$name = explode(' ||',$row['archivo_aplicativo']);
						$name = isset($name[1]) ? $name[0] ." (".$name[1].").".$row['file_type_archivo'] : $name[0] .".".$row['file_type_archivo'];
						$icon ='fa-file';
						if(in_array(strtolower($row['file_type_archivo']),['zip','rar','tar']))
							$icon ='fa-file-archive';
						$name1 = explode(' ||',$row['manual_user']);
						$name1 = isset($name1[1]) ? $name1[0] ." (".$name1[1].").".$row['file_type_user'] : $name1[0] .".".$row['file_type_user'];
						$pdf_arr =array('pdf','ps','eps','prn');
						if(in_array(strtolower($row['file_type_user']),$pdf_arr))
							$icon ='fa-file-pdf';
						$name2 = explode(' ||',$row['manual_tec']);
						$name2 = isset($name2[1]) ? $name2[0] ." (".$name2[1].").".$row['file_type_tec'] : $name2[0] .".".$row['file_type_tec'];
						$pdf_arr =array('pdf','ps','eps','prn');
						if(in_array(strtolower($row['file_type_user']),$pdf_arr))
							$icon ='fa-file-pdf';
					?>

						<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
							<td><i class="to_file"><?php echo $row['namealum'] ?></i></td>
							<td><i class="to_file2"><?php echo $row['nameproy'] ?></i></td>	
							<td><i class="to_file"><?php echo $row['description'] ?></i></td>
							<td><large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b></large>
							<input type="text" class="rename_file" value="<?php echo $row['archivo_aplicativo'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type_archivo'] ?>" style="display: none">
							</td>
							<td><large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name1 ?></b></large>
							<input type="text" class="rename_file" value="<?php echo $row['manual_user'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type_user'] ?>" style="display: none">
							</td>
							<td><large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name2 ?></b></large>
							<input type="text" class="rename_file" value="<?php echo $row['manual_tec'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type_tec'] ?>" style="display: none">
							</td>
							<td><i class="to_file5"><?php echo $row['user_carrera'] ?></i></td>
							<td><i class="to_file4"><?php echo $row['tipo_proy'] ?></i></td>
							<td><i class="to_file3"><?php echo $row['nivel_proy'] ?></i></td>
						</tr>
					<?php endwhile; ?>
					</table>			
				</div>
			</div>			
		</div>
	</div>
</div>
<div id="menu-folder-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit">Renombrar</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete">Borrar</a>
</div>
<div id="menu-file-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit"><span><i class="fa fa-edit"></i> </span>Renombrar</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Descargar archivo</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option download1"><span><i class="fa fa-download"></i> </span>Descargar manual usuario</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option download2"><span><i class="fa fa-download"></i> </span>Descargar manual técnico</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete"><span><i class="fa fa-trash"></i> </span>Borrar</a>
</div>

<script>
	$('#new_file').click(function(){
		uni_modal('','manage_files.php?fid')
	})
	$('#reset').click(function(){
		setTimeout(function(){
							location.reload()
						},100)
	})
	$('.folder-item').dblclick(function(){
		location.href = 'index.php?page=files&fid='+$(this).attr('data-id')
	})
	$('.folder-item').bind("contextmenu", function(event) { 
    event.preventDefault();
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu'></div>")
        custom.append($('#menu-folder-clone').html())
        custom.find('.edit').attr('data-id',$(this).attr('data-id'))
        custom.find('.delete').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});

})
	//FILE
	$('.file-item').bind("contextmenu", function(event) { 
    event.preventDefault();
    $('.file-item').removeClass('active')
    $(this).addClass('active')
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu file'></div>")
        custom.append($('#menu-file-clone').html())
        custom.find('.edit').attr('data-id',$(this).attr('data-id'))
        custom.find('.delete').attr('data-id',$(this).attr('data-id'))
        custom.find('.download').attr('data-id',$(this).attr('data-id'))
		custom.find('.download1').attr('data-id',$(this).attr('data-id'))
		custom.find('.download2').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});
	$("div.file.custom-menu .edit").click(function(e){
		e.preventDefault()
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').siblings('large').hide();
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').show();
	})
	$("div.file.custom-menu .delete").click(function(e){
		e.preventDefault()
		_conf("¿Estás seguro de querer eliminar este archivo? ",'delete_file',[$(this).attr('data-id')])
	})
	$("div.file.custom-menu .download").click(function(e){
		e.preventDefault()
		window.open('download.php?id='+$(this).attr('data-id'))
	})
	$("div.file.custom-menu .download1").click(function(e){
		e.preventDefault()
		window.open('download1.php?id='+$(this).attr('data-id'))
	})
	$("div.file.custom-menu .download2").click(function(e){
		e.preventDefault()
		window.open('download2.php?id='+$(this).attr('data-id'))
	})
	$('.rename_file').keypress(function(e){
		var _this = $(this)
		if(e.which == 13){
			start_load()
			$.ajax({
				url:'ajax.php?action=file_rename',
				method:'POST',
				data:{id:$(this).attr('data-id'),name:$(this).val(),type:$(this).attr('data-type')},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp);
						if(resp.status== 1){
								_this.siblings('large').find('b').html(resp.new_name);
								end_load();
								_this.hide()
								_this.siblings('large').show()
						}
					}
				}
			})
		}
	})

})
//FILE
	$('.file-item').click(function(){
		if($(this).find('input.rename_file').is(':visible') == true)
    	return false;
		uni_modal($(this).attr('data-name'),'manage_files.php? &id='+$(this).attr('data-id'))
	})
	$(document).bind("click", function(event) {
    $("div.custom-menu").hide();
    $('#file-item').removeClass('active')
});
	$(document).keyup(function(e){
    if(e.keyCode === 27){
        $("div.custom-menu").hide();
    $('#file-item').removeClass('active')
    }
});
	$(document).ready(function(){
		$('#search').keyup(function(){
			var _f = $(this).val().toLowerCase()
			$('.to_file2').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_f))
					$(this).closest('tr').toggle(true);
					else
					$(this).closest('tr').toggle(false);
			})
		})
	})
	$(document).ready(function(){
		$('#user carrera').change(function(){
			var _g = $(this).val().toLowerCase()
			$('.to_file5').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_g))
					for (var i = 0; i <3 ; i++) {
						if (i== 0) {
							$(this).closest('td').toggle(true);
						}
						else{
							$(this).closest('td').toggle(true);	
						}
						}
					else
					$(this).closest('tr').toggle(false);
			})
		})
	})
	$(document).ready(function(){
		$('#tipo_proy').change(function(){
			var _g = $(this).val().toLowerCase()
			$('.to_file4').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_g))
					for (var i = 0; i <3 ; i++) {
						if (i== 0) {
							$(this).closest('td').toggle(true);
						}
						else{
							$(this).closest('td').toggle(true);	
						}
						}
					else
					$(this).closest('tr').toggle(false);
			})
		})
	})
	$(document).ready(function(){
		$('#nivel_proy').change(function(){
			var _h = $(this).val().toLowerCase()
			$('.to_file3').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_h))
					for (var i = 0; i < 3; i++) {
						if (i== 0) {
							$(this).closest('td').toggle(true);
						}
						else {
							$(this).closest('td').toggle(true);	
						}
						}
					else
					$(this).closest('tr').toggle(false);
			})
		})
	})
	function delete_file($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_file',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("Archivo eliminado correctamente.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}
</script>