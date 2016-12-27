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
          <li><a href="http://grup2-ceph-04.sisdis.ui.ac.id/imp-s3/">Home</a></li>
          <li><a href="http://grup2-ceph-04.sisdis.ui.ac.id/imp-s3/gallery">Gallery</a></li>
          <li><a href="http://grup2-ceph-04.sisdis.ui.ac.id/imp-s3/imp-swift/">Swift</a></li>
        </ul>
        <ul id="nav-mobile" class="side-nav">
          <li><a href="http://grup2-ceph-04.sisdis.ui.ac.id/imp-s3/">Home</a></li>
          <li><a href="http://grup2-ceph-04.sisdis.ui.ac.id/imp-s3/gallery">Gallery</a></li>
          <li><a href="http://grup2-ceph-04.sisdis.ui.ac.id/imp-s3/imp-swift/">Swift</a></li>
        </ul>
        <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
</nav>
<div class="section no-pad-bot" id="index-banner">
    <div class="container">
        <br><br>
        <form action="../copyFile" method="POST" id="data" enctype="multipart/form-data">
          <div class="file-field input-field">
            <input type="text" name="filename" value="<?php echo $filename ?>" disabled>
            <input type="text" name="bucket_source" value="<?php echo $bucket_source ?>" disabled>
            <input type="text" name="filename_new">
            <select name="bucket_destination">
              <?php
              foreach ($Buckets as $Bucket) {
                  echo "<option value='".$Bucket->Name."'>".$Bucket->Name."</option>";
              }
              ?>
            </select>
          </div>
          <button type="submit" form="data" id="download-button" class="btn-large waves-effect waves-light orange">
              Copy File <i class="material-icons right">send</i>
          </button>
        </form>


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
<script>
  $(document).ready(function() {
    $('select').material_select();
  });
</script>
</body>
</html>
