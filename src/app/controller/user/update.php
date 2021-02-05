<?php

  class UserUpdateController extends Controller
  {

    use LoginRequiredMixin, UserPassesTestMixin, DrawTrennerMixin;

    protected $template = 'user/update.php';


    protected function get($request, $id=0) {
      $object = UserModel::getById($id);

      $context = [
        "object" => $object,
      ];
      $this->render($context);
    }

    protected function post($request, $id=0) {

      $object = UserModel::getById($id);

      $object->setField("vorname", $request["vorname"]);
      $object->setField("nachname", $request["nachname"]);
      $object->setField("plz", $request["plz"]);
      $object->setField("email", $request["email"]);
      
      if(strlen($request['passwort'])>0){
        $object->setField("passwort", $request["passwort"], $request["passwortWiederholen"], $request["passwortAlt"]);
      }

      $success = $object->update();

      $context = [
        "object" => $object,
        "success" => $success,
      ];

      $this->render($context);
    }

    protected function testFunc($id){

      $user = UserModel::getUserObject();

      return $user->getField('id')==$id;

    }

  }
