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
        $button_text = 'Записаться на приём';
        if(!empty(trim($_POST["doctor"])) && !empty(trim($_POST["visit_date"])) && $this->date_is_correct($_POST["visit_date"])){
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
        $result = $this->DBH->query("SELECT * FROM appointments ORDER BY id DESC");
        require_once "views/list.php";
    }

    public function update()
    {
        $button_text = 'Сохранить изменения';
        if(!empty(trim($_POST["doctor"])) && !empty(trim($_POST["visit_date"])) && $this->date_is_correct($_POST["visit_date"])){
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
        $STH = $this->DBH->prepare("DELETE FROM appointments WHERE id=" . $_GET["id"]);
        $STH->execute();
        $this->read();
    }

    public function date_is_correct($date)
    {
        $received_date_timestamp = strtotime(date_format( date_create($date), 'd-m-Y' ));
        $max_date__timestamp = time() + 60*60*24*5;
        return $received_date_timestamp <= $max_date__timestamp;
    }
}