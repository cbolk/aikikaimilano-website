<?php
	setlocale(LC_TIME, 'ita');
	date_default_timezone_set('Europe/Rome');
  include("./adm/basic.php");
  include("./adm/class.db.php");
  include("./adm/class.seminar.php");
  include("./adm/class.utilities.php");



  $db = new dbaccess();
  $db->dbconnect();
  $seminar = new seminar();
  $u = new utils();
  $thismonth = Date('m');
  $nextsem = $u->getNextStageMMDD($db);

  $semID = $seminar->getNextStageID($db);
  if($semID != null){
    $seminario = $seminar->get($db,$semID);
    $from = $u->medDateEn($seminario->fromdate);
    $fromMob = $u->medDateEn($seminario->fromdate);
    $to = $u->medDateEn($seminario->todate);
    $toMob = $u->medDateEn($seminario->todate);
    $istruttori = $seminar->getStageInstructors($db,$semID);
  }
?>
<!DOCTYPE html>
  <head>
    <title>Aikikai Milano</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Aikikai Milano Dojo Aikido M&deg; Yoji Fujimoto"/>
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <link rel="apple-touch-icon-precomposed" href="assets/favicon_t.png" />
    <link rel="shortcut icon" href="assets/favicon.png">
  </head>
  <body>
    
    <!-- Header -->
	<?php include('./header.en.php'); ?>
    
    
    <!-- Main -->
    <div id="wrapper">
      
      <!-- Home -->
      <section id="top" class="cover nomobile text-center color">
	         <img id="banner" src="assets/img/banner.jpg" alt="banner">
      </section>

      <section id="top" class="cover mobile color">
           <img id="banner" class="img-responsive" src="assets/img/banner400.jpg" alt="banner">
      </section>
      
      <section class="color">
        <p>&#9671;&#9671;</p>
      </section>
      
      <!-- Aikido -->
      <section id="aikido" class="even">
    		<div class="container">	  
      		  <header>
      		    <h2>L'Aikido</h2>
      		  </header>
            <div class="row">
               <div class="col-xs-12 col-sm-12 col-lg-12">
                  <blockquote class="text-right">
                       There are no contests in the Art of Peace. A true warrior is invincible because he or she contests with nothing. Defeat means to defeat the mind of contention that we harbor within.
                       <small> <cite>Morihei Ueshiba</cite></small>
                  </blockquote>

          		    <p>At first sight, Aikido looks like an elegant self-defence technique, exploiting blocks, projections and join locks against one or more attackers. 
                  Indeed, it is the synthesis of ancient techniques eveolved from the classical <em>Jujutsu</em> and from <em>Kenjutsu</em> (the art of the sword). Aikido has its own peculiarity and power by means of movements based on the rotation of a sphere.</p>
              </div>
          </div>
          <div class="row">
              <div class="col-xs-12">
                  <p>While other martial arts are conceived around linear movements (forward, backward and on the diagonal line), Aikido techniques stem from a circular movement around the defender. S/he can thus make her/his center stable, unbalancing the attacker and exploiting the aggressive power as floating energy.</p>
              </div>
          </div>
          <div class="row">
              <div class="col-xs-12 col-sm-6 col-lg-6  text-center">
                  <img class="img-responsive thumbnail" src="photos/morihei-ueshiba-throwing-tada.jpg" alt="Morihei Ueshiba Throwing Tada" width="440px" />
                  <p class="imgcaption">Ueshiba Morihei, Aikido founder<br/>
                  (source: <a href="http://blog.aikidojournal.com" target="_blank">Aikido Journal</a>)</p>
               </div>
              <div class="col-xs-12 col-sm-6 col-lg-6">
                  <p>Aikido (Path of the energy and armony, from Ai 合 Armony, Ki 気 Energy, and Do 道 Path) is the result of a long personal journey carried out by the founder, Morihei Ueshiba.<br/>
                  Aikido aims at educating towards the mutual respect of one another, thus it refuses to become a competitive activity. In this spirit, there are no competitions but only tests to pass from one level to the next, and demostrations to disseminate the activity itself.</p>
              </div> 
          </div> 
          <div class="row">
              <div class="col-xs-12 col-sm-8 col-lg-8">
                  <img class="img-responsive thumbnail text-center" src="photos/Ueshiba-Kisshomaru-loc.png" alt="Kisshomaru Ueshiba" width="600px" />
                  <p class="imgcaption">Ueshiba Kisshomaru, the second Doshu<br/>
                   (source: <a href="http://blog.aikidojournal.com" target="_blank">Aikido Journal</a>)</p>
              </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-8 col-lg-8">
              <p>Aikido has no competition, thus it is common to see in Aikido dojos people of all ages practicing together. The practice inherently develops a cooperation between participants, who progress together in their paths. Attention is devoted to the etiquette and respect, so creating a propitious atmosphere towards a positive approach to Aikido and life.<br/>People start practicing Aikido with different motivations, some do it because of its philosphy, others for the martial aspects, others for the elegance of the movements.</p>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4 cntr">
              <img class="img-responsive thumbnail" src="http://www.ueshibaaikido.org/Images/Images/Doshu/doshu.jpg" alt="Present Doshu" width="250px"/>
              <p class="imgcaption">Ueshiba Moriteru, the present Doshu<br/>
               (source: <a href="http://www.aikikai.or.jp/eng/aikido/history.html" target="_blank">Aikikai Foundation</a>)</p>
            </div>
          </div>
          <div class="row">
                <div class="col-xs-12 col-sm-4 col-lg-4">
                    <img class="img-responsive thumbnail" src="http://www.aikikai.or.jp/eng/images/aikido/img_history_1.jpg" alt="" width="200px"/>
                </div>
                <div class="col-xs-12 col-sm-4 col-lg-4">
                    <img class="img-responsive thumbnail" src="http://www.aikikai.or.jp/eng/images/aikido/img_history_2.jpg" alt="" width="200px"/>
                </div>
                <div class="col-xs-12 col-sm-4 col-lg-4">
                    <img class="img-responsive thumbnail" src="http://www.aikikai.or.jp/eng/images/aikido/img_history_3.jpg" alt="" width="200px"/>
                </div>
          </div>
          <div class="row text-center">
              <div class="col-xs-12">
                 <p class="imgcaption">The Ueshiba family<br/>
                (source: <a href="http://www.aikikai.or.jp/eng/aikido/history.html" target="_blank">Aikikai Foundation</a>)</p>
                </div>
          </div>
          <div class="row">          
            <div class="col-xs-12 col-sm-12 col-lg-12">
              <blockquote class="text-right">
                   All techniques use four qualities that reflect the nature of our world. Depending on the circumstance, you should be: hard as a diamond, flexible as a willow, smooth-flowing like water, or as empty as space.
                   <small> <cite>Morihei Ueshiba</cite></small>
              </blockquote>
            </div>
          </div>
        </div>
      </section>
      
      <section class="color">
        <p>&#9671;&#9671;</p>
      </section>
      
      <!-- Insegnanti -->
      <section id="fujimoto" class="odd">
        <div class="container">   
          <header>
              <h2>Fujimoto Sensei</h2>
          </header>
          <div class="row">
              <div class="col-xs-12 col-sm-8 col-lg-8 text-center">
                <img class="img-responsive thumbnail" src="photos/maestrofujimoto.jpg" alt="Il Maestro Fujimoto" width="600px" /> 
              </div>
              <div class="col-xs-12 col-sm-4 col-lg-4">
              <p>Fujimoto Sensei (VIII dan and Shihan Aikikai Hombudojo) founded and directed the dojo for over 40 years. After his death, in February 2012, the same ethics and teaching path are adopted in continuing his work.</p>
              </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <p>Fujimoto Sensei was born in Yamaguchi in 1948 and sent to Italy to promote Aikido, assuming the role of vice-director of Aikikai d’Italia.<br/>
              He arrives in Milano in 1971, where he starts and develops one of the most important Aikido schools in Europe.<br/>
              In more than 40 years, Fujimoto Sensei deeply contributed to the diffusion of Aikido not only in Italy, but also in Europe, Russia and South Africa.<br/>
              Fujimoto Sensei died in February 2012, fostering a continuity of his Aikido style and his dojo.</p>
              </div>
            </div>
          <div class="row">
            <div class="col-xs-12 text-center">
                <img class="img-responsive thumbnail" src="photos/maestrofujimoto2.jpg" alt="Fujimoto Sensei" />
            </div>
          </div> 


        </div>
      </section>
      
      <section class="color">
        <p>&#9671;&#9671;</p>
      </section>
      
      <!-- -->
      <section id="corsi" class="even">
      	<div class="container">	  
    	  <header>
    	    <h2>Classes and schedule</h2>
    	  </header>
  	  
        <p>Aikikai Milano offers different classes, considering age and progress:</p>
         <div class="table-responsive">
           <table class="table table-striped">
             <tbody>
              <tr>
                <td class="tdtitle">pre-aikido</td>
                <td >age 5-6</td>
                <td ><span class="nomobile">October&#8209;May</span><span class="mobile">Oct-May</span></td>
                <td class="text-right"><span class="nomobile">Wed. 17:00</span><span class="mobile">We 17&ndash;18</span><span class="nomobile">&ndash;18:00</span></td>
              </tr>
              <tr>
                <td class="tdtitle">kids</td>
                <td >age 7-10</td>
                <td ><span class="nomobile">October&#8209;May</span><span class="mobile">Oct-May</span></td>
                <td class="text-right"><span class="nomobile">Mon. 17:00</span><span class="mobile">Mo 17&ndash;18</span><span class="nomobile">&ndash;18:00</span><span class="nomobile"><br/></span>
                            <span class="nomobile">Thu. 17:00</span><span class="mobile">Th 17&ndash;18</span><span class="nomobile">&ndash;18:00</span></td>
              </tr>
              <tr>
                <td class="tdtitle">youngsters</td>
                <td >age 11-14</td>
                <td ><span class="nomobile">October&#8209;May</span><span class="mobile">Oct-May</span></td>
                <td class="text-right"><span class="nomobile">Tue. 17:00</span><span class="mobile">Tu 17&ndash;18</span><span class="nomobile">&ndash;18:00</span><span class="nomobile"><br/></span>
                            <span class="nomobile">Fri. 17:00</span><span class="mobile">Fr 17&ndash;18</span><span class="nomobile">&ndash;18:00</span></td>
              </tr>
              <tr>
                <td colspan="2" class="tdtitle">beginners</td>
                <td ><span class="nomobile">October&#8209;June</span><span class="mobile">Oct-Jun</span></td>
                <td class="text-right"><span class="nomobile">Tue. 19:00</span><span class="mobile">Tu 19&ndash;20</span><span class="nomobile">&ndash;20:00</span><span class="nomobile"><br/></span>
                            <span class="nomobile">Thu. 20:00</span><span class="mobile">Th 20&ndash;21</span><span class="nomobile">&ndash;21:00</span><span class="nomobile"><br/></span>
                            <span class="nomobile">Fri. 19:00</span><span class="mobile">Fr 19&ndash;20</span><span class="nomobile">&ndash;20:00</span></td>
              </tr>
              <tr class="nomobile">
                <td colspan="4" class="note"></td>
              </tr>
              <tr class="nomobile">
                <td colspan="4" class="note">
            Beginners' class is open to all those who have never practised Aikido and are 15 years old, at least. There is no maximum age. It is possible to join at any time during the year, since teacher's assistants will help you catch up with the rest of the group.
                </td>
              </tr>
              <tr>
                <td colspan="2" class="tdtitle">adults</td>
                <td colspan="2">all year<span class="nomobile">, see details</span></td>
              </tr>
              </tbody>
            </table>
          </div>
            <p class="mobile">Beginners' class is open to all those who have never practised Aikido and are 15 years old, at least. There is no maximum age. It is possible at any time during the year, since teacher's assistants will help you catch up with the rest of the group.</p>
            <header>
              <h4>October-June ~ adults</h4>
            </header>

          <div class="table-responsive">
            <table class="table table-striped">
            <tbody>
              <tr>
                <td class="tdtitle"><span class="nomobile">Monday</span><span class="mobile">Mo</span></td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">Tuesday</span><span class="mobile">Tu</span></td>
                <td >07:00<span class="nomobile">-</span><span class="mobile"> </span>08:00</td>
                <td >13:00<span class="nomobile">-</span><span class="mobile"> </span>14:00</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >&nbsp;</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00<sup><span class="small icon fa-star-o" aria-hidden="true"></span></sup></td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">Wednesday</span><span class="mobile">We</span></td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">Thursday</span><span class="mobile">Th</span></td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">Friday</span><span class="mobile">Fr</span></td>
                <td >07:00<span class="nomobile">-</span><span class="mobile"> </span>08:00</td>
                <td >13:00<span class="nomobile">-</span><span class="mobile"> </span>14:00</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >&nbsp;</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00<sup><span class="small icon fa-map-marker" aria-hidden="true"></span></sup></td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">Saturday</span><span class="mobile">Sa</span></td>
                <td >10:00<span class="nomobile">-</span><span class="mobile"> </span>11:30</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3"><sup><span class="small icon fa-star-o" aria-hidden="true"></span></sup> JO/BOKKEN YUDANSHA from October to May</td>
                <td colspan="3"><sup><span class="small icon fa-map-marker" aria-hidden="true"></span></sup> JO/BOKKEN from October to May</td>
              </tr>
            </tbody>
            </table>
          
          </div>

        	  <header>
        	    <h4>July ~ adults</h4>
        	  </header>
          <div class="table-responsive">
            <table class="table table-striped">
            <tbody>
              <tr>
                <td class="tdtitle">Monday</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">Tuesday</td>
                <td >07:00<span class="nomobile">-</span><span class="mobile"> </span>08:00</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="tdtitle">Wednesday</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">Friday</td>
                <td >07:00<span class="nomobile">-</span><span class="mobile"> </span>08:00</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              </tbody>
            </table>
          </div>

        	  <header>
        	    <h4>August ~ adults</h4>
        	  </header>
          <div class="table-responsive">
            <table class="table table-striped">
            <tbody>
              <tr>
                <td class="tdtitle">Monday</td>
                <td >&nbsp;</td>
                <td >19:30<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="tdtitle">Wednesday</td>
                <td >&nbsp;</td>
                <td >19:30<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="tdtitle">Friday</td>
                <td >&nbsp;</td>
                <td >19:30<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
                <td >&nbsp;</td>
              </tr>
              </tbody>
            </table>
          </div>

        	  <header>
        	    <h4>September ~ adults</h4>
        	  </header>
          <div class="table-responsive">
            <table class="table table-striped">
            <tbody>
              <tr>
                <td class="tdtitle">Monday</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">Tuesday</td>
                <td >07:00<span class="nomobile">-</span><span class="mobile"> </span>08:00</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">Thursday</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">Friday</td>
                <td >07:00<span class="nomobile">-</span><span class="mobile"> </span>08:00</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              </tbody>
            </table>
          </div>
          <!--p>La responsabile del dojo &egrave; Laura Benevelli, 3° dan Aikikai d'Italia, Aikikai Tokyo</p-->
      	</div>

      </section>
      
      <section class="color">
        <p>&#9671;&#9671;</p>
      </section>

      <?php 
        if($semID != null && $semID != ""){
      ?>


      <section id="nextseminar" class="odd">
        <div class="container">
           <header>
            <h2>Next upcoming event</h2>
          </header>
          <div class="row">
            <?php if(strlen(trim($seminario->photo)) > 0) {?>
              <div class="col-xs-12 col-sm-4 col-lg-4 cntr">
                    <img class="img-responsive thumbnail" src="seminars/<?php echo $seminario->photo?>" />
              </div>              
              <div class="col-xs-12 col-sm-6 col-lg-6">
            <?php } else { ?>
              <div class="col-xs-12 col-sm-12 col-lg-12">
            <?php } ?>
                  <h4><? echo $seminario->title ?></h4>
                  <ul class="leftindent">
                      <li class="itemli"><span class="itemhead">When:</span> <span class='itemval'>
                      <span class="nomobile"><? echo $from; ?> <em>-</em> <? echo $to; ?></span>
                      <span class="mobile"><? echo $fromMob; ?> <em>-</em> <? echo $toMob; ?></span>
                      </span>
                      <li class="itemli"><span class="itemhead">Where:</span> <span class='itemval'>
                        <? echo $seminario->shortcity; ?></span>
                      <li class="itemli"><span class="itemhead">Instructor(s):</span>
                    <?php
                       $num = count($istruttori);

                       for($i = 0; $i < $num; $i++){
                            echo "<span class='itemval'>";
                            echo $istruttori[$i]['firstname'] . " " . strtoupper($istruttori[$i]['lastname']) . ", " . $istruttori[$i]['rank'];
                            echo "</span></li>";
                            if($i < $num - 1)
                              echo "<li class='itemli'><span class='itemhead'></span>";
                       }
                    ?>
                        <li class="itemli"><span class="itemhead">Flyer:</span>
                    <?php if($seminario->pdf != '') { ?>
                        <a class="anoborder" title="download the flyer" href="./seminars/<?php echo $seminario->pdf; ?>">pdf &nbsp; <span class="icon fa-file-pdf-o"></span></a>
                     <?php } else { ?>
                          available soon 
                     <?php } ?>
                    </ul>
               </div> 
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
              Complete list of this year seminars <a href="./seminari.php"><span class="icon fa-sign-out"></span></a> (in Italian)
            </div>
          </div>
        </div>
      </section>

      <section class="color">
        <p>&#9671;&#9671;</p>
      </section>
      <?php } ?>


      <section id="photos" class="even">
        <div class="container">  
          <header>
            <h2>Photos</h2>
          </header>  
          <div class="features">
            <article>
              <a href="./galleria.php" target="_blank" class="image"><img class="thumbnail" src="photos/2016-dojo.jpg" alt="" width="200px"></a>
              <div class="inner">
                <h4>Dojo photo gallery</h4>
                <p>photos: <a target="_blank" href="./galleria.php"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>

            <article>
              <a href="https://www.facebook.com/media/set/?set=a.10155637520434171.1073741848.98851534170&type=1&l=e244b77b2e" class="image"><img class="thumbnail" src="photos/201707.jpg" alt=""></a>
              <div class="inner">
                <h4>Aikido summer camp 2017</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.10155637520434171.1073741848.98851534170&type=1&l=e244b77b2e"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>

            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1925320057751789.1073741848.1670690169881447&type=1&l=5639ac360e" class="image"><img class="thumbnail" src="photos/20170430.jpg" alt=""></a>
              <div class="inner">
                <h4>Weapons seminar - April 2017</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1925320057751789.1073741848.1670690169881447&type=1&l=5639ac360e"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>


            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1896509150632880.1073741847.1670690169881447&type=1&l=a14a88f3fa" class="image"><img class="thumbnail" src="photos/20170311.jpg" alt=""></a>
              <div class="inner">
                <h4>Mu, VI and V Kyu seminar - March 2017</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1896509150632880.1073741847.1670690169881447&type=1&l=a14a88f3fa"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1883872098563252.1073741845.1670690169881447&type=1&l=bfae86b123" class="image"><img class="thumbnail" src="photos/20170211.jpg" alt=""></a>
              <div class="inner">
                <h4>Osawa Shihan seminar - February 2017</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1883872098563252.1073741845.1670690169881447&type=1&l=bfae86b123"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1886584914958637.1073741846.1670690169881447&type=1&l=c278d40c95" class="image"><img class="thumbnail" src="photos/20170225.jpg" alt=""></a>
              <div class="inner">
                <h4>Bogdanovic Sensei seminar - February 2017</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1886584914958637.1073741846.1670690169881447&type=1&l=c278d40c95"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1874352916181837.1073741843.1670690169881447&type=1&l=087c64b363" class="image"><img class="thumbnail" src="photos/20170128.jpg" alt=""></a>
              <div class="inner">
                <h4>V, IV and III Kyu seminar - January 2017</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1874352916181837.1073741843.1670690169881447&type=1&l=087c64b363"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1858810281069434.1073741839.1670690169881447&type=1&l=99201c48be" class="image"><img class="thumbnail" src="photos/20161226.jpg" alt=""></a>
              <div class="inner">
                <h4>End of the year seminar - 2016</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1858810281069434.1073741839.1670690169881447&type=1&l=99201c48be"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1837455226538273.1073741838.1670690169881447&type=1&l=64bca56a96" class="image"><img class="thumbnail" src="photos/20161120.jpg" alt="" width="200px"></a>
              <div class="inner">
                <h4>Yudansha, I, II and III kyu seminar - November 2016</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1837455226538273.1073741838.1670690169881447&type=1&l=64bca56a96"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1807434562873673.1073741837.1670690169881447&type=1&l=f1f765d7a1" class="image"><img class="thumbnail" src="photos/20160924gruppo.jpg" alt="" width="200px"></a>
              <div class="inner">
                <h4>Opening seminar 2016-17</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1807434562873673.1073741837.1670690169881447&type=1&l=f1f765d7a1"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1705859776364486.1073741835.1670690169881447&type=1&l=0bfb9df410" class="image"><img class="thumbnail" src="photos/2016-osawa.jpg" alt="" width="200px"></a>
              <div class="inner">
                <h4>Osawa Shihan seminar</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1705859776364486.1073741835.1670690169881447&type=1&l=0bfb9df410"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1697283107222153.1073741834.1670690169881447&type=1&l=bb98b34d73#" class="image"><img class="thumbnail" src="photos/2016-56kyu.jpg" alt=""></a>
              <div class="inner">
                <h4>VI and V Kyu seminar</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1697283107222153.1073741834.1670690169881447&type=1&l=bb98b34d73"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="https://www.facebook.com/media/set/?set=a.1688545051429292.1073741832.1670690169881447&type=1&l=910662fb65" class="image"><img class="thumbnail" src="photos/20151226.jpg" alt=""></a>
              <div class="inner">
                <h4>End of the year seminar - 2015</h4>
                <p>photos: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1688545051429292.1073741832.1670690169881447&type=1&l=910662fb65"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
          </div>      
        </div>
      </section>

      <section class="color">
        <p>&#9671;&#9671;</p>
      </section>   
      
      <!-- Link -->
      <section id="link" class="odd">
      	<div class="container">
      	  
      	  <header>
      	    <h2>Links</h2>
      	  </header>

      	  <div class="link">
      	    <ul class="wbullets">
      			<li><a href="http://www.aikikai.it" target="_blank" title="Aikikai Italia">www.aikikai.it</a></li>
      			<li><a href="http://www.aikikai.or.jp" target="_blank" title="Aikikai Giappone">www.aikikai.or.jp</a></li>
      			<li><a href="http://www.aikidorenbukai.it" target="_blank" title="Aikido Renbukai">www.aikidorenbukai.it</a></li>
      			<li><a href="http://www.fujinami.it" target="_blank" title="Aikido Fujinami Bologna">www.fujinami.it</a></li>
            <li><a href="http://www.kikaidojo.it" target="_blank" title="Kikai Dojo">www.kikaidojo.it</a></li>
            <li><a href="http://www.aikidopordenone.com" target="_blank" title="Aikido Pordenone">aikidopordenone.com</a></li>
            <li><a href="http://www.aikidowatanabedojo.it" target="_blank" title="Aikido Watanabe">www.aikidowatanabedojo.it</a></li>
      	    </ul>
      	  </div>
      	  
      	</div>
      </section>

      <section class="color">
        <p>&#9671;&#9671;</p>
      </section>   

      <!-- Info -->
      <section id="info" class="even">
        <div class="container">

          <header>
          <h2>Contacts</h2>
          </header>

          <div class="row">
            <p>Dojo responsible: Laura Benevelli, IV dan Aikikai d'Italia, Aikikai Tokyo.</p>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-6">
            Contact us:
              <ul class="wbullets">
                <li class="itemli"><span class="itemhead">In the dojo:</span><span class="itemval">Loreto area, small private road from via Porpora 43-47<br/><i>Pharmacy on the corner</i>.<br/>Red and Green Metro lines (Loreto stop) and busses 62 and 81.</span></li>
                <li class="itemli"><span class="itemhead">Phone:</span><span class="itemval">(+39) 3881517258</span></li>
                <li class="itemli"><span class="itemhead">Email:</span><span class="itemval">segreteria@aikikaimilano.it</span></li>            
              </ul>  
              <p>Desk hours:<br/>
                  &#9671;&nbsp;Monday, Tuesday and Friday: 17:30-19:30<br/>
                  &#9671;&nbsp;Wednesday: 17:30-18:30<br/>
                  &#9671;&nbsp;Thursday: 18:00-20:00</p>
              </div>



              <div class="col-xs-12 col-sm-6 col-lg-6">
                 <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1398.578193092592!2d9.22148602746856!3d45.48679546000087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4786c6e45a43eff1%3A0xaa50fad891bebd!2sAikikai+Milano!5e0!3m2!1sen!2sit!4v1464555022194"  frameborder="0" style="border:0" allowfullscreen></iframe>
              </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <p class="note">Associazione Sportiva Dilettantistica <span class="black">Aikikai Milano</span> - 
              via Lulli, 30 - 20131 Milano - Italia</p>
            </div>
          </div>
        </div>
      </section>

      <section class="color mobile">
        <p>&#9671;&#9671;</p>
      </section>   

      <section id="aikikaiitalia" class="odd mobile">
        <div class="row">
          <div class="col-xs-2 col-sm-2 col-lg-2">
            <p class="text-left">
            <a class="noborder" href="http://www.aikikai.it" target=_blank><img src="assets/img/aikikaiitalia.png" alt="aikikai d'italia" width="64px"></a>&nbsp;</p>
          </div>
          <div class="col-xs-8 col-sm-8 col-lg-8">
          <p class="smallnote text-center">School affiliated with Associazione di Cultura<br/>Tradizionale Giapponese Aikikai d'Italia Ente<br/>Morale (D.P.R. luglio 1978 n. 528)<span class='nomobile'><br/></span> and Centro Sportivo Educativo Nazionale</p>
          </div>
          <div class="col-xs-2 col-sm-2 col-lg-2">
            <p class="text-left">
            <a class="noborder" href="http://www.csen.it" target=_blank><img src="assets/img/csen.png" alt="CSEN" width="64px"></a>
            </p>
          </div>        
        </div>
      </section>


      <section class="color">
        <p>&#9671;&#9671;</p>
      </section>   

    </div><!-- wrapper/main -->
    
    <!-- Footer -->
	 <?php include('./footer.php'); ?>

  <!-- google -->
  <?php include_once("analyticstracking.php") ?>
      
    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrolly.min.js"></script>
    <script src="assets/js/jquery.scrollzer.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="assets/js/main.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
  </body>
</html>
