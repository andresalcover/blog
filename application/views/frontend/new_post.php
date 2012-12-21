<div class="row-fluid">
	<div class="span12">
		<h1 class="page-header"><?php echo $heading_title;?></h1>
	</div>
	
	<?php if ($message) {?>
	<div class="container fluid">
		<div class="alert alert-error">
			<?php echo $message; ?>
			<button class="close" href="#">&times</button>
		</div>
	</div>
	<?php } ?>
	
	<div class="span12">
	<?php  echo form_open('blog/new_post', array('class'=>'form-horizontal', 'id' =>'form'));?>
			<div class="control-group<?php echo (isset($error_author)?' error':'');?>">
				<label class="control-label" for="author">Autor:</label>
				<div class="controls">
					<input type="text" name="author" id="author" placeholder ="autor..." value="<?php echo $author;?>" />
					<?php if (isset($error_author)) { ?>
						<span class="help-inline"><?php echo $error_author;?></span>
					<?php } ?>
				</div>
			</div>
			<div class="control-group<?php echo (isset($error_title)?' error':'');?>">
				<label class="control-label" for="title">Titulo:</label>
				<div class="controls">
					<input type="text" name="title" id="title" placeholder ="t&iacute;tulo..." value="<?php echo $title;?>" />
					<?php if (isset($error_title)) { ?>
						<span class="help-inline"><?php echo $error_title;?></span>
					<?php } ?>
				</div>
			</div>
			<div class="control-group<?php echo (isset($error_detail)?' error':'');?>">
				<label class="control-label" for="post">Post:</label>
				<div class="controls">
					<textarea rows="20" cols="20" name="detail" id="detail" placeholder ="texto..."><?php echo $detail;?></textarea>
					<?php if (isset($error_detail)) { ?>
						<span class="help-inline"><?php echo $error_detail;?></span>
					<?php } ?>
				</div>
			</div>
			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-success">Aceptar</button>
					<a href="<?php echo $base_url;?>" class="btn btn-danger">Cancelar</a>
				</div>
			</div>
		<?php echo form_close();?>
	</div>
</div>
