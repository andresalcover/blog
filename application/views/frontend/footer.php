	</div>
	<div class="row-fluid">
		<hr>
		<div class="span12">
			<p class="center">Desarrollado por Andres Alcover Archilla</p>
			<?php if (isset($mobile_info)) { ?>
			<p>
			<?php if (!empty($mobile_info['brand'])) { ?>
			<span class="label label-info">Marca: <?php echo $mobile_info['brand']; ?></span>
			<?php } ?>
			<?php if (!empty($mobile_info['model'])) { ?>
			<span class="label label-info">Modelo: <?php echo $mobile_info['model']; ?></span>
			<?php } ?>
			<?php if (!empty($mobile_info['manufacturer'])) { ?>
			<span class="label label-info">Vendedor: <?php echo $mobile_info['manufacturer']; ?></span>
			<?php } ?>
			</p>
			<?php } ?>
		</div>
	</div>
<script src="<?php echo $base_url?>assets/js/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url?>assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url?>assets/js/jquery.cleditor.min.js" type="text/javascript"></script>
<script src="<?php echo $base_url?>assets/js/common.js" type="text/javascript"></script>
</body>
</html>