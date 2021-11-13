<style>
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
	span.card-icon {
    position: absolute;
    font-size: 3em;
    bottom: .2em;
    color: #ffffff80;
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
	<?php include('db_connect.php') ;
	$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  f.is_public = 1 order by date(f.date_updated) desc");
	?>

	<div class="row mt-3 ml-3 mr-3">
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
							<td><i class="to_file"><?php echo $row['user_carrera'] ?></i></td>
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
<div id="menu-file-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Descargar</a>
</div>
<script>
	//FILE
	$('.file-item').bind("contextmenu", function(event) { 
    event.preventDefault();
    $('.file-item').removeClass('active')
    $(this).addClass('active')
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu file'></div>")
        custom.append($('#menu-file-clone').html())
        custom.find('.download').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});
	$("div.file.custom-menu .download").click(function(e){
		e.preventDefault()
		window.open('download.php?id='+$(this).attr('data-id'))
	})
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
})
</script>