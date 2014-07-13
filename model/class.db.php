<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 5/16/14
 * Time: 3:28 AM
 */

class db
{
    private $_linkDB;

    private function connect()
    {
        try {
            $connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_DATABASE ,DB_USER,DB_PASSWORD);
            /*$connection->exec('SET character_set_database=UTF8');
            $connection->exec('SET character_set_client=UTF8');
            $connection->exec('SET character_set_connection=UTF8');
            $connection->exec('SET character_set_results=UTF8');
            $connection->exec('SET character_set_server=UTF8');
            $connection->exec('SET names UTF8');*/
        }catch (PDOException $e) {
            return false;
        }

        return $connection;
    }

    public function __construct()
    {
        $this->_linkDB = $this->connect();
    }

    public function select($tblName, $fields, $conditions = "",$limit = "")
    {
        $output = array();
        if($this->_linkDB) {
            // Query Base
            $QUERY = "SELECT " . $fields . " FROM " . $tblName . " $conditions $limit";
            //echo $QUERY;die();
            $sth = $this->_linkDB->prepare($QUERY);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_OBJ);

            if ($result) {
                array_push($output,$result);
                array_push($output,count($result));
                return $output;
            } else {
                return 0;
            }
        }

        return false;
    }




    //Insert Functionality

    public function insert ($tblName,$fields,$values,$conditions = "") {
        $result = array();
        if($this->_linkDB) {
            // Query Base
            $QUERY = "INSERT INTO " . $tblName . " (" . $fields . ") " . " VALUES (".$values.")".$conditions.";";
            //echo $QUERY;die();
            $sth = $this->_linkDB->prepare($QUERY);
            $result =  $sth->execute();

            if ($result) {
                return 1;
            }else{
                return 0;
            }
        }

        return false;
    }

    public function bulkInsert ($tblName,$fields,$values,$conditions = "") {
        $result = array();
        if($this->_linkDB) {
            // Query Base
            $QUERY = "INSERT INTO " . $tblName . " (" . $fields . ") " . " VALUES " .  $values . " " . $conditions;
            //echo $QUERY;die();
            $sth = $this->_linkDB->prepare($QUERY);
            $result =  $sth->execute();

            //if ($result) return $this->_linkDB->lastInsertId();
            if ($result) return 1;
        }

        return false;
    }

    //Update Query
    public function update ($tblName,$updates,$conditions) {
        if ($this->_linkDB) {
            $QUERY = "UPDATE $tblName SET $updates $conditions"."";
            //echo $QUERY;die();
            $stm = $this->_linkDB->prepare($QUERY);
            $result = $stm->execute();
            if ($result) return true;
        }

        return false;
    }

    //Delete Query
    public function delete ($tblName,$conditions) {
        if ($this->_linkDB) {
            $QUERY = "DELETE FROM $tblName WHERE $conditions"."";
            //echo $QUERY;die();
            $stm = $this->_linkDB->prepare($QUERY);
            $result = $stm->execute();
            if ($result) return true;
        }

        return false;
    }

}