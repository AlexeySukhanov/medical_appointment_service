<?php

// TODO: Переделать база
// TODO: Заменить значения на необходимые
// TODO: Переделать в ООП
// TODO: Расставить комментарии
// TODO: Почистить классы и стили и прикрутить foundation

if($_GET["action"] == "edit"){
    require_once("db.php");

    //echo "форма на редактирование<br>";
    if(!empty(trim($_POST["post_title"])) && !empty(trim($_POST["description"])) && !empty(trim($_POST["post_at"]))){
        $pdo_statement = $pdo->prepare("UPDATE posts SET post_title=:post_title, description=:description, post_at=:post_at WHERE id=:id");
        $result = $pdo_statement->execute(array(':post_title' => $_POST["post_title"], ':description' => $_POST["description"], ':post_at' => $_POST["post_at"], ':id' => $_GET["id"] ));
        if($result) header("location:index.php");
    } elseif (!empty($_POST["post_title"]) || !empty($_POST["description"]) || !empty($_POST["post_at"])) {
        //echo 'Данные не были переданы полностью';
        $result["post_title"]   = trim($_POST["post_title"])  ?:'';
        $result["description"]  = trim($_POST["description"]) ?:'';
        $result["post_at"]      = trim($_POST["post_at"])     ?:'';
    } else {
        $pdo_statement = $pdo->prepare("SELECT * FROM posts WHERE id=?" );
        $pdo_statement->execute(array($_GET["id"]));
        $result = $pdo_statement->fetchAll();
        $result = $result[0];
    }
}

if($_GET["action"] == "create"){
    //echo "форма на создание<br>";
    if(!empty(trim($_POST["post_title"])) && !empty(trim($_POST["description"])) && !empty(trim($_POST["post_at"]))){
        require_once("db.php");
        $sql = "INSERT INTO posts ( post_title, description, post_at ) VALUES ( :post_title, :description, :post_at )";
        $pdo_statement = $pdo->prepare( $sql );
        $result = $pdo_statement->execute( array(":post_title"=>$_POST["post_title"], ":description" => $_POST["description"], ":post_at" => $_POST["post_at"]  ) );
        if(!empty($result)) header('Location:index.php');
    } else {
        //echo 'Данные не были переданы полностью';
        $result["post_title"]   = trim($_POST["post_title"])  ?:'';
        $result["description"]  = trim($_POST["description"]) ?:'';
        $result["post_at"]      = trim($_POST["post_at"])     ?:'';
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
    <title>PHP PDO CRUD - Add New Record</title>
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
        <a href="index.php" class="button_link">Back to List</a>
    </div>
    <form action="" method="post"  class="frm-add">
        <div class="demo-form-row">
            <label>Title:</label><br>
            <input type="text" name="post_title" class="demo-form-field" value="<?php echo $result["post_title"]; ?>" >
        </div>
        <div class="demo-form-row">
            <label>Description:</label><br>
            <textarea name="description" class="demo-form-field" rows="5" ><?php echo $result["description"]; ?></textarea>
        </div>
        <div class="demo-form-row">
            <label>Date:</label><br>
            <input type="date" name="post_at" class="demo-form-field" value="<?php echo $result["post_at"]; ?>" >
        </div>
        <div class="demo-form-row">
            <input type="submit" name="send_form" class="demo-form-submit" value="Add">
        </div>
    </form>
</body>
</html>