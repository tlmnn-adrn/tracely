<?php

    class RememberAuthModel extends Model{

        public static function getRememberMe($id, $token){

            $sql = new SelectQuery(static::$tableName, static::class);
            $sql->where('authId=?', $id);
            $sql->where('token=?', $token);

            return $sql->execute();

        }

    }
