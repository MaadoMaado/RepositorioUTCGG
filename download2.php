<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM files where id=".$_GET['id'])->fetch_array();

extract($_POST);
    $fname=$qry['file_path_tec'];
    $file = ("assets/uploads/".$fname);
    header ("Content-Type:".filetype($file));
    header ("Content-Length".filesize($file));
    header ("Content-Disposition: attachment; filename=".$qry['manual_tec'].'.'.$qry['file_type_tec']);
    readfile($file);

?>