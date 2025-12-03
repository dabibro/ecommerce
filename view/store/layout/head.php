<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo strip_tags(htmlspecialchars_decode($this->site_description)); ?>">
    <?php if (!empty($this->meta)) {
        foreach ($this->meta as $meta => $value) {
            echo '<meta property="' . $meta . '" content="' . $value . '">';
        }
    } ?>
    <title><?php if (!empty($this->page_title)) {
            echo $this->page_title;
        } ?></title>
    <link rel="shortcut icon" href="<?php echo $this->logo; ?>">
    <link rel="stylesheet" href="<?php echo $this->assets . 'hope-ui/'; ?>css/core/libs.min.css">
    <link rel="stylesheet" href="<?php echo $this->assets . 'hope-ui/'; ?>css/hope-ui.min.css?v=5.0.0">
    <link rel="stylesheet" href="<?php echo $this->assets . 'hope-ui/'; ?>css/pro.min.css?v=5.0.0">
    <link rel="stylesheet" href="<?php echo $this->assets . 'hope-ui/'; ?>css/custom.min.css?v=5.0.0">
    <link rel="stylesheet" href="<?php echo $this->assets . 'hope-ui/'; ?>css/customizer.min.css?v=5.0.0">
    <link rel="stylesheet" href="<?php echo $this->assets . 'hope-ui/'; ?>css/rtl.min.css?v=5.0.0">
    <link rel="stylesheet" href="<?php echo $this->assets . 'hope-ui/'; ?>vendor/swiperSlider/swiper-bundle.min.css">
    <link rel="stylesheet" href="<?php echo $this->assets; ?>vendor/remixicon/fonts/remixicon.css">
    <link rel="stylesheet" href="<?php echo $this->assets . 'hope-ui/'; ?>css/e-commerce.min.css">
    <link rel="stylesheet" href="<?php echo $this->assets . 'hope-ui/'; ?>vendor/noUiSilder/nouislider.min.css">

    <!-- plugins -->
    <link rel="stylesheet" href="<?php echo $this->assets . 'vendor/'; ?>toastr/toastr.min.css">

    <link href="<?php echo $this->assets; ?>css/material-ui.css" rel="stylesheet">
    <?php
    if (!empty($this->styles)) {
        foreach ($this->styles as $style) {
            if (!empty($style)) {
                echo '<link href="' . $style . '" rel="stylesheet">';
            }
        }
    }
    ?>
</head>