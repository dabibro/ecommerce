<!doctype html>
<html lang="en" dir="ltr" class="landing-pages" data-bs-theme-color="theme-color-default">
<?php require_once __DIR__ . '/layout/head.php' ?>
<body class=" body-bg landing-pages">
<?php require_once __DIR__ . '/layout/loader.php'; ?>
<main class="main-content">
    <?php require_once __DIR__ . '/layout/header.php'; ?>
    <?php if (!empty($this->carousel)) {
        require_once __DIR__ . '/section/carousel.php';
    }
    if (!empty($this->header)) {
        require_once __DIR__ . '/section/header.php';
    } ?>
    <div class="content-inner pb-0 container-fluid" id="page_layout">
        <div class="container">
            <?php
            if (file_exists($this->page)) {
                require $this->page;
            } else {
                require __DIR__ . '/pages/404.php';
            } ?>
        </div>
    </div>
</main>
<?php require_once __DIR__ . '/section/footer.php'; ?>
<?php require_once __DIR__ . '/layout/modal.php'; ?>
<?php require_once __DIR__ . '/layout/script.php'; ?>
</body>
</html>
