<?php
  $title = 'tracely | Übersicht';
  $styles = ['backend/style-backend.css', 'backend/style-backendubersicht.css', 'backend/style-backendubersicht-layout.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <?php
            if ($success) {
              echo '<div class="Success">'.$success.'</div>';
            }
            ?>
            <h1>Willkommen <?= $object->name ?></h1>

            <div class="BackendBox" id="backend-schnellzugriff">
              <h3>Schnellzugriff</h3>
              <p>
                <a href="<?= Url::find('qrcode-erstellen') ?>" class="aButton">QR-Code erstellen</a>
                <a href="<?= Url::find('backend-institution-kontaktverfolgung') ?>" class="aButton">Kontaktverfolgung</a>
              </p>
            </div>

            <div class="BackendBox" id="tischubersicht">
              <h3>Qr-Codeübersicht</h3>
              <table>
                <tr>
                  <th>T-Nr.</th><th>Sitzplätze</th><th colspan="2">Optionen</th><th></th>
                </tr>
                <?php
                for ($i=0; $i < count($qrcodes); $i++) {
                ?>
                  <tr>
                    <td><?= $qrcodes[$i]->tischnummer?> </td>
                    <td><?=$qrcodes[$i]->sitzplätze?></td>
                    <td>
                      <a class="TableIcon" href="<?=Url::find("qrcode-drucken", $qrcodes[$i]->code)?>" target="_blank"><img src="<?= Url::find('static', 'media/backend/print.svg') ?>"></a>
                    </td>
                    <td>
                      <a class="TableIcon" href="<?=Url::find("qrcode-löschen", $qrcodes[$i]->id)?>"><img src="<?= Url::find('static', 'media/backend/delete.svg') ?>"></a>
                    </td>
                  </tr>
                <?php
                }
                ?>
              </table>

            </div>

            <div class="BackendBox" id="backend-zahlen">

              <h3>Scananzahlübersicht</h3>
              <br><br>

              <div id="zahlen">

                <div id="app">
                    <img :src="src" width="960" height="320"/>

                    <br><br><br><br>
                    <button v-on:click="changeImage(7)" class="aButton" v-bind:class="[selected==7 ? 'aButtonFill' : '']">7 Tage</button>
                    <button v-on:click="changeImage(14)" class="aButton" v-bind:class="[selected==14 ? 'aButtonFill' : '']">14 Tage</button>
                    <button v-on:click="changeImage(30)" class="aButton" v-bind:class="[selected==30 ? 'aButtonFill' : '']">30 Tage</button>
                    <button v-on:click="changeImage(60)" class="aButton" v-bind:class="[selected==60 ? 'aButtonFill' : '']">60 Tage</button>
                    <button v-on:click="changeImage(90)" class="aButton" v-bind:class="[selected==90 ? 'aButtonFill' : '']">90 Tage</button>
                </div>

                <script src="https://unpkg.com/vue@next"></script>
                <script src="<?=Url::find('static', 'js/getHistorySvg.js')?>"></script>
              </div>

            </div>

          </div>
        </div>

      </div>
    </div>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('base.php'));
?>
