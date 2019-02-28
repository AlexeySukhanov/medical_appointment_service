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
        $result = $this->validate_values();
        if($result["is_valid"]){
            $STH = $this->DBH->prepare( "INSERT INTO appointments ( doctor, visit_date, symptoms ) VALUES ( :doctor, :visit_date, :symptoms )" );
            $result = $STH->execute( array(":doctor"=>$result["doctor"], ":visit_date" => $result["visit_date"], ":symptoms" => $result["symptoms"]) );
            if(!empty($result)) header('Location: http://'.$_SERVER['HTTP_HOST'] ."?action=read");
        } else {
            include_once  "views/form.php";
        }
    }

    public function update()
    {
        $button_text = 'Сохранить изменения';
        $result = $this->validate_values();
        if($result["is_valid"]){
            $STH = $this->DBH->prepare("UPDATE appointments SET doctor=:doctor, visit_date=:visit_date, symptoms=:symptoms WHERE id=:id");
            $result = $STH->execute(array(':doctor' => $result["doctor"], ':visit_date' => $result["visit_date"], ':symptoms' => $result["symptoms"], ':id' => trim($_GET["id"])));
            if(!empty($result)) header('Location: http://'.$_SERVER['HTTP_HOST'] ."?action=read");
        } elseif ($_SERVER["REQUEST_METHOD"]  != 'POST') {
            $STH = $this->DBH->prepare("SELECT * FROM appointments WHERE id=?");
            $STH->execute(array($_GET["id"]));
            $result = $STH->fetchAll();
            $result = $result[0];
            include_once  "views/form.php";
        } else {
            include_once  "views/form.php";
        }
    }
    public function read()
    {
        $result = $this->DBH->query("SELECT * FROM appointments ORDER BY id DESC");
        include_once "views/list.php";
    }

    public function delete()
    {
        $STH = $this->DBH->prepare("DELETE FROM appointments WHERE id=?");
        $STH->execute(array($_GET["id"]));
        $this->read();
    }

    public function  validate_values(){
        $result["doctor"]       = trim(htmlspecialchars(($_POST["doctor"])));
        $result["visit_date"]   = trim(htmlspecialchars(($_POST["visit_date"])));
        $result["symptoms"]     = trim(htmlspecialchars(($_POST["symptoms"])));
        $result["is_valid"]     = !empty($result["doctor"]) && !empty($result["visit_date"]) && $this->validate_date($result["visit_date"]);
        return $result;
    }

    public function validate_date($date)
    {
        $received_date_timestamp = strtotime(date_format( date_create($date), 'd-m-Y' ));
        $max_date__timestamp = time() + 60*60*24*5;
        return $received_date_timestamp <= $max_date__timestamp;
    }
}