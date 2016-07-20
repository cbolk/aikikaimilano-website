<?php
	setlocale(LC_TIME, 'ita');
	date_default_timezone_set('Europe/Rome');
  include("./adm/basic.php");
  include("./adm/class.db.php");
  include("./adm/class.news.php");
  include("./adm/class.utilities.php");

  $db = new dbaccess();
  $db->dbconnect();
  $u = new utils();
  $thismonth = Date('m');
  $allnews = new news();
  $newslist = $allnews->rawlist($db, true);

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
  		    <h3 class="cntr">notizie</h3>
  		  </header>

        <hr/>

        <div class="row">
          <div class="col-xs-12">

        <?php
          if (count($newslist) > 0) {
        ?>

            <table class="table table-condensed" style="border-collapse:collapse;">
              <tbody>
              <?php
                while ($row = mysql_fetch_array($newslist)){
                  ?>
                    <tr data-toggle="collapse" data-target="#news<?php echo $row['id']; ?>" class="accordion-toggle">
                        <td><?php echo substr($row["date"],8,2) . '&nbsp;' . $u->getMonthMedNameFromNumber(date('m', strtotime($row["date"]))) . '&nbsp;'. substr($row["date"],0,4); ?></td>
                        <td><?php echo $row["title"];?></td>
                        <td><span class="nomobile">dettagli</span><span class="mobile">...</span></td>
                    </tr>
                    <tr>
                      <td colspan="3" class="hiddenRow">
                        <div class="accordian-body collapse" id="news<?php echo $row['id']; ?>">
                          <?php echo $row["description"];?>
                        </div>
                      </td>
                    </tr>                    
                  <?php
                }
              ?>   
              </tbody>
            </table>  

        <?php
          } else {
        ?>
          <h4 class="cntr">nessuna notizia</h4>
        <?php 
          }
        ?>

          </div>         
        </div>
      </div>
    </section>

  </div><!-- wrapper/main -->
    
  <!-- Footer -->
  <?php include('./footer.php'); ?>
  <!-- google -->
  <?php include_once("analyticstracking.php") ?>    
  <!-- Scripts -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/skel.min.js"></script>
  <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
  <script src="assets/js/main.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.scrolly.min.js"></script>
  <script src="assets/js/jquery.scrollzer.min.js"></script>
    
</body>
</html>
