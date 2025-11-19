<nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
    <div class="container">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="<?php echo BASE_PATH; ?>">Home</a></li>
            <?php if (!empty($this->breadcrumb)) {
                foreach ($this->breadcrumb as $link => $label) {
                    ?>
                    <li class="breadcrumb-item"><a href="<?php echo $link; ?>"><?php echo $label; ?></a></li>
                <?php }
            } ?>
        </ol>
    </div>
</nav>