<?php

  class QrcodeerstellenController extends Controller
  {
    use DrawTrennerMixin, InstitutionLoginRequiredMixin;

    protected $template = 'qrcode/erstellen.php';

    protected function get($request) {

        $object = InstitutionModel::getUserObject();
        $code = new QrcodeModel;

        $context = [
            "object" => $object,
            "code" => $code,
            "success"=> FALSE
        ];

        $this->render($context);
    }

    protected function post($request) {

      $object = InstitutionModel::getUserObject();
      $code = new QrcodeModel;

      $code->tischnummer = $request["tischnummer"];
      $code->sitzplätze = $request["sitzplätze"];
      $code->institutionId = $object->id;


      $generator = new RandomStringGenerator;
      $token = $generator->generate(64);
      $token .= $object->id;
      $mac = hash_hmac('sha256', $token, $_ENV['secret_key']);

      $code->code = $mac;

      $success = $code->create();

      if ($success) {
        header('Location: '.Url::find('qrcode-drucken', $code->code));
      }      

      $context = [
          "object" => $object,
          "code" => $code,
          "success" => $success,
      ];

      $this->render($context);

    }

  }
