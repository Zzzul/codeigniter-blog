<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- sticky footer -->
    <link rel="stylesheet" href="<?= base_url('assets/css/sticky-footer.css') ?>">

    <!-- CKeditor -->
    <script src="<?= base_url('') ?>/assets/ck_ecosystem/ckeditor/ckeditor.js"></script>
    <script src="<?= base_url('') ?>/assets/ck_ecosystem/ckfinder/ckfinder.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.2.0/build/highlight.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/highlightjs-line-numbers.js@2.6.0/dist/highlightjs-line-numbers.min.js">
    </script>



    <!-- hljs -->
    <link rel="stylesheet" href="<?= base_url('assets/css/hljs.css') ?>">

    <script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@10.2.0/build/highlight.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/highlightjs-line-numbers.js@2.6.0/dist/highlightjs-line-numbers.min.js">
    </script>

    <title><?= $title ?></title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container">
            <a class="navbar-brand font-weight-bold" href="<?= base_url('/') ?>">CI-Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <a class="nav-link active" href="<?= base_url('/') ?>">Home <span class="sr-only">(current)</span></a>
                    <a class="nav-link active" href="<?= base_url('post/add') ?>">Add Post</a>
                </div>
            </div>
        </div>
    </nav>