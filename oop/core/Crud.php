<?php

class Crud extends Database
{
    public function __construct()
    {
        parent::__construct();

        switch ($_GET["action"]){
            case 'read':
                $this->read();
                break;
            case 'update':
                $this->update();
                break;
            case 'delete':
                $this->delete();
                break;
            default:
                $this->create();
        }
    }

    public function create()
    {
        echo 'create>';

        if(!empty(trim($_POST["doctor"])) && !empty(trim($_POST["visit_date"]))){
            $sql = "INSERT INTO appointments ( doctor, visit_date, symptoms ) VALUES ( :doctor, :visit_date, :symptoms )";
            $STH = $this->DBH->prepare( $sql );
            $result = $STH->execute( array(":doctor"=>trim($_POST["doctor"]), ":visit_date" => trim($_POST["visit_date"]), ":symptoms" => trim($_POST["symptoms"])) );
            if(!empty($result)) $this->read();
        } elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result["doctor"]       = trim($_POST["doctor"])  ?:'';
            $result["visit_date"]   = trim($_POST["visit_date"]) ?:'';
            $result["symptoms"]     = trim($_POST["symptoms"])     ?:'';
            require_once  "views/form.php";
        } else {
            require_once  "views/form.php";
        }
    }

    public function read()
    {
        echo 'read>';

        $result = $this->DBH->query("SELECT * FROM appointments ORDER BY id DESC");
        require_once "views/list.php";
    }

    public function update()
    {
        echo 'update>';

        if(!empty(trim($_POST["doctor"])) && !empty(trim($_POST["visit_date"]))){
            $STH = $this->DBH->prepare("UPDATE appointments SET doctor=:doctor, visit_date=:visit_date, symptoms=:symptoms WHERE id=:id");
            $result = $STH->execute(array(':doctor' => trim($_POST["doctor"]), ':visit_date' => trim($_POST["visit_date"]), ':symptoms' => trim($_POST["symptoms"]), ':id' => trim($_GET["id"])));
            if(!empty($result)) $this->read();
        } elseif ($_SERVER["REQUEST_METHOD"]  == 'POST') {
            $result["doctor"]   = trim($_POST["doctor"])  ?:'';
            $result["visit_date"]  = trim($_POST["visit_date"]) ?:'';
            $result["symptoms"]      = trim($_POST["symptoms"])     ?:'';
            require_once  "views/form.php";
        } else {
            $STH = $this->DBH->prepare("SELECT * FROM appointments WHERE id=?");
            $STH->execute(array($_GET["id"]));
            $result = $STH->fetchAll();
            $result = $result[0];
            require_once  "views/form.php";
        }
    }

    public function delete()
    {
        echo 'delete>';
        $STH = $this->DBH->prepare("DELETE FROM appointments WHERE id=" . $_GET["id"]);
        $STH->execute();
        $this->read();
    }
}