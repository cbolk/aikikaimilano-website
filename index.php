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
  $seminario = $seminar->get($db,$semID);
  $from = $u->medDate($seminario->fromdate);
  $fromMob = $u->medDate($seminario->fromdate);
  $to = $u->medDate($seminario->todate);
  $toMob = $u->medDate($seminario->todate);
  $istruttori = $seminar->getStageInstructors($db,$semID);

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
    <link rel="apple-touch-icon-precomposed" href="assets/favicon_t.png" />
    <link rel="shortcut icon" href="assets/favicon.png">
  </head>
  <body>
    
    <!-- Header -->
	<?php include('./header.php'); ?>
    
    
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
                  <blockquote class="pull-right">
                       Non ci sono competizioni nell'arte della guerra. Un vero guerriero &egrave; invincibile perch&egrave; non compete contro nulla. Vincere significa sconfiggere la mente conflittuale che si annida dentro di noi.
                       <small> <cite>Morihei Ueshiba</cite></small>
                  </blockquote>

          		    <p>A prima vista l’Aikido si presenta come un elegante metodo di autodifesa personale finalizzato alla neutralizzazione, mediante bloccaggi, leve articolari e proiezioni di uno o pi&ugrave; aggressori disarmati o armati. Sintesi ed evoluzione di antiche tecniche mutate dal <em>Jujutsu</em> classico e dal <em>Kenjutsu</em> (la pratica della spada), l’Aikido trova la propria originalit&agrave; ed efficacia in una serie di movimenti basati sulla rotazione sferica.</p>
              </div>
          </div>
          <div class="row">
              <div class="col-xs-12">
                  <p>Contrariamente ad altre arti marziali incentrate sui movimenti lineari (avanti, indietro e in diagonale), le tecniche dell’Aikido si fondano e si sviluppano su un movimento circolare il cui perno &egrave; colui che si difende. In tal modo egli stabilizza il proprio baricentro, decentra quello dell'avversario attirandolo nella propria orbita, e pu&ograve; sfruttare a proprio vantaggio l'energia prodotta dall'azione aggressiva fino a neutralizzarla.</p>
              </div>
          </div>
          <div class="row">
              <div class="col-xs-12 col-sm-6 col-lg-6  text-center">
                  <img class="img-responsive thumbnail" src="photos/morihei-ueshiba-throwing-tada.jpg" alt="Morihei Ueshiba Throwing Tada" width="440px" />
                  <p class="imgcaption">Ueshiba Morihei, fondatore dell'Aikido<br/>
                  (dal sito <a href="http://blog.aikidojournal.com" target="_blank">Aikido Journal</a>)</p>
               </div>
              <div class="col-xs-12 col-sm-6 col-lg-6">
                  <p>L'Aikido (letteralmente: Via dell'energia e dell'armonia, da Ai 合 Armonia, Ki 気 Energia Cosmica, e Do 道 Via) &egrave; il risultato di lunghi anni di studio condotti dal suo fondatore, Morihei Ueshiba.<br/>
