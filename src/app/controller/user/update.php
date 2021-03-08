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

      $object->vorname = $request["vorname"];
      $object->nachname = $request["nachname"];
      $object->plz = $request["plz"];
      $object->email = $request["email"];

      if(strlen($request['passwort'])>0){
        $object->setPassword("passwort", $request["passwort"], $request["passwortWiederholen"], $request["passwortAlt"]);
      }

      $success = $object->update();

      $context = [
        "object" => $object,
        "success" => $success,
      ];

      $this->render($context);
    }

    protected function testFunc($id=0){

      $user = UserModel::getUserObject();

      return $user->getField('id')==$id;

    }

  }
