<?php $heroImage = $heroImage ?? $this->assets . 'images/background/header-bg.avif'; ?>
<section class="page-hero parallax position-relative text-white py-5 mb-2"
         style="background-image: url('<?= $heroImage ?>');">
    <div class="overlay position-absolute top-0 start-0 w-100 h-100"></div>
    <div class="container position-relative text-center fade-in-">
        <h1 class="display-5 fw-bold text-white mb-2"><?php echo $this->header_title ?></h1>
        <?php require_once __DIR__ . '/../layout/breadcrumb.php' ?>
    </div>
</section>
