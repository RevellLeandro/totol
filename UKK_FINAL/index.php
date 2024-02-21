<?php include 'koneksi.php'; session_start() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Website Galeri Foto</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/style.css?<?PHP ECHO TIME();?>>">

        <style>
                body {
                    background-image: url(assets/img/denim.jpg);
                }
        </style>
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
    <a class="navbar-brand text-white" href="?url=home">Gallery Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="nav link-colum">
            <a class="nav-link text-white" href="?url=home">Home</a>
            <?php if(isset($_SESSION['user_id'])): ?>
                <a class="nav-link text-white" href="?url=upload">Upload</a>
                <a class="nav-link text-white" href="?url=album">Album</a>
                <a class="nav-link text-white" href="?url=profile"><?= ucwords($_SESSION['username']) ?></a>
                <a href="?url=logout" class="nav-link text-white">Logout</a>
            <?php else: ?>
                <a class="nav-link text-white" href="login.php">Login</a>
                <a class="nav-link text-white" href="daftar.php">Daftar</a>
            <?php endif; ?>
        </div>
    </div>
</div>
    </nav>
    <?php 
        $url=@$_GET["url"];
        if($url=='home'){
            include 'page/home.php';
        }elseif($url=='profile'){
            include 'page/profil.php';
        }else if($url=='upload'){
            include 'page/upload.php';
        }else if($url=='album'){
            include 'page/album.php';
        }else if($url=='like'){
            include 'page/like.php';
        }else if($url=='komentar'){
            include 'page/komentar.php';
        }else if($url=='detail'){
            include 'page/detail.php';
        }else if($url=='logout'){
            session_destroy();
            header("Location: ?url=home");
        }else{
            include 'page/home.php';
        }
    ?>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>