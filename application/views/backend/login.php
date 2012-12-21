<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Zona Privada</title>
    <meta name="description" content="">
    <meta name="author" content="">


    <link href="<?php echo $base_url;?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos inline -->
    <style type="text/css">
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 300px;
      }
      
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

	  .login-form {
		margin-left: 65px;
	  }
	
	  legend {
		margin-right: -50px;
		font-weight: bold;
	  	color: #404040;
	  }
    </style>
	
</head>
<body>
	<div class="container">
		<div class="content">
			<div class="row">
				<div class="login-form">
					<h2>Zona Privada</h2>
					<?php  echo form_open('login', 'id="form"');?>
						<fieldset>
							<div class="clearfix">
								<input type="text" name="user" placeholder="Usuario..." value="<?php echo isset($user)?$user:'';?>">
							</div>
							<div class="clearfix">
								<input type="password" name="password" placeholder="Password...">
							</div>
							<div class="clearfix">
								<label class="checkbox">
      								<input type="checkbox"> Recordar
    							</label>
							</div>
							<p><button class="btn btn-primary" type="submit" name="remember">Ingresar</button></p>
							<?php if (isset ($message)) {?>
							<p><?php echo $message; ?></p>
							<?php } ?>
						</fieldset>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div> <!-- /container -->
	
	<script src="<?php echo $base_url;?>/assets/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>