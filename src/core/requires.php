<?php

    //------------------------- Core -------------------------

    //Einstellungen
    require_once 'core/settings.php';

    //Modell
    require_once 'core/base/model/model.php';
    require_once 'core/base/model/authModel.php';

    //SQL
    require_once 'core/base/model/sql/base.php';
    require_once 'core/base/model/sql/select.php';

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
    require_once 'core/base/model/fields/id.php';
    require_once 'core/base/model/fields/foreignKey.php';

    //URL Patterns
    require_once 'core/base/urlPattern/url.php';
    require_once 'core/base/urlPattern/staticUrl.php';
    
    //------------------------- App -------------------------

    //Model
    require_once 'app/model/user.php';
    //UserModel::__constructStatic();

    require_once 'app/model/institution.php';
    //InstitutionModel::__constructStatic();

    require_once 'app/model/institutionsart.php';
    //InstitutionsartModel::__constructStatic();

    //Mixins
    require_once 'app/controller/mixin/institutionLoginRequiredMixin.php';
    require_once 'app/controller/mixin/userLoginRequiredMixin.php';
    require_once 'app/controller/mixin/drawTrennerMixin.php';




    require_once 'core/urls.php';
