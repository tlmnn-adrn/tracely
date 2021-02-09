<?php

    class TestController extends Controller
    {

        use DrawTrennerMixin;

        protected $template = 'home/home.php';

        protected function get($request) {

            $pdo = new PDO('mysql:host=localhost;dbname=tracely', 'root', '');

            $statement = $pdo->prepare('SELECT * FROM Benutzer WHERE id=?');
            $statement->execute([1]);

            $statement->setFetchMode(PDO::FETCH_INTO, new UserModel);

            $model = $statement->fetch();

            echo($model->vorname.'<br>');
            echo($model->nachname.'<br>');
            echo($model->id.'<br>');

            $model->setPassword('passwort', '12345678', '12345678', '654321');
            echo($model->passwort.'<br>');

            echo('errors: '.$model->hasErrors());

        //$this->render();
        }
        protected function post($request) {
        //$this->render();
        }

    }
