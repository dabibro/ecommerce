<?php
$dir = 'assets/images/carousel/';
if (is_dir($dir)) {
    $files = array_diff(scandir($dir), ['.', '..']);
    $images = array_values(array_filter($files, static function ($file) use ($dir) {
        return preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file) && is_file($dir . $file);
    }));

    if (!empty($images)) { ?>
        <style>
            /* --- Carousel Custom Styling --- */
            .carousel-indicators [data-bs-target] {
                background-color: #0d6efd; /* Bootstrap primary blue */
            }

            .carousel-indicators .active {
                background-color: #0b5ed7; /* Darker shade of primary */
            }

            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                background-color: rgba(13, 110, 253, 0.7); /* Semi-transparent blue background */
                border-radius: 50%;
                background-size: 60%;
            }

            .carousel-control-prev-icon:hover,
            .carousel-control-next-icon:hover {
                background-color: rgba(13, 110, 253, 1);
            }

            #site-carousel {
                min-height: 500px;
                max-height: 450px;
                position: relative;
                overflow: hidden;
            }

            #site-carousel .carousel-inner .carousel-item img {
                width: 100% !important;
                max-height: 100% !important;
                height: 550px;
            }
        </style>
        <div class="bd-example">
            <div id="site-carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <?php foreach ($images as $i => $img): ?>
                        <button type="button"
                                data-bs-target="#site-carousel"
                                data-bs-slide-to="<?= $i ?>"
                            <?= $i === 0 ? 'class="active" aria-current="true"' : '' ?>
                                aria-label="Slide <?= $i + 1 ?>"></button>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($images as $i => $file):
                        $imagePath = '/' . $dir . $file; ?>
                        <div class="carousel-item <?= $i === 0 ? 'active' : '' ?>">
                            <img src="<?= htmlspecialchars($imagePath) ?>"
                                 class="d-block w-100 img-fluid" alt="Slide <?= $i + 1 ?>">
                            <!-- <div class="carousel-caption d-none d-md-block">
                                <h5><?php /*= ucwords(str_replace(['-', '_', '.jpg', '.png', '.jpeg'], ' ', pathinfo($file, PATHINFO_FILENAME))) */
                            ?></h5>
                                <p><?php /*= htmlspecialchars($file) */
                            ?></p>
                            </div>-->
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#site-carousel"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#site-carousel"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <?php
    } else {
        echo "<p>No images found in carousel directory.</p>";
    }
} else {
    echo "<p>Carousel directory not found.</p>";
}
?>
