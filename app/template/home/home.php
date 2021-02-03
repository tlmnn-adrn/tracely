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
              <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
              </p>
            </div>
          </div>
        </div>

        <?php $this->drawTrenner(3, "#DFF8FC");?>

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="usertypes">
              <div class="UserType">
                <h3>Für Institutionen</h3>
                <p>
                  mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
                </p>
                <div class="UserTypeLink"><a class="aButton aButtonInvert" href="registrierung">Registrieren</a></div>
              </div>

              <div class="UserType">
                <h3>Für Privatpersonen</h3>
                <p>
                  mod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
                </p>
                <div class="UserTypeLink"><a class="aButton aButtonInvert" href="registrierung">Registrieren</a></div>
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
