<?php

//Laden der Klassen, damit diese verwendet werden können

  #allgemeine Seiten
    require_once "app/controller/home/home.php";
    require_once "app/controller/impressum/impressum.php";
    require_once "app/controller/kontakt/kontakt.php";


  #Login und Registrierung
    require_once "app/controller/login/login.php";
    require_once "app/controller/user/login.php";
    require_once "app/controller/institution/login.php";

    require_once "app/controller/registration/registration.php";
    require_once "app/controller/user/registration.php";
    require_once "app/controller/institution/registration.php";


  #BackendController
    require_once "app/controller/backend/backend.php";
    require_once "app/controller/backend/logout.php";
    //User
    require_once "app/controller/user/backendubersicht.php";
    require_once "app/controller/user/backendeinstellungen.php";
    //Institution
    require_once "app/controller/institution/backendubersicht.php";
    require_once "app/controller/institution/getHistorySvg.php";
    require_once "app/controller/institution/backendkontaktverfolgung.php";
    require_once "app/controller/institution/backendkontaktpersonen.php";
    require_once "app/controller/institution/backendeinstellungen.php";

  #Qr-Code
    require_once "app/controller/qrcode/erstellen.php";
    require_once "app/controller/qrcode/löschen.php";
    require_once "app/controller/qrcode/drucken.php";

  #Scan
    require_once "app/controller/scan/erstellen.php";
    require_once "app/controller/scan/scan.php";



//Definieren der URLs
//Die tracely.de/ URL wird als index.php definiert
//Ist in der URL PLatz für einen Parameter, wird dies mit <*> gekennzeichnet, wobei * der Name des Parameters ist

  #allgemeine Seiten
    Url::add('index', '', 'HomeController');
    Url::add('impressum', 'impressum/', 'ImpressumController');
    Url::add('kontakt', 'kontakt/', 'KontaktController');

  #Login und Registrierung
    Url::add('login', 'login/', 'LoginController');
    Url::add('login-user', 'login/user/', 'UserLoginController');
    Url::add('login-institution', 'login/institution/', 'InstitutionLoginController');

    Url::add('registrierung', 'registrierung/', 'RegistrationController');
    Url::add('registrierung-user', 'registrierung/user/', 'UserRegistrationController');
    Url::add('registrierung-institution', 'registrierung/institution/', 'InstitutionRegistrationController');

  #backend
    Url::add('backend', 'backend/', 'BackendController');
    Url::add('logout', 'logout/', 'LogoutController');
    //User
    Url::add('backend-user', 'backend/user/', 'UserBackendUbersichtController');
    Url::add('backend-user-einstellungen', 'backend/user/einstellungen/', 'UserBackendEinstellungenController');
    //Institution
    Url::add('backend-institution', 'backend/institution/', 'InstitutionBackendUbersichtController');
    Url::add('backend-institution-gethistorysvg', 'backend/institution/gethistorysvg/<time>', 'GetHistorySvgController');
    Url::add('backend-institution-kontaktverfolgung', 'backend/institution/kontaktverfolgung/', 'InstitutionBackendKontaktverfolgungController');
    Url::add('backend-institution-kontaktpersonen', 'backend/institution/kontaktverfolgung/kontaktpersonen/', 'InstitutionBackendKontaktpersonenController');
    Url::add('backend-institution-einstellungen', 'backend/institution/einstellungen/', 'InstitutionBackendEinstellungenController');

  #Qr-code
    Url::add('qrcode-erstellen', 'qrcode/erstellen/', 'QrcodeerstellenController');
    Url::add('qrcode-löschen', 'qrcode/loeschen/<id>', 'QrcodelöschenController');
    Url::add('qrcode-drucken', 'qrcode/drucken/<code>', 'QrcodedruckenController');


  #Scan
    Url::add('scan-erstellen', 'scan/erstellen/<code>', 'ScanErstellenController');
    Url::add('scan-online', 'scan/', 'ScanController');


  #Static Urls
    StaticUrl::add('static', 'static/');