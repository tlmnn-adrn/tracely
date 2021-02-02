<?php

    //Einstellungen
    require_once 'core/settings.php';

    //Fehlermeldungen
    require_once 'core/base/error/base.php';

    //Modell
    require_once 'core/base/model/model.php';
    require_once 'core/base/model/authModel.php';

    //Modelle
    require_once 'app/model/user.php';
    UserModel::__constructStatic();

    //Controller
    require_once 'core/base/controller/controller.php';

    //Mixins
    require_once 'core/base/controller/mixin/loginRequiredMixin.php';
    require_once 'core/base/controller/mixin/userPassesTestMixin.php';

    //Fields
    require_once 'core/base/model/fields/base.php';
    require_once 'core/base/model/fields/text.php';
    require_once 'core/base/model/fields/email.php';
    require_once 'core/base/model/fields/integer.php';
    require_once 'core/base/model/fields/password.php';
    require_once 'core/base/model/fields/plz.php';
    require_once 'core/base/model/fields/telefon.php';