<?php
  $title = 'tracely | Kontaktpersonen';
  $styles = ['backend/style-backend.css', 'backend/style-backendkontaktverfolgung.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">

            <div class="BackendBox" id="kontaktverfolgung">
              <h1>Kontaktpersonen</h1>
              <table>
                <tr>
                  <th>Uhrzeit</th><th>Tischnr.</th><th>Nachname</th><th>Vorname</th><th>E-Mail</th><th>Telefonnummer</th><th>PLZ</th>
                </tr>
                <?php
                for ($i=0; $i < count($scans); $i++) {
                ?>
                  <tr>
                    <td><?= $scans[$i]['uhrzeit']?></td>
                    <td><?= $scans[$i]['tischnummer']?></td>
                    <td><?=$scans[$i]['nachname']?></td>
                    <td><?=$scans[$i]['vorname']?></td>
                    <td><?=$scans[$i]['email']?></td>
                    <td><?=$scans[$i]['telefonnummer']?></td>
                    <td><?=$scans[$i]['plz']?></td>
                  </tr>
                <?php
                }
                ?>
              </table>
            </div>

          </div>
        </div>

      </div>
    </div>

<?php $body = ob_get_clean(); ?>


<script type="text/javascript">
  function printPdf() {
    document.getElementById('weg').style.opacity = 0;

    window.print();
  }
</script>

<button id="weg" class="aText" type="button" name="button" onclick="printPdf()">Liste drucken</button>


<?php
  require($this->extend('htmlframe.php'));
?>
