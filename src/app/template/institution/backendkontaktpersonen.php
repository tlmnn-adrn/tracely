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
                    <td><?= $scans[$i]->zeitpunkt?> </td>
                    <td></td>
                    <td><?=$scans[$i]->benutzerId?></td>
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

<?php
  require($this->extend('base.php'));
?>
