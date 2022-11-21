<?php
require('config.php');
class DataProvider{
    protected function connect(){
        try{
        return new PDO(CONFIG['db'],CONFIG['db_user'],CONFIG['db_passowrd']); 
        }catch(PDOException $e){
            return null;
        }
    }
}