<?php
#Startseiten Controller
  class HomeController extends Controller
  {
    //Benutze das DrawTrenner Mixin
    use DrawTrennerMixin;

    //weißt das zu benutzende Template zu
    protected $template = 'home/home.php';

    //vearbeitet die get Nachfrage
    protected function get($request) {

      //Variablen die dem Template zur Verfügung stehen sollen
      $context = [];
      //stellt Template dar
      $this->render($context);
    }

    //vearbeitet die post Nachfrage
    protected function post($request) {
      $this->render();
    }

  }
