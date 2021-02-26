<?php
  $title = 'tracely | Impressum';
  $styles = ['impressum/style-impressum.css'];

  ob_start();
?>

    <div id="filltext">
      <div id="filltextmid">

        <div class="FilltextMidSektion">
          <div class="FilltextMidSektionContent">
            <div id="impressum">
              <h1>Impressum</h1>
              <h5 style="color: red">Die folgenden Angaben sind der Vollständigkeit halber und nicht auf die Geschäftsform und den Aufgabenbereich dieser Webseite angepasst.</h5>
              <br>
              <h3>Angaben gemäß § 5 TMG</h3>
              <p>
                tracely Ltd.<br>
                Quohrener Str. 12<br>
                01324 Dresden<br>
                Germany<br>
              </p>
              <h3>Kontakt</h3>
              <p>
                E-Mail: kontakt@tracely.de<br>
              </p>
              <h3>Haftung für Inhalte</h3>
              <p>
                Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den
                allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht
                verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu
                forschen, die auf eine rechtswidrige Tätigkeit hinweisen.<br>
                Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen
                Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der
                Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden
                Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
              </p>
              <h3>Haftung für Links</h3>
              <p>
                Unser Angebot enthält Links zu externen Websites Dritter, auf deren Inhalte wir keinen Einfluss haben.
                Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der
                verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten
                Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte
                waren zum Zeitpunkt der Verlinkung nicht erkennbar.<br>
                Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer
                Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links
                umgehend entfernen.
              </p>
              <h3>Urheberrecht</h3>
              <p>
                Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen
                Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der
                Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers.
                Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet.<br>
                Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter
                beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine
                Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei
                Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.
              </p>
              <br>
              <h6>Quelle</h6>
              <p>https://www.e-recht24.de/impressum-generator.html</p>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php $body = ob_get_clean(); ?>


<?php
  require($this->extend('base.php'));
?>
