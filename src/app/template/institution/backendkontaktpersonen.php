<?php
#Template für die Kontaktpersonennachverfolgungs PDF-Datei, die der Instiution zum Download bereitgestellt wird
  $title = 'tracely | Kontaktpersonen';
  $styles = ['backend/style-backendkontaktverfolgung.css'];

  ob_start();
?>

<div class="BackendBox" id="kontaktverfolgung">
  <h1 class='Test'>Kontaktpersonennachverfolgung</h1>
  <p style="font-size: 12pt;"><?= date('d.m.Y') ?>, <?= date('H:i:s') ?></p>
  <hr>
  <h3>1. Informationen</h3>
  <p>Diese Tabelle listet die Kontaktpersonen der Institution <b><?= $object->name ?></b> auf.</p>

  <h3>2. Parameter</h3>
  <?= $parameter ?>

  <h3>3. Kontaktpersonen</h3>
  <table style="font-size: 11pt;">
    <tr style="font-weight: bolder; font-size: 12pt;">
      <th style="width: 60px">Uhrzeit</th>
      <th style="width: 45px">T-Nr.</th>
      <th style="width: 100px">Nachname</th>
      <th style="width: 100px">Vorname</th>
      <th style="width: 180px">E-Mail</th>
      <th style="width: 120px">Telefonnummer</th>
      <th style="width: 45px">PLZ</th>
    </tr>
    <?php
    for ($i=0; $i < count($scans); $i++) {
    ?>
      <tr>
        <td><?= $scans[$i]['uhrzeit']?></td>
        <td style="text-align: center;"><?= $scans[$i]['tischnummer']?></td>
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
  <br>
  <h3>4. Informationen zur Institution</h3>
  <p><b>Instiutionsname:</b> <?= $object->name ?></p>
  <p><b>Adresse:</b> <?= $object->adresse ?></p>
  <p><b>PLZ / Stadt:</b> <?= $object->plz.' '.$object->stadt ?></p>
  <p><b>E-Mail:</b> <?= $object->email ?></p>
  <br><br>
  <hr>
  <p>Die Kontaktpersonennachverfolgung erfolgte durch Unterstützung von tracely.</p>
  <p><b>Kontakt:</b> kontakt@tracely.de</p>

</div>
<style media="screen">
  p, table {
    margin-left: 30px;
  }
  th, td {
    padding-right: 0px;
  }
</style>

<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('htmlframe.php'));
?>
