<?php  session_start(); ?>
<!DOCTYPE html>
<html lang="it">
  <head>
<?php  
  include("./class.db.php");
  include("./class.login.php");
  include("./class.seminar.php");
  include("./class.utilities.php");
  $log = new logmein();
  $log->encrypt = true; //set encryption 
  $isLogged = $log->logincheck($_SESSION['loggedin'], "user_t", "passwd", "login"); 
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="admin website">
    <meta name="author" content="cbolk">
    <link rel="icon" href="../assets/favicon.png">

    <title>seminari</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/jquery-ui-1.8.20.custom.css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/dashboard.css" rel="stylesheet">
    <link href="../assets/css/dashboardAM.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type='text/javascript' src='//code.jquery.com/jquery-2.1.1.min.js'></script>
    <script type="text/javascript" language="javascript" src="../assets/js/jquery-ui-1.8.20.custom.min.js" ></script>   

    <script>
    $(document).ready(function() {
        var hash = window.location.hash;
        $(hash).css('background-color', '#d7e7f4').animate({
            backgroundColor: '#d7e7f4'
        }, 2000);

      $('a.del').click(function(e) {
        e.preventDefault();
        var parent = $(this).parent();
        var row = parent.parent();
        var value = parent.attr('id').replace('record-','');
        $.ajax({
          type: 'post',
          url: 'adm_seminar_del.php',
          data: 'del=' + value,
          beforeSend: function() {
            row.css('background-color', '#ff4d4d').animate({
              backgroundColor: '#ff4d4d'
            }, 500);
          },
          success: function(data) {
            //alert(data);
            row.slideUp(300,function() {
              row.remove();
            });
          }
        });
      });
    });
  </script>

    <script>
    $(function(){
      //acknowledgement message
        var message_status = $("#status");
      $(':checkbox').checkboxpicker();
      $(':checkbox').checkboxpicker().change(function() {
            var field_userid = $(this).attr("id") ;
            var value = $(this).prop('checked');
        $.ajax({
          type: 'post',
          url: 'adm_seminar_list_check_update.php',
          data: field_userid + "=" + value,
          beforeSend: function() {
                  //alert("aggiorno");
                },
          success: function(response) {
            //alert(response);
          }
        });           
      });
    });
    </script>
  </head>

  <body>
<?php
  if($isLogged == false) { 
    header("Location: adm_index.php");
    exit;
  } 
?>

    <?php include('./_nav_top.htm'); ?>

    <div class="container-fluid">
      <div class="row">
        <?php include('./_nav_main.php'); ?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<?php
  $db = new dbaccess();
  $sem = new seminar();
  $cu = new utils();
  $num = $sem->numActiveSeminars($db);
  $numh = $sem->numNotVisibleSeminars($db);
  $list = $sem->rawlist($db,false,false,false);
?>
          <h1 class="page-header">Seminari 
            <button type="button" title="in elenco" class="btn visibili btn-default btn-circle btn-xl"><?php echo mysql_num_rows($list) ?></button>
    	      <button type="button" title="futuri" class="btn btn-success btn-circle btn-xl"><?php echo $num; ?></button>
            <button type="button" title="non visibili" class="btn btn-danger btn-circle btn-xl"><?php echo $numh ?></button>
		 </h1>
          <div class="row">
            <div class=" actions aright">
              <a href="./adm_seminar_new.php" alt="aggiungi un nuovo seminario"><i class="fa fa-calendar-plus-o"></i> nuovo</a>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>dal</th>
                  <th>al</th>
                  <th>luogo</th>
                  <th>titolo</th>
                  <th>diretto da</th>
                  <th>pdf</th>
                  <th>img</th>
                  <th>edit</th>
                  <th>del</th>
                  <th>vis</th>
                </tr>
              </thead>
              <tbody>
<?php while($row = mysql_fetch_assoc($list)){
      $sid = $row['id'];
      $s = new seminar();
      $loc = $s->getStageLocation($db,$sid);
      $instr = $s->getStageInstructors($db,$sid);
      $nin = count($instr);

      echo "<tr id='" . $sid . "' ><a name='" . $sid . "'></a>";
      echo "<td class='seminar_data'>" . $cu->date2monthday($row['startdate']) . "</td>";
      echo "<td class='seminar_data'>" . $cu->date2monthday($row['enddate']) . "</td>";
      echo "<td  class='seminar_info'>";
      if($loc[0]['name'] != "")
        echo $loc[0]['name']  . "<br/>" . $loc[0]['shortcity'];
      else
        echo $row['location']. "<br/>" . $row['shortcity'];
      echo  "</td>";
      echo "<td class='seminar_title'>" . $row["title"] . "</td>";
      echo "<td class='seminar_info'>";
      for($i = 0; $i < $nin; $i++){
        echo "M&deg;&nbsp;" . $instr[$i]['lastname'];
        if($i < $nin - 1)
          echo "<br/>";
      }
      
      echo "</td>";
      echo "<td class='tableicon seminar_info'>";
      if($row['pdf'] != "")       
        echo "<i class='fa fa-file-pdf-o'></i>";
      echo "</td>";

      echo "<td class='tableicon seminar_info'>";
      if($row['photo'] != "")       
        echo "<i class='fa fa-picture-o'></i>";
      echo "</td>";

      echo "<td class='seminar_info' id='record-" . $sid . "'><a class='edit' href='adm_seminar_edit.php?edit=" . $sid . "'><i class='fa fa-pencil-square-o'></i></a></td>";
      echo "<td class='seminar_info' id='record-" . $sid . "'><a class='del' href='#'><i class='fa fa-trash'></i></a></td>";

      echo "<td class='cntr' id='visible:" . $row['id'] . "' contenteditable='true'>";
      echo "<input data-style='btn-group-xs' class='form-control' name='visible' id='visible:" . $sid . "' type='checkbox' data-off-title='NO' data-on-title='SI' data-on-class='btn-success' data-off-class='btn-danger' ";
      if($row['visible'] === "1")
        echo " checked "; 
      echo " />";
      echo "</td>";


      echo "</tr>";
    }
    echo "</div>";
  
  ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="../assets/js/jquery-1.7.2.min.js"><\/script>')</script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/bootstrap-checkbox.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../assets/js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../assets/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../assets/js/fileinput.js"></script>
  </body>
</html>
