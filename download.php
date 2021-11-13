<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM files where id=".$_GET['id'])->fetch_array();

extract($_POST);
    $fname=$qry['file_path_archivo'];
    $file = ("assets/uploads/".$fname);
    header ("Content-Type:".filetype($file));
    header ("Content-Length".filesize($file));
    header ("Content-Disposition: attachment; filename=".$qry['archivo_aplicativo'].'.'.$qry['file_type_archivo']);
    readfile($file);

?>