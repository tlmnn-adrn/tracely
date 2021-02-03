<?php

    //------------------------- Core -------------------------

    //Einstellungen
    require_once 'core/settings.php';

    //Modell
    require_once 'core/base/model/model.php';
    require_once 'core/base/model/authModel.php';

    //Controller
    require_once 'core/base/controller/controller.php';

    //Fehlermeldungen
    require_once 'core/base/error/base.php';

    //Mixins
    require_once 'core/base/controller/mixin/loginRequiredMixin.php';
    require_once 'core/base/controller/mixin/userPassesTestMixin.php';
    require_once 'core/base/controller/mixin/loginRedirectMixin.php';

    //Fields
    require_once 'core/base/model/fields/base.php';
    require_once 'core/base/model/fields/text.php';
    require_once 'core/base/model/fields/email.php';
    require_once 'core/base/model/fields/integer.php';
    require_once 'core/base/model/fields/password.php';
    require_once 'core/base/model/fields/plz.php';
    require_once 'core/base/model/fields/telefon.php';


    
    //------------------------- App -------------------------

    //Model
    require_once 'app/model/user.php';
    UserModel::__constructStatic();

    require_once 'app/model/institution.php';
    UserModel::__constructStatic();

    //Mixins
    require_once 'app/controller/mixin/institutionLoginRequiredMixin.php';
    require_once 'app/controller/mixin/userLoginRequiredMixin.php';
    require_once 'app/controller/mixin/drawTrennerMixin.php';
