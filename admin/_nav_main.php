        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li><a href="./adm_index.php">Home</a></li>
            <li><a href="./adm_news_list.php">Notizie</a></li>
            <li><a href="./adm_seminar_list.php">Seminari</a></li>
          </ul>
          <!--ul class="nav nav-sidebar">
            <li><a href="">Insegnanti</a></li>
            <li><a href="">Orario</a></li>
            <li><a href="">Dojo</a></li>
          </ul-->
          <?php if(date('M') >= 9) $year = date('Y'); else $year = date('Y') - 1; ?>
          <ul class="nav nav-sidebar">
            <li><a href="./adm_aikidoka_list.php">Iscritti</a></li>
            <li><a href="./adm_attendance_month.php">Presenze mensili</a></li>
            <li><a href="./adm_attendance_year_detail.php?y=<?php echo $year ?>">Presenze dell'anno in corso</a></li>
          </ul>
        </div>
