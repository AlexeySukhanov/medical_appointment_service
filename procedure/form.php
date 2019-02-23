<?php

// TODO: Переделать база +
// TODO: Заменить значения на необходимые +
// TODO: Переделать в ООП
// TODO: Расставить комментарии
// TODO: Почистить классы и стили и прикрутить foundation
// TODO: Уточнить номер билета и фомат вывода даты

if($_GET["action"] == "edit"){
    require_once("db.php");
    if(!empty(trim($_POST["doctor"])) && !empty(trim($_POST["visit_date"]))){
        $pdo_statement = $pdo->prepare("UPDATE appointments SET doctor=:doctor, visit_date=:visit_date, symptoms=:symptoms WHERE id=:id");
        $result = $pdo_statement->execute(array(':doctor' => trim($_POST["doctor"]), ':visit_date' => trim($_POST["visit_date"]), ':symptoms' => trim($_POST["symptoms"]), ':id' => trim($_GET["id"])));
        if($result) header("location:index.php");
    } elseif ($_SERVER["REQUEST_METHOD"]  == 'POST') {
        $result["doctor"]   = trim($_POST["doctor"])  ?:'';
        $result["visit_date"]  = trim($_POST["visit_date"]) ?:'';
        $result["symptoms"]      = trim($_POST["symptoms"])     ?:'';
    } else {
        $pdo_statement = $pdo->prepare("SELECT * FROM appointments WHERE id=?");
        $pdo_statement->execute(array($_GET["id"]));
        $result = $pdo_statement->fetchAll();
        $result = $result[0];
    }
}

if($_GET["action"] == "create"){
    if(!empty(trim($_POST["doctor"])) && !empty(trim($_POST["visit_date"]))){
        require_once("db.php");
        $sql = "INSERT INTO appointments ( doctor, visit_date, symptoms ) VALUES ( :doctor, :visit_date, :symptoms )";
        $pdo_statement = $pdo->prepare( $sql );
        $result = $pdo_statement->execute( array(":doctor"=>trim($_POST["doctor"]), ":visit_date" => trim($_POST["visit_date"]), ":symptoms" => trim($_POST["symptoms"])) );
        if(!empty($result)) header('Location:index.php');
    } else {
        $result["doctor"]       = trim($_POST["doctor"])  ?:'';
        $result["visit_date"]   = trim($_POST["visit_date"]) ?:'';
        $result["symptoms"]     = trim($_POST["symptoms"])     ?:'';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сервис для самостоятельной записи на прием к врачу - Форма записи</title>
    <style>
        body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
        .button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
        .frm-add {border: #c3bebe 1px solid;
            padding: 30px;}
        .demo-form-heading {margin-top:0px;font-weight: 500;}
        .demo-form-row{margin-top:20px;}
        .demo-form-field{width:300px;padding:10px;}
        .demo-form-submit{color:#FFF;background-color:#414444;padding:10px 50px;border:0;cursor:pointer;}
    </style>
</head>
<body>
<div style="margin:20px;text-align:right;">
    <a href="index.php" class="button_link">Перейти к списку записей</a>
</div>
<form action="" method="post"  class="frm-add">
    <fieldset>
        <legend>Форма записи на приём</legend>
        <div class="form-item">
            <label for="doctor">Выбор доктора:</label><br>
            <select id="doctor" name="doctor" required>
                <option <?= $result["doctor"] == 'Терапевт'?'selected ':''; ?>value="Терапевт">Терапевт</option>
                <option <?= $result["doctor"] == 'Хирург'?'selected ':''; ?>value="Хирург">Хирург</option>
            </select>
        </div>
        <div class="form-item">
            <label for="date">Выбор времени посещения доктора:</label><br>
            <input id="date" type="date" name="visit_date" value="<?= $result["visit_date"]; ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+4 day')); ?>" required>
        </div>
        <div class="form-item">
            <label for="symptoms">Описание симптомов:</label><br>
            <textarea id="symptoms" name="symptoms" id="" cols="30" rows="10"><?= $result["symptoms"]; ?></textarea>
        </div>
        <div class="form-item">
            <input type="submit" name="send_form" value="Записаться на прием">
        </div>
    </fieldset>
</form>
</body>
</html>