<?php
session_start();
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwords' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
			return 1;
		}else{
			return 2;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}

	function save_folder(){
		extract($_POST);
		$data = " name ='".$name."' ";
		$data .= ", parent_id ='".$parent_id."' ";
		if(empty($id)){
			$data .= ", user_id ='".$_SESSION['login_id']."' ";
			
			$check = $this->db->query("SELECT * FROM folders where user_id ='".$_SESSION['login_id']."' and name  ='".$name."'")->num_rows;
			if($check > 0){
				return json_encode(array('status'=>2,'msg'=> 'El nombre de carpeta ya existe.'));
			}else{
				$save = $this->db->query("INSERT INTO folders set ".$data);
				if($save)
				return json_encode(array('status'=>1));
			}
		}else{
			$check = $this->db->query("SELECT * FROM folders where user_id ='".$_SESSION['login_id']."' and name  ='".$name."' and id !=".$id)->num_rows;
			if($check > 0){
				return json_encode(array('status'=>2,'msg'=> 'El nombre de la carpeta ya existe.'));
			}else{
				$save = $this->db->query("UPDATE folders set ".$data." where id =".$id);
				if($save)
				return json_encode(array('status'=>1));
			}

		}
	}

	function delete_folder(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM folders where id =".$id);
		if($delete)
			echo 1;
	}
	function delete_file(){
		extract($_POST);
		$path = $this->db->query("SELECT file_path_archivo from files where id=".$id)->fetch_array()['file_path_archivo'];
		$path1 = $this->db->query("SELECT file_path_user from files where id=".$id)->fetch_array()['file_path_user'];
		$path2 = $this->db->query("SELECT file_path_tec from files where id=".$id)->fetch_array()['file_path_tec'];
		$delete = $this->db->query("DELETE FROM files where id =".$id);
		if($delete){
					unlink('assets/uploads/'.$path);
					unlink('assets/uploads/'.$path1);
					unlink('assets/uploads/'.$path2);
					return 1;
				}
	}

	function save_files(){
		extract($_POST);
		if(empty($id)){
		if($_FILES['upload']['tmp_name'] != ''){
					$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['upload']['name'];
					$move = move_uploaded_file($_FILES['upload']['tmp_name'],'assets/uploads/'. $fname);
					$fname1 = strtotime(date('y-m-d H:i')).'_'.$_FILES['upload1']['name'];
					$move1 = move_uploaded_file($_FILES['upload1']['tmp_name'],'assets/uploads/'. $fname1);
					$fname2 = strtotime(date('y-m-d H:i')).'_'.$_FILES['upload2']['name'];
					$move2= move_uploaded_file($_FILES['upload2']['tmp_name'],'assets/uploads/'. $fname2);
					if($move){
						$file = $_FILES['upload']['name'];
						$file = explode('.',$file);
						$file1 = $_FILES['upload1']['name'];
						$file1 = explode('.',$file1);
						$file2 = $_FILES['upload2']['name'];
						$file2 = explode('.',$file2);
						$chk = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(archivo_aplicativo,' ||',1) = '".$file[0]."' and folder_id = '".$folder_id."' and file_type_archivo='".$file[1]."' ");
						$chk1 = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(manual_user,' ||',1) = '".$file1[0]."' and folder_id = '".$folder_id."' and file_type_user='".$file1[1]."' ");
						$chk2 = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(manual_tec,' ||',1) = '".$file2[0]."' and folder_id = '".$folder_id."' and file_type_tec='".$file2[1]."' ");
						if($chk->num_rows > 0){
							$file[0] = $file[0] .' ||'.($chk->num_rows);
						}
						if($chk1->num_rows > 0){
							$file1[0] = $file1[0] .' ||'.($chk1->num_rows);
						}
						if($chk2->num_rows > 0){
							$file2[0] = $file2[0] .' ||'.($chk2->num_rows);
						}
						$data = " archivo_aplicativo = '".$file[0]."' ";
						$data .= ", namealum = '".$namealum."' ";
						$data .= ", nameproy = '".$nameproy."' ";
						$data .= ", description = '".$description."' ";
						$data .= ", folder_id = '".$folder_id."' ";
						$data .= ", user_carrera = '".$_SESSION['login_carrera']."' ";
						$data .= ", user_id = '".$_SESSION['login_id']."' ";
						$data .= ", manual_user= '".$file1[0]."' ";
						$data .= ", manual_tec= '".$file2[0]."' ";
						$data .= ", file_type_archivo = '".$file[1]."' ";
						$data .= ", file_type_user= '".$file1[1]."' ";
						$data .= ", file_type_tec= '".$file2[1]."' ";
						$data .= ", file_path_archivo = '".$fname."' ";
						$data .= ", file_path_user = '".$fname1."' ";
						$data .= ", file_path_tec = '".$fname2."' ";
						$data .= ", tipo_proy = '$tipo_proy' ";
						$data .= ", nivel_proy = '$nivel_proy' ";
						$save = $this->db->query("INSERT INTO files set ".$data);
						if($save)
						return json_encode(array('status'=>1));

					}
				}
				
			}else{
						$data = " namealum = '".$namealum."' ";
						$data .= ", nameproy = '".$nameproy."' ";
						$data .= ", description = '".$description."' ";
						$data .= ", tipo_proy = '$tipo_proy' ";
						$data .= ", nivel_proy = '$nivel_proy' ";
						$save = $this->db->query("UPDATE files set ".$data. " where id=".$id);
						if($save)
						return json_encode(array('status'=>1));
			}

	}

	function file_rename(){
		extract($_POST);
		$file[0] = $name;
		$file[1] = $type;
		$chk = $this->db->query("SELECT * FROM files where SUBSTRING_INDEX(manual_user,' ||',1) = '".$file[0]."' and folder_id = '".$folder_id."' and file_type_user='".$file[1]."' and id != ".$id);
		if($chk->num_rows > 0){
			$file[0] = $file[0] .' ||'.($chk->num_rows);
			}
		$save = $this->db->query("UPDATE files set manual_user = '".$name."' where id=".$id);
		if($save){
				return json_encode(array('status'=>1,'new_name'=>$file[0].'.'.$file[1]));
		}
	}
	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", password = '$password' ";
		$data .= ", carrera = '$carrera' ";
		$data .= ", cuatrimestre = '$cuatrimestre' ";
		$data .= ", type = '$type' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id =".$id);
		if($delete)
			echo 1;
	}
}