<div class="container mt-4">
    <?= form_open_multipart('post/update') ?>

    <?= $this->session->flashdata('message') ?>

    <div class="form-group">
        <label>Title</label>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="hidden" name="slug" value="<?= $slug ?>">
        <input type="text" name="title" id="" placeholder="Tutorial Codeigniter 3 CRUD With AJAX" class="form-control" value="<?= $title ?>">
        <?php echo form_error('title', '<div class="text-danger ml-2 ">', '</div>') ?>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-3">
                <img src="<?= base_url('assets/img/resize/') . $thumbnail ?>" alt="<?= $thumbnail ?>" class="rounded" width="250">
            </div>
            <div class="col-md-9">
                <label>Thumbnail</label>
                <input type="file" name="thumbnail" class="form-control">
                <input type="hidden" name="old_image" value="<?= $thumbnail ?>">
                <?php echo form_error('thumbnail', '<div class="text-danger ml-2 ">', '</div>') ?>
            </div>
        </div>
    </div>

    <label>Content</label>
    <textarea name="content" id="content">
        <?= htmlspecialchars($content)  ?>
    </textarea>
    <?php echo form_error('content', '<div class="text-danger ml-2 ">', '</div>') ?>
    <button class="btn btn-primary mt-4 mb-5" type="submit">Edit</button>

    <?= form_close() ?>
</div>