Proponendosi in primo luogo come via di educazione morale e di mutuo rispetto, l’Aikido rifiuta di diventare uno sport competitivo, non vi sono gare ma solamente esami per passare da un livello a quello successivo e dimostrazioni per poter far conoscere all’esterno la bellezza del movimento.</p>
              </div> 
          </div> 
          <div class="row">
              <div class="col-xs-12 col-sm-8 col-lg-8">
                  <img class="img-responsive thumbnail text-center" src="photos/Ueshiba-Kisshomaru-loc.png" alt="Kisshomaru Ueshiba" width="600px" />
                  <p class="imgcaption">Ueshiba Kisshomaru, il secondo Doshu<br/>
                   (fonte: <a href="http://blog.aikidojournal.com" target="_blank">Aikido Journal</a>)</p>
              </div>
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-8 col-lg-8">
              <p>Non avendo finalit&agrave; agonistiche &egrave; possibile vedere in un dojo di Aikido persone di tutte le 
              et&agrave;. Il tipo di pratica sviluppa tra gli allievi una forma di cooperazione per cui i praticanti si 
              aiutano vicendevolmente, progredendo insieme. Viene data molta importanza all'etichetta e al rispetto 
              reciproco tra praticanti con il fine di creare un'atmosfera che aiuti nell'apprendimento di uno stile di vita 
              positivo e corretto.<br/>Diverse sono le motivazioni che possono spingere una persona alla pratica di quest'Arte, alcuni saranno 
              interessati alla sua filosofia, alcuni alla sua applicazione marziale mentre altri saranno semplicemente 
              attratti dalla bellezza del movimento.</p>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-4 cntr">
              <img class="img-responsive thumbnail" src="http://www.ueshibaaikido.org/Images/Images/Doshu/doshu.jpg" alt="Attuale Doshu" width="250px"/>
              <p class="imgcaption">Ueshiba Moriteru, l'attuale Doshu<br/>
               (dal sito dell'<a href="http://www.aikikai.or.jp/eng/aikido/history.html" target="_blank">Aikikai Foundation</a>)</p>
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
                 <p class="imgcaption">La famiglia Ueshiba<br/>
                (dal sito <a href="http://www.aikikai.or.jp/eng/aikido/history.html" target="_blank">Aikikai Foundation</a>)</p>
                </div>
          </div>
          <div class="row">          
            <div class="col-xs-12 col-sm-12 col-lg-12">
              <blockquote class="pull-right">
                   Le tecniche utilizzano quattro qualit&agrave; che riflettono la natura del nostro mondo. Secondo la circostanza, dovreste essere: duri come un diamante, flessibili come un salice, fluidi come l'acqua, o vuoti come lo spazio.
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
              <h2>il Maestro Fujimoto</h2>
          </header>
          <div class="row">
              <div class="col-xs-12 col-sm-8 col-lg-8 text-center">
                <img class="img-responsive thumbnail" src="photos/maestrofujimoto.jpg" alt="Il Maestro Fujimoto" width="600px" /> 
              </div>
              <div class="col-xs-12 col-sm-4 col-lg-4">
              <p>Il Dojo, fondato direttamente dal Maestro Fujimoto (VIII dan e Shihan Aikikai Hombudojo), ha una storia di 40 anni sotto il suo diretto insegnamento e dopo la sua scomparsa, nel febbraio del 2012, continua a seguire la linea etica, morale e didattica del suo fondatore.</p>
              </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <p>Il Maestro Fujimoto, nato a Yamaguchi nel 1948, viene mandato in Italia per aiutare la diffusione dell’Aikido nel continente e diventa vicedirettore didattico dell'Aikikai d’Italia.<br/>
              Arriva a Milano del 1971 e qui vi rimane tutta la sua vita, consolidando una delle scuole pi&ugrave; importanti d'Europa.<br/>
              In oltre 40 anni di permanenza in Italia, Fujimoto Sensei ha contribuito notevolmente alla crescita dell'Aikido sul territorio, spaziando anche oltre confine in tutta Europa, Russia e Sud Africa.<br/>
              Il Maestro Fujimoto &egrave; venuto a mancare nel febbraio del 2012, garantendo la continuit&agrave; del suo stile aikidoistico e del suo Dojo.</p>
              </div>
            </div>
          <div class="row">
            <div class="col-xs-12 text-center">
                <img class="img-responsive thumbnail" src="photos/maestrofujimoto2.jpg" alt="Il Maestro Fujimoto" />
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
    	    <h2>Corsi e orari</h2>
    	  </header>
  	  
        <p>Presso l'Aikikai Milano &egrave; possibile frequentare corsi in base 
            al proprio livello e alla propria et&agrave;:</p>
         <div class="table-responsive">
           <table class="table table-striped">
             <tbody>
              <tr>
                <td class="tdtitle">pre-aikido</td>
                <td >anni 5-6</td>
                <td ><span class="nomobile">ottobre&#8209;giugno</span><span class="mobile">ott-giu</span></td>
                <td class="text-right"><span class="nomobile">mer. 17:00</span><span class="mobile">me 17&ndash;18</span><span class="nomobile">&ndash;18:00</span></td>
              </tr>
              <tr>
                <td class="tdtitle">bambini</td>
                <td >anni 7-10</td>
                <td ><span class="nomobile">ottobre&#8209;giugno</span><span class="mobile">ott-giu</span></td>
                <td class="text-right"><span class="nomobile">lun. 17:00</span><span class="mobile">lu 17&ndash;18</span><span class="nomobile">&ndash;18:00</span><span class="nomobile"><br/></span>
                            <span class="nomobile">gio. 17:00</span><span class="mobile">gi 17&ndash;18</span><span class="nomobile">&ndash;18:00</span></td>
              </tr>
              <tr>
                <td class="tdtitle">ragazzi</td>
                <td >anni 11-14</td>
                <td ><span class="nomobile">ottobre&#8209;giugno</span><span class="mobile">ott-giu</span></td>
                <td class="text-right"><span class="nomobile">mar. 17:00</span><span class="mobile">ma 17&ndash;18</span><span class="nomobile">&ndash;18:00</span><span class="nomobile"><br/></span>
                            <span class="nomobile">ven. 17:00</span><span class="mobile">ve 17&ndash;18</span><span class="nomobile">&ndash;18:00</span></td>
              </tr>
              <tr>
                <td colspan="2" class="tdtitle">principianti</td>
                <td ><span class="nomobile">ottobre&#8209;giugno</span><span class="mobile">ott-giu</span></td>
                <td class="text-right"><span class="nomobile">mar. 19:00</span><span class="mobile">ma 19&ndash;20</span><span class="nomobile">&ndash;20:00</span><span class="nomobile"><br/></span>
                            <span class="nomobile">gio. 20:00</span><span class="mobile">gi 20&ndash;21</span><span class="nomobile">&ndash;21:00</span><span class="nomobile"><br/></span>
                            <span class="nomobile">ven. 19:00</span><span class="mobile">ve 19&ndash;20</span><span class="nomobile">&ndash;20:00</span></td>
              </tr>
              <tr class="nomobile">
                <td colspan="4" class="note"></td>
              </tr>
              <tr class="nomobile">
                <td colspan="4" class="note">
            Il corso principianti &egrave; aperto a tutti coloro che non conoscono e non hanno mai praticato Aikido. L’et&agrave; minima &egrave; 14 anni e non vi &egrave; un'et&agrave; massima. Le iscrizioni possono avvenire durante tutto l'anno, gli assistenti del corso vi possono seguire individualmente fino al raggiungimento del livello del resto del gruppo che ha iniziato ad ottobre.
                </td>
              </tr>
              <tr>
                <td colspan="2" class="tdtitle">avanzati</td>
                <td colspan="2">tutto l'anno<span class="nomobile">, vedi dettagli</span></td>
              </tr>
              </tbody>
            </table>
          </div>
            <p class="mobile">Il corso principianti &egrave; aperto a tutti coloro che non conoscono e non hanno mai praticato Aikido. L’et&agrave; minima &egrave; 14 anni e non vi &egrave; un'et&agrave; massima. Le iscrizioni possono avvenire durante tutto l'anno, gli assistenti del corso vi possono seguire individualmente fino al raggiungimento del livello del resto del gruppo che ha iniziato ad ottobre.</p>
            <header>
              <h4>ottobre-giugno ~ avanzati</h4>
            </header>

          <div class="table-responsive">
            <table class="table table-striped">
            <tbody>
              <tr>
                <td class="tdtitle"><span class="nomobile">luned&igrave;</span><span class="mobile">lu</span></td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00<sup><span class="small icon fa-star-o" aria-hidden="true"></span></sup></td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">marted&igrave;</span><span class="mobile">ma</span></td>
                <td >07:00<span class="nomobile">-</span><span class="mobile"> </span>08:00</td>
                <td >13:00<span class="nomobile">-</span><span class="mobile"> </span>14:00</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >&nbsp;</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">mercoled&igrave;</span><span class="mobile">me</span></td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">gioved&igrave;</span><span class="mobile">gi</span></td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">venerd&igrave;</span><span class="mobile">ve</span></td>
                <td >07:00<span class="nomobile">-</span><span class="mobile"> </span>08:00</td>
                <td >13:00<span class="nomobile">-</span><span class="mobile"> </span>14:00</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >&nbsp;</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle"><span class="nomobile">sabato</span><span class="mobile">sa</span></td>
                <td >10:00<span class="nomobile">-</span><span class="mobile"> </span>11:30</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td colspan="6"><sup><span class="small icon fa-star-o" aria-hidden="true"></span></sup> JO/BOKKEN da ottobre a maggio</td>
              </tr>
            </tbody>
            </table>
          
          </div>

        	  <header>
        	    <h4>luglio ~ avanzati</h4>
        	  </header>
          <div class="table-responsive">
            <table class="table table-striped">
            <tbody>
              <tr>
                <td class="tdtitle">luned&igrave;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">mercoled&igrave;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">venerd&igrave;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              </tbody>
            </table>
          </div>

        	  <header>
        	    <h4>agosto ~ avanzati</h4>
        	  </header>
          <div class="table-responsive">
            <table class="table table-striped">
            <tbody>
              <tr>
                <td class="tdtitle">luned&igrave;</td>
                <td >&nbsp;</td>
                <td >19:30<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="tdtitle">mercoled&igrave;</td>
                <td >&nbsp;</td>
                <td >19:30<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td class="tdtitle">venerd&igrave;</td>
                <td >&nbsp;</td>
                <td >19:30<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
                <td >&nbsp;</td>
              </tr>
              </tbody>
            </table>
          </div>

        	  <header>
        	    <h4>settembre ~ avanzati</h4>
        	  </header>
          <div class="table-responsive">
            <table class="table table-striped">
            <tbody>
              <tr>
                <td class="tdtitle">luned&igrave;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">marted&igrave;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">gioved&igrave;</td>
                <td >18:00<span class="nomobile">-</span><span class="mobile"> </span>19:00</td>
                <td >19:00<span class="nomobile">-</span><span class="mobile"> </span>20:00</td>
                <td >20:00<span class="nomobile">-</span><span class="mobile"> </span>21:00</td>
              </tr>
              <tr>
                <td class="tdtitle">venerd&igrave;</td>
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


      <section id="nextseminar" class="odd">
        <div class="container">
           <header>
            <h2>Il prossimo appuntamento</h2>
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
                      <li class="itemli"><span class="itemhead">Quando:</span> <span class='itemval'>
                      <span class="nomobile"><? echo $from; ?> <em>-</em> <? echo $to; ?></span>
                      <span class="mobile"><? echo $fromMob; ?> <em>-</em> <? echo $toMob; ?></span>
                      </span>
                      <li class="itemli"><span class="itemhead">Dove:</span> <span class='itemval'>
                        <? echo $seminario->shortcity; ?></span>
                      <li class="itemli"><span class="itemhead">Diretto da:</span>
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
                        <li class="itemli"><span class="itemhead">Locandina:</span>
                    <?php if($seminario->pdf != '') { ?>
                        <a class="anoborder" title="scarica la locandina" href="./seminars/<?php echo $seminario->pdf; ?>">pdf &nbsp; <span class="icon fa-file-pdf-o"></span></a>
                     <?php } else { ?>
                          disponibile prossimamente 
                     <?php } ?>
                    </ul>
               </div> 
          </div>
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-12">
              Vai alla lista completa di seminari dell'anno in corso <a href="./seminari.php"><span class="icon fa-sign-out"></span></a>
            </div>
          </div>
        </div>
      </section>

      <section class="color">
        <p>&#9671;&#9671;</p>
      </section>


      <section id="photos" class="even">
        <div class="container">  
          <header>
            <h2>Fotografie</h2>
          </header>  
          <div class="features">
            <article>
              <a href="#" class="image"><img class="thumbnail" src="photos/2016-dojo.jpg" alt="" width="200px"></a>
              <div class="inner">
                <h4>Galleria fotografica del dojo</h4>
                <p>Album foto: <a target="_blank" href="./galleria.php"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="#" class="image"><img class="thumbnail" src="photos/20160924gruppo.jpg" alt="" width="200px"></a>
              <div class="inner">
                <h4>Seminario Inizio anno 2016-17</h4>
                <p>Album foto: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1807434562873673.1073741837.1670690169881447&type=1&l=f1f765d7a1"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="#" class="image"><img class="thumbnail" src="photos/2016-osawa.jpg" alt="" width="200px"></a>
              <div class="inner">
                <h4>Seminario Osawa Shihan</h4>
                <p>Album foto: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1705859776364486.1073741835.1670690169881447&type=1&l=0bfb9df410"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="#" class="image"><img class="thumbnail" src="photos/2016-56kyu.jpg" alt=""></a>
              <div class="inner">
                <h4>Seminario di Aikido per 5° e 6° Kyu</h4>
                <p>Album foto: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1697283107222153.1073741834.1670690169881447&type=1&l=bb98b34d73"><span class="icon fa-picture-o"></span></a></p>
              </div>
            </article>
            <article>
              <a href="#" class="image"><img class="thumbnail" src="photos/20151226.jpg" alt=""></a>
              <div class="inner">
                <h4>Seminario di fine anno - 2015</h4>
                <p>Album foto: <a target="_blank" href="https://www.facebook.com/media/set/?set=a.1688545051429292.1073741832.1670690169881447&type=1&l=910662fb65"><span class="icon fa-picture-o"></span></a></p>
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
      	    <h2>Link</h2>
      	  </header>

      	  <div class="link">
      	    <ul class="wbullets">
      			<li><a href="http://www.aikikai.it" target="_blank" title="Aikikai Italia">www.aikikai.it</a></li>
      			<li><a href="http://www.aikikai.or.jp" target="_blank" title="Aikikai Giappone">www.aikikai.or.jp</a></li>
      			<li><a href="http://www.aikidorenbukai.it" target="_blank" title="Aikido Renbukai">www.aikidorenbukai.it</a></li>
      			<li><a href="http://www.fujinami.it/" target="_blank" title="Aikido Fujinami Bologna">www.fujinami.it</a></li>
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
          <h2>Contatti</h2>
          </header>

          <div class="row">
            <p>La responsabile del dojo &egrave; Laura Benevelli, III dan Aikikai d'Italia, Aikikai Tokyo.</p>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-6 col-lg-6">
            &Egrave; possibile contattarci in uno dei seguenti modi:
              <ul class="wbullets">
                <li class="itemli"><span class="itemhead">In dojo:</span><span class="itemval">zona loreto via privata con ingresso da via Porpora 43-47<br/><i>all'angolo con la farmacia</i></span></li>
                <li class="itemli"><span class="itemhead">Telefono:</span><span class="itemval">(+39) 3881517258</span></li>
                <li class="itemli"><span class="itemhead">Email:</span><span class="itemval">segreteria@aikikaimilano.it</span></li>            
              </ul>  
              <p>Gli orari della segreteria sono i seguenti:<br/>
                  &#9671;&nbsp;luned&igrave;, marted&igrave; mercoled&igrave;: 17:30-19:30<br/>
                  &#9671;&nbsp;gioved&igrave; e venerd&igrave;: 18:00-20:00</p>
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
          <p class="smallnote text-center">Scuola affiliata all'Associazione di Cultura<br/>Tradizionale Giapponese Aikikai d'Italia Ente<br/>Morale (D.P.R. luglio 1978 n. 528)<span class='nomobile'><br/></span> e al Centro Sportivo Educativo Nazionale</p>
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
