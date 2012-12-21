	<div class="row-fluid">
		<h1 class="page-header">Bienvenido a la prueba de Kitmaker</h1>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<?php  if ($posts) { ?>
			<?php foreach ($posts as $post) {?>
			<p><?php echo $post['title'];?></p>
			<p><?php echo $post['author'];?></p>
			<p><?php echo $post['post_intro'];?></p>
			<p><?php echo $post['read_more_link']; ?></p>
			<hr>
			<?php } ?>
			<?php } else { ?>
			<p>No hay posts </p>
			<?php } ?>
		</div>
		</div class="span12">
			<?php echo $add_post_button;?>
		</div>
	</div>
