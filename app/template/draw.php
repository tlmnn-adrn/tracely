<?php
function drawTrenner($ausrichtung=0, $farbe) {
  $heightcalc = 50;
  $height = $heightcalc."px";
  $AausrichtungM = array("scaleX(1) scaleY(1)","scaleX(-1) scaleY(1)", "scaleX(1) scaleY(-1)", "scaleX(-1) scaleY(-1)");
  $AausrichtungTopmargin = array(-1*$heightcalc - 10, -1*$heightcalc - 10, "0px", "0px");

  echo '
  <div class="Trenner" style="width:100%; height:'.$height.'; margin-top:'.$AausrichtungTopmargin[$ausrichtung].'px; border-bottom: solid 10px '.$farbe.'; overflow:hidden; position: absolute; transform:'.$AausrichtungM[$ausrichtung].';">
    <div style="
      width: 0px;
      height: 0px;
      -webkit-transform:rotate(360deg);
      border-style: solid;
      border-width: '.$height.' 0 0 50vw;
      border-color: transparent transparent transparent '.$farbe.';
      opacity: 0.6;
    "></div>
    <div style="
      width: 0px;
      height: 0px;
      -webkit-transform:rotate(360deg);
      border-style: solid;
      border-width: 0 0 30px 100vw;
      border-color: transparent  transparent '.$farbe.' transparent;
      margin-top: -30px;
      opacity: 0.8;
    "></div>
    <div style="
      width: 0px;
      height: 0px;
      -webkit-transform:rotate(360deg);
      border-style: solid;
      border-width: 20px 0 0 100vw;
      border-color: transparent transparent transparent '.$farbe.';
      margin-top: -20px;
      opacity: 1;
    "></div>
  </div>

  ';
}
