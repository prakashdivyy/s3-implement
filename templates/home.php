<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>Object Storage System</title>
    <!--  CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" type="text/css"
          rel="stylesheet" media="screen,projection"/>
    <link href="http://materializecss.com/templates/starter-template/css/style.css" type="text/css" rel="stylesheet"
          media="screen,projection"/>
</head>
<body>
<nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo">Kelompok 2 Sisdis</a>
        <ul class="right hide-on-med-and-down">
            <li><a href="">Home</a></li>
        </ul>
        <ul id="nav-mobile" class="side-nav">
            <li><a href="">Home</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <h1 class="header center orange-text">S3 - Object Storage System</h1>
        <div class="row center">
            <h5 class="header col s12 light">Tugas Akhir Kelompok Sisdis</h5>
        </div>
        <div class="row center">
            <form action="" method="POST" id="data" enctype="multipart/form-data">
                <div class="file-field input-field">
                    <div class="btn orange">
                        <span>File</span>
                        <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload a file...">
                    </div>
                </div>
            </form>
            <button type="submit" form="data" id="download-button" class="btn-large waves-effect waves-light orange">
                Upload File <i class="material-icons right">send</i>
            </button>
        </div>
        <br><br>
    </div>
</div>
<div class="container">
    <br><br>
    <div class="section">
    </div>
</div>
<footer class="page-footer orange">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Team</h5>
                <p class="grey-text text-lighten-4">
                    - Prakash Divy<br>
                    - Desi Ratna Mukti<br>
                    - Kevin Aditya Prabowo<br>
                    - Fauzan Azhari
                </p>
            </div>
            <div class="col l3 s12">
                <h5 class="white-text">NPM</h5>
                <ul>
                    <li><a class="white-text" href="#!">1306409513</a></li>
                    <li><a class="white-text" href="#!">1306397904</a></li>
                    <li><a class="white-text" href="#!">1306381616</a></li>
                    <li><a class="white-text" href="#!">1306381811</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
        </div>
    </div>
</footer>
<!--  Scripts  -->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
<script src="http://materializecss.com/templates/starter-template/js/init.js"></script>
<?php if ($error) { ?>
    <script>
        var $toastContent = $('<span>File exist</span>');
        Materialize.toast($toastContent, 3000);
    </script>
<?php } ?>
</body>
</html>
