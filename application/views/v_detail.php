<div class="container mt-4">
    <div class="row">
        <div class="col-md-9 col-sm-12 col-lg-9">
            <?= $this->session->flashdata('message') ?>

            <h1><?= $title ?></h1>

            <small class="mr-2">
                <i class="fas fa-user mr-1 text-info"></i>
                SuperUser
            </small>

            <small class="mr-2">
                <i class="fas fa-calendar-alt mr-1 text-info"></i>
                <?= date('d-m-Y H:i:s', strtotime($date_create))  ?>
            </small>
            <small class="mr-2">
                <i class="fas fa-coins mr-1 text-info"></i>
                Codeigniter
            </small>

            <hr class="shadow">
            <?= $content ?>
        </div>
        <!-- end of col -->
        <div class="col-md-3 col-sm-12 col-lg-3 mt-4">
            <h5>Featured Articles</h5>
            <hr>
            <?php foreach ($posts as $post) : ?>

                <div class="card mb-2 shadow-sm">
                    <div class="row no-gutters mt-2 px-2">
                        <div class="col-md-12">
                            <a href="<?= base_url('post/detail') . $post->slug ?>" class="text-dark text-decoration-none p-0 m-0">
                                <p class="mb-2 mt-0">
                                    <?= word_limiter($post->title, 5) ?>
                                </p>
                                <p class="mb-0 mt-0">
                                    <?= word_limiter($post->content, 8) ?>
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>