<?php

    //Grundlage für die Modelle zum merken der Anmeldung
    abstract class RememberAuthModel extends Model{

        //Ausgabe des Datensatzes mit dem angegebenen Token und der angegebenen Id
        public static function getRememberMe($id, $token){

            $sql = new SelectQuery(static::$tableName, static::class);
            $sql->where('authId=?', $id);
            $sql->where('token=?', $token);

            return $sql->execute();

        }

    }
