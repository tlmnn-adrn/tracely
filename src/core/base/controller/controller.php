<?php

    abstract class Controller{

        protected $template;

        protected $templatePath = "app/template/";
        protected $templateMobilePath = "app/templateMobile/";

        abstract protected function get($request);
        abstract protected function post($request);

        //Beim Aufruf wird unterschieden, ob es sich um einen GET oder einen POST request handelt
        //Es wird dann die entsprechende Funktion der Unterklasse aufgerufen
        public function __construct($arguments){

            //Laden aller verwendeten Mixins
            //Aufrufen der Init Funktionen des Mixins
            //Init Funktion der Mixins 'Mixin' heißt 'mixinInit'
            foreach(class_uses($this) as $mixin){
                $functionName = lcfirst($mixin).'Init';

                if(method_exists($this, $functionName)){
                    $this->$functionName($arguments);
                }

            }


            if($_SERVER['REQUEST_METHOD'] === 'POST'){

                if(!isset($_POST['csrfToken']) || !$_SESSION['csrfToken'] || $_POST['csrfToken'] != $_SESSION['csrfToken']){
                    throw new SecurityError('Die csrf Authentifikation ist fehlgeschlagen.');
                }

                $this->post($_POST, ...$arguments);
            }else{
                $this->get($_GET, ...$arguments);
            }
        }


        //Rendern eines Templates
        //$context sind die Variablen, die in das Template eingefügt werden
        protected function render($context=[]){
            
            $path = $this->extend($this->template);

            extract($context);
            require($path);

        }

        //Überprüfung, ob von einem Handy aufgerufen
        //Quelle: https://www.geeksforgeeks.org/how-to-detect-a-mobile-device-using-php/
        protected function isMobile(){
            return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i" , $_SERVER["HTTP_USER_AGENT"]);
        }

        protected function extend($template){

            if($this->isMobile() && file_exists('app/templateMobile/'.$template)){
                $path = $this->templateMobilePath.$template;
            }else{
                $path = $this->templatePath.$template;
            }

            return $path;

        }

        protected function generatePdf($context=[], $fileName='pdf', $author='', $title='', $subject=''){

            //Quelle: https://www.php-einfach.de/experte/php-codebeispiele/pdf-per-php-erstellen-pdf-rechnung/

            ob_start();

            $this->render($context);

            $html = ob_get_clean();

            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Dokumenteninformationen
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor($author);
            $pdf->SetTitle($title);
            $pdf->SetSubject($subject);


            // Header und Footer Informationen
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // Auswahl des Font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // Auswahl der MArgins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // Automatisches Autobreak der Seiten
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // Image Scale
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // Schriftart
            $pdf->SetFont('times', '', 12);

            // Neue Seite
            $pdf->AddPage();

            // Fügt den HTML Code in das PDF Dokument ein
            $pdf->writeHTML($html, true, false, true, false, '');

            //Ausgabe der PDF

            //Variante 1: PDF direkt an den Benutzer senden:
            $pdf->Output($fileName, 'I');

        }

        protected function csrfToken(){

            if(!isset($_SESSION['csrfToken'])){

                $generator = new RandomStringGenerator;
                $_SESSION['csrfToken'] = $generator->generate(64);

            }

            return '<input type="hidden" name="csrfToken" value="'.$_SESSION['csrfToken'].'">';

        }

    }
