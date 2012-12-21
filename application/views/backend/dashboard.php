	<div class="row-fluid">
		<h1 class="page-header"><?php echo $heading_title; ?></h1>
	</div>
		<div class="row-fluid">
		<?php if ($message) {?>
		<div class="container fluid">
			<div class="alert alert-success">
				<?php echo $message; ?>
				<button class="close" href="#">&times</button>
			</div>
		</div>
		<?php } ?>
		<div class="span12">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th class="left">Autor</th>
						<th class="left">Titulo</th>
						<th class="center">Fecha Creaci&oacute;n</th>
						<th class="center">Estado</th>
						<th class="center">Acci&oacute;n</th>
					</tr>
				</thead>
				<tbody>
				<?php if (isset($posts)) {?>
				<?php foreach ($posts as $post) {?>
					<tr>
						<td class="left"><?php echo $post['author']?></td>
						<td class="left"><?php echo $post['title']?></td>
						<td class="center"><?php echo $post['creation_date']?></td>
						<td class="center"><?php echo $post['status']?></td>
						<td class="center"><?php echo $post['action']?></td>
					</tr>
				<?php } ?>
				<?php } else { ?>
					<td colspan="5" class="center" co><p><b>No hay posts!</b></p></td>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	
