<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="<?= $this->link("")?>static/js/headerscroll.js"></script>
    <script src="<?= $this->link("")?>static/js/start.js"></script>
    <link rel="shortcut icon" href="<?= $this->link("")?>static/media/favicon.ico">

    <link rel='stylesheet' href='<?= $this->url('static', 'style/style.css') ?>'>

    <?php if (AuthModel::isLoggedIn()): ?>
      <link rel='stylesheet' href='<?= $this->link("")?>static/style/style-backend.css'>
    <?php endif ?>
    <?php if(isset($styles)): ?>
        <?php foreach($styles as $style): ?>
            <link rel='stylesheet' href='<?= $this->link("")?>static/style/<?=$style?>'>
        <?php endforeach ?>
    <?php endif ?>

    <title><?=$title?></title>

  </head>
  <body onload="start()">

    <header id="header">
      <div id="header-mid">
        <div class="HeaderMidBox" id="header-mid-name">
          <h3>trace<span>ly</span></h3>
        </div>
        <div class="HeaderMidBox" id="header-mid-side">
          <div id="header-mid-side-content">

            <?php if (!AuthModel::isLoggedIn()): ?>
              <a href="<?= $this->link("")?>"><div id="headerlink-home" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Home</div></a>
              <a href="login"><div id="headerlink-login" class="HeaderMidSideContentBox aButton">Login</div></a>
              <a href="registrierung"><div id="headerlink-registrierung" class="HeaderMidSideContentBox aButtonInvert aButton">Registrieren</div></a>

            <?php else: ?>
              <?php if(InstitutionModel::isLoggedIn()): ?>
                <a href=""><div id="headerlink-ubersicht" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Übersicht</div></a>
                <a href=""><div id="headerlink-kontaktverfolgung" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Kontaktverfolgung</div></a>
                <a href=""><div id="headerlink-einstellungen" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Einstellungen</div></a>

              <?php elseif(UserModel::isLoggedIn()): ?>
                <a href=""><div id="headerlink-ubersicht" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Übersicht</div></a>
                <a href="<?php echo $this->url("user-update", "1");?>"><div id="headerlink-einstellungen" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Einstellungen</div></a>
              <?php endif?>

            <a href="login/"><div id="headerlink-logout" class="HeaderMidSideContentBox aButton">Logout <img src="static/media/backend/logout.svg"></div></a>
            <?php endif?>

        </div>
      </div>
    </div>
  </header>

    <?=$body?>

  <div id="aroundfooter">
    <?php $this->drawTrenner(1, "#DFF8FC");?>

    <footer id="footer" class="FilltextMidSektionBACKCALM">
      <div id="footer-mid" class="FilltextMidSektionContent">
        <div class="FooterContentBox" id="footer-mid-left">
          <div class="FooterItem"><a class="aText" href="<?= $this->link("")?>impressum">Impressum</a></div>
          <div class="FooterItem"><a class="aText" href="<?= $this->link("")?>kontakt">Kontakt</a></div>
        </div>
        <div class="FooterContentBox" id="footer-mid-right">
          <div class="FooterItem"><p>&copy;<?= date("Y")?> tracely</p></div>
        </div>

      </div>
    </footer>
  </div>

</body>
</html>
