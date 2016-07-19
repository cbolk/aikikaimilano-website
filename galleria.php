<?php
    setlocale(LC_TIME, 'ita');
    date_default_timezone_set('Europe/Rome');
  include("./adm/class.gallery.php");

  $gallery = new gallery();

?>
<!DOCTYPE html>
<head>
    <title>Aikikai Milano</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <link rel="icon" type="image/png" href="assets/img/logo.png">
    <style type="text/css">
      .accordion-toggle{cursor:pointer}
    </style>
</head>
<body>
    <!-- Header -->
    <?php include('./header.php'); ?>
        
  <!-- Main -->
  <div id="wrapper">
    <section class="color nomobile">
      <p>&#9671;&#9671;</p>
    </section>   

    <section id="news" class="even">
        <div class="container">   
          <header>
            <h3 class="cntr">galleria fotografica</h3>
          </header>

        <hr/>

    <?php
            $gallery->setPath('./photos/galleria/'); //path to the image folder
            $images = $gallery->getImages(array('jpg','png')); //array of possible image extensions (useful if you have mixed galleries)
            if($images){
                foreach($images as $image){
                    ?>
                        <div class="col-lg-3 col-md-3 col-xs-4 thumb">
                            <a class="thumbnail" href="<?php echo $image['full']; ?>">
                                <img  class="img-responsive" src="<?php echo $image['full']; ?>" alt="">
                            </a>
                        </div>
                    <?php
                }
            }?>
        </div>
    </section>

  </div><!-- wrapper/main -->
    
  <!-- Footer -->
  <?php include('./footer.php'); ?>
    
  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/skel.min.js"></script>
  <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
  <script src="assets/js/main.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.scrolly.min.js"></script>
  <script src="assets/js/jquery.scrollzer.min.js"></script>
  <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
  <script src="js/bootstrap-image-gallery.min.js"></script>    
    
</body>
</html>


