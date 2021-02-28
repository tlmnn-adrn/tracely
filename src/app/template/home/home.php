<?php
  $title = 'tracely | Home';
  $styles = ['home/style-home.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="home">
              <div id="home-willkommen" class="FilltextMidSektionContentBoxSPLIT FilltextMidSektionContentBoxRE">
                <h1>Willkommen bei<br>trace<span>ly</span></h1>
              </div>
              <div id="home-startimg" class="FilltextMidSektionContentBoxSPLIT FilltextMidSektionContentBoxRE">
                <img src="static/media/home/start.jpg" alt="">
              </div>
            </div>
          </div>
        </div>

        <?php $this->drawTrenner(1, "#DFF8FC");?>

        <div class="FilltextMidSektion FilltextMidSektionBACKCALM">
          <div class="FilltextMidSektionContent">
            <div id="about">
              <h1>Was ist trace<span>ly</span>?</h1>
              <p>
                Das Ziel von tracely ist eine unkomplizierte und zuverlässige Methode
                für eine Kontaktpersonennachverfolgung zu bilden, die sowohl für Institutionen als auch Privatpersonen bequem umzusetzen ist.
              </p>
              <p>
                Nach den rechtlichen Gegebenheiten ist die Zustellung sämtlicher potentieller Kontaktpersonen auf Anfrage durch ein Gesundheitsamt erforderlich.
                Diese Ermittlung gewährleistet eine Nachverfolgung von Infektionsketten aber auch eine Vorbeugung einer weiteren Verbreitung von COVID-19.
                Das Erfassen der Besucher einer Institution stellt sich dabei meist als aufwendig heraus und verstärkt die Belastung von Institutionen,
                wie Restaurants oder Einzelhandelsgeschäfte, in dieser Zeit.
              </p>
              <p>
                Tracely nimmt für Institutionen diese Hürde und ermöglicht ihnen eine strukturierte Oberfläche, um den rechtlichen Vorsätzen zu entsprechen.
                Die Funktionsweise basiert dabei auf der Bereitstellung von QR-Codes für eine Institution, die durch eine Privatperson gescannt werden.
                Dadurch wird es tracely ermöglicht eine sichere Dokumentation der Besucher einer Institution zu führen. Bei einer Anfrage kann der
                Institutionsbetreiber oder eine entsprechend verantwortliche Person sämtliche potenzielle Kontaktpersonen ermitteln und dem zuständigen Gesundheitsamt zu senden.
                Die Ermittlung läuft dabei vollautomatisch und bedarf nur eine Verteilung der QR-Codes und einem entsprechenden Hinweis zum Scan des QR-Codes.
              </p>
            </div>
          </div>
        </div>

        <?php $this->drawTrenner(2, "#DFF8FC");?>

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="usertypes">
              <div class="UserType">
                <h3>Für Institutionen</h3>
                <p>
                  Eine Institution erhält durch die Verwendung tracely eine übersichtliche Möglichkeit zur Gewährleistung einer zuverlässigen Kontaktpersonen&shy;nachverfolgung.
                  Die Anwendung von tracely stellt dabei der Institution eine unbegrenzte Anzahl an QR-Codes zur Verfügung, die an den erforderlichen Orten in den Räumlichkeiten verteilt werden müssen.
                  Der Institution wird eine strukturierte Verwaltung der QR-Codes und eine unkomplizierte Ermittlung sämtlicher potenzieller Kontaktpersonen ermöglicht.
                  Auf Anfrage lassen sich unkompliziert potenzielle Kontaktpersonen ermitteln.
                </p>
                <div class="UserTypeSektionLink">
                  <div class="UserTypeLink"><a class="aButton" href="<?= Url::find('login-institution') ?>">Anmelden</a></div>
                  <div class="UserTypeLink"><a class="aButton aButtonInvert" href="<?= Url::find('registrierung-institution') ?>">Registrieren</a></div>
                </div>
              </div>

              <div class="UserType">
                <h3>Für Privatpersonen</h3>
                <p>
                  Eine Privatperson erhält durch die Verwendung von tracely eine bequeme und sichere Methode zur Übermittlung seiner / ihrer Kontaktdaten. Die Anwendung von tracely gewährleistet
                  dabei einen Datenschutz konformen Umgang mit diesen Daten. Durch die Nutzung von tracely wird eine fehlerfreie Übermittlung der Kontaktdaten an ein zuständiges Gesundheitsamt ermöglicht.
                </p>
                <div class="UserTypeSektionLink">
                  <div class="UserTypeLink"><a class="aButton" href="<?= Url::find('login-user') ?>">Anmelden</a></div>
                  <div class="UserTypeLink"><a class="aButton aButtonInvert" href="<?= Url::find('registrierung-user') ?>">Registrieren</a></div>
                </div>

              </div>
            </div>
          </div>
        </div>

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <h3>Scans pro Tag</h3>
            <div id="zahlen">
              <?php
              $scans = array(10, 37, 21, 34, 30, 39, 46);
              $max = max($scans);
              $days = array('mo', 'di', 'mi', 'do', 'fr', 'sa', 'so');
              $height = 150;

              for ($i=0; $i < count($scans); $i++) {
                $diagram[$days[$i]] = $height - (($scans[$i] / $max) * $height);
              }
              ?>

              <svg id="test" width="100%" height="<?= $height ?>px">
                <polyline fill="none" stroke="#FF4749" stroke-width="2" points="
                100,<?= $diagram['mo'] ?> 200,<?= $diagram['di'] ?> 300,<?= $diagram['mi'] ?> 400,<?= $diagram['do'] ?> 500,<?= $diagram['fr'] ?> 600,<?= $diagram['sa'] ?> 700,<?= $diagram['so'] ?>
                ">
                Der Browser unterstützt kein SVG. Internet Explorer Nutzern ist nicht mehr zu helfen. Du Spaßt (Tipp: Rechtschreibreform) ._.
              </svg>

            </div>
          </div>
        </div>

      </div>
    </div>

<?php $body = ob_get_clean(); ?>


<?php
  require($this->extend('base.php'));
?>
