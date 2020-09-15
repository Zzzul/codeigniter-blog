<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1>All Posts</h1>
            <hr>
        </div>
    </div>

    <div class="row">
        <?php foreach ($posts as $post) : ?>
            <div class="col-md-4 col-sm-12 col-lg-3">
                <div class="card mb-3 shadow">
                    <img src="<?= base_url('assets/img/resize/') . $post->thumbnail ?>" class="card-img-top" alt="...">
                    <div class="card-body p-2">
                        <a href="<?= base_url('post/detail/') . $post->slug ?>" class="text-dark text-decoration-none">
                            <h5 class="card-title"><?= $post->title ?></h5>
                            <p class="card-text">
                                <!-- built in helper CI3 
                                    must be loaded in config/autoload.php
                                    $this->load->helper('text');
                                -->
                                <?= word_limiter($post->content, 6); ?>
                            </p>
                        </a>
                        <a href="<?= base_url('post/edit/') . $post->slug ?>" class="text-decoration-none float-right text-info">
                            <i class="fas fa-pencil"></i>
                            Edit</a>
                        <a onclick="confrimDelete('<?= base_url('post/delete/') . $post->id ?>')" href="#!" class="text-decoration-none float-right mr-3 text-danger">
                            <i class="fas fa-trash"></i>
                            Delete</a>
                    </div>
                    <!-- end of card-body -->
                </div>
                <!-- end of card -->
            </div>
        <?php endforeach ?>
    </div>
    <!-- end of row -->
</div>
<!-- end of container -->

<!-- Delete Confirmation-->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">You won't be able to revert this!</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
            </div>
        </div>
    </div>
</div>
<script>
    function confrimDelete(url) {
        $('#btn-delete').attr('href', url);
        $('#modalDelete').modal();
    }
</script>