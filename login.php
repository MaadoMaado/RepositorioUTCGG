<?php
        session_start();
        if(isset($_SESSION['login_id']))
            header("location:index.php?page=home");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Bienvenido al repositorio </title>
    <?php include('./header.php'); ?>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    
</head>
<body>
<div class="card col-md-8">
    <div class="card-body">
      <form id="login-form">
      	 <center><img src="assets/img/brunch2.png" width="200px" id="icon" alt="User Icon" /></center>
		   <br>
		   <br>
          <div class="form-group">
              <label for="username" class="control-label text-success">Usuario:</label>
              <input type="text" id="username" name="username" class="form-control">
          </div>
          <div class="form-group">
              <label for="password" class="control-label text-success">Password:</label>
              <input type="password" id="password" name="password" class="form-control">
          </div>
          <center><button class="btn-sm btn-block btn-wave col-md-4 btn-success">entrar</button></center>
      </form>
    </div>
   </div>
  </div>
 </div> 
</main>
    <a href="#" class="back-to-top"><i class="iconfont-simple-up"></i></a>
</body>

<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
	},
			success:function(resp){
				if(resp == 1){
					location.reload('index.php?page=home');
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Usuario o Password incorrectos.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>

</html>
