<?php
$styles[] = 'style-mobile.css';
ob_start();
?>

    <header id="header" class="noselect">
      <div id="header-mid">
        <div class="HeaderMidBox" id="header-mid-name">
          <a href="<?= Url::find('index') ?>"><h3>trace<span>ly</span></h3></a>
        </div>
        <div class="HeaderMidBox" id="header-mid-side">
          <div id="header-mid-side-content">
            <img src="<?= Url::find('static', 'media/burgermenu.svg') ?>" onclick="show('burgermenu');">
          </div>
        </div>
      </div>
    </header>

    <div id="burgermenu">
      <div id="burgermenu-mid">
        <div id="burgermenu-hide">
          <img src="<?= Url::find('static', 'media/clear.svg') ?>" onclick="hide('burgermenu');">
        </div>
        <?php if (!AuthModel::isLoggedIn()): ?>
          <a href="<?= Url::find('index') ?>"><div id="headerlink-home" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Home</div></a>
          <a href="<?= Url::find('login') ?>"><div id="headerlink-login" class="HeaderMidSideContentBox aButton">Login</div></a>
          <a href="<?= Url::find('registrierung') ?>"><div id="headerlink-registrierung" class="HeaderMidSideContentBox aButtonInvert aButton">Registrieren</div></a>

        <?php else: ?>
          <?php if(InstitutionModel::isLoggedIn()): ?>
            <a href="<?= Url::find('backend-institution') ?>"><div id="headerlink-ubersicht" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Übersicht</div></a>
            <a href="<?= Url::find('backend-institution-kontaktverfolgung') ?>"><div id="headerlink-kontaktverfolgung" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Kontaktverfolgung</div></a>
            <a href="<?= Url::find('backend-institution-einstellungen') ?>"><div id="headerlink-einstellungen" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Einstellungen</div></a>

          <?php elseif(UserModel::isLoggedIn()): ?>
            <a href="<?= Url::find('backend-user') ?>"><div id="headerlink-ubersicht" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Übersicht</div></a>
            <a href="<?= Url::find('backend-user-einstellungen') ?>"><div id="headerlink-einstellungen" class="HeaderMidSideContentBox HeaderMidSideContentBoxList">Einstellungen</div></a>
          <?php endif?>

        <a href="<?= Url::find('logout') ?>"><div id="headerlink-logout" class="HeaderMidSideContentBox aButton">Logout <img src="<?= Url::find('static', 'media/backend/logout.svg') ?>"></div></a>
        <?php endif?>
      </div>
    </div>


  <?=$body?>

  <div id="aroundfooter">
    <?php $this->drawTrenner(1, "#DFF8FC");?>

    <footer id="footer" class="FilltextMidSektionBACKCALM">
      <div id="footer-mid" class="FilltextMidSektionContent">
        <div class="FooterContentBox" id="footer-mid-left">
          <div class="FooterItem"><a class="aText" href="<?= Url::find('impressum') ?>">Impressum</a></div>
          <div class="FooterItem"><a class="aText" href="<?= Url::find('kontakt') ?>">Kontakt</a></div>
        </div>
        <div class="FooterContentBox" id="footer-mid-right">
          <div class="FooterItem"><p>&copy;<?= date("Y")?> tracely</p></div>
        </div>

      </div>
    </footer>
  </div>


<?php $body = ob_get_clean(); ?>

<?php
  require($this->extend('htmlframe.php'));
?>
