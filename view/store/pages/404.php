<style>

    .page404 .container {
        padding-top: 10%;
        text-align: center;
        z-index: 999999;
    }

    .page404 .container h1 {
        font-size: 8rem;
        margin: 0;
        color: #0056b3;
    }

    .page404 .container p {
        font-size: 1.5rem;
        margin: 20px 0;
    }

    .page404 .container a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 1rem;
        color: #fff;
        background-color: #0056b3;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
        z-index: 9999999;
    }

    .page404 .container a:hover {
        background-color: #003d80;
    }

    @media (max-width: 768px) {
        .page404 .container h1 {
            font-size: 6rem;
        }

        .page404 .container p {
            font-size: 1.2rem;
        }

        .page404 .container a {
            font-size: 0.9rem;
            padding: 8px 16px;
        }
    }
</style>
<div class="page404">
    <div class="row">
        <div class="col-lg-12">
            <div class="container">
                <h1>404</h1>
                <p>Oops! The page you are looking for cannot be found.</p>
                <a href="<?php echo BASE_PATH; ?>">Return Home</a>
            </div>
        </div>
    </div>
</div>