<?php
if(!empty($_POST["add_record"])){
    require_once("db.php");
    $sql = "INSERT INTO posts ( post_title, description, post_at ) VALUES ( :post_title, :description, :post_at )";

    $pdo_statement = $DBH->prepare( $sql );


    $result = $pdo_statement->execute( array(":post_title"=>$_POST["post_title"], ":description" => $_POST["description"], ":post_at" => $_POST["post_at"]  ) );

//    var_dump($result);

    if(!empty($result)){
        header('location:index.php');
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
            <input type="text" name="post_title" class="demo-form-field" required >
        </div>
        <div class="demo-form-row">
            <label>Description:</label><br>
            <textarea name="description" class="demo-form-field" rows="5" required ></textarea>
        </div>
        <div class="demo-form-row">
            <label>Date:</label><br>
            <input type="date" name="post_at" class="demo-form-field" required>
        </div>
        <div class="demo-form-row">
            <input type="submit" name="add_record" class="demo-form-submit" value="Add">
        </div>
    </form>
</body>
</html>