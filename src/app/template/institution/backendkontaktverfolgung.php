<?php
  $title = 'tracely | Kontaktverfolgung';
  $styles = ['backend/style-backend.css', 'backend/style-backendkontaktverfolgung.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">

            <div class="BackendBox" id="kontaktverfolgung">
              <h1>Kontaktpersonennachverfolgung</h1>
              <div class="KontaktverfolgungBox">
                <h3>Datum</h3>
                <p>Wählen Sie ein Datum, um sich alle Besucher Ihrer Institution an diesem Tag anzeigen zu lassen.</p>
                <form action="<?= Url::find('backend-institution-kontaktpersonen') ?>" method="get">
                  <?=$scan->renderField("zeitpunkt", "TT.MM.JJJJ", "aInput")?><br>
                  <button type="submit" name="button" class="aButton aButtonInvert">Besucher anzeigen</button>
                </form>
              </div>
              <div class="KontaktverfolgungBox">
                <h3>Tischnummer</h3>
                <p>Wählen Sie eine Tischnummer, um sich alle Besucher Ihrer Institution an diesem Tisch zum gewählten DAtum anzeigen zu lassen.</p>
                <form action="<?= Url::find('backend-institution-kontaktpersonen') ?>" method="post">
                  <?=$scan->renderField("zeitpunkt", "TT.MM.JJJJ", "aInput")?>
                  <?=$code->renderField("tischnummer", "Tischnummer", "aInput")?><br>
                  <button type="submit" name="button" class="aButton aButtonInvert">Besucher anzeigen</button>
                </form>
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
