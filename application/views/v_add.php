<div class="container mt-4">
	<?= form_open_multipart('post/save') ?>
	<!-- <div class="text-danger ml-2"> -->
	<?= $this->session->flashdata('message') ?>
	<!-- </div> -->

	<div class="form-group">
		<label>Title</label>
		<input type="text" name="title" id="" placeholder="Tutorial Codeigniter 3 CRUD With AJAX" class="form-control" value="<?= set_value('title'); ?>">
		<?php echo form_error('title', '<div class="text-danger ml-2 ">', '</div>') ?>
	</div>

	<div class="form-group">
		<label>Thumbnail</label>
		<input type="file" name="thumbnail" class="form-control" value="<?= set_value('thumbnail'); ?>">
		<?php echo form_error('thumbnail', '<div class="text-danger ml-2 ">', '</div>') ?>
	</div>

	<label>Content</label>
	<textarea name="content" id="content" value="<?= set_value('content'); ?>"></textarea>
	<?php echo form_error('content', '<div class="text-danger ml-2 ">', '</div>') ?>
	<button class="btn btn-primary mt-4 mb-5" type="submit">Publish</button>

	<?= form_close() ?>
</div>