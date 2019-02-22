<?php
require_once("db.php");
if(!empty($_POST["save_record"])){
    $pdo_statement = $pdo_conn->prepare("UPDATE posts SET post_title='" . $_POST["post_title"] . "', description='" . $_POST["description"] . "', post_at='" . $_POST["post_at"] . "' WHERE id=" . $_GET["id"]);
    $result = $pdo_statement->execute();
    if($result){
        header("location:index.php");
    }
}

$pdo_statement = $pdo_conn->prepare("SELECT * FROM posts WHERE id=" . $_GET["id"]);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP PDO CRUD - Edit Record</title>
    <style>
        body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
        .button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
        .frm-add {border: #c3bebe 1px solid; padding: 30px;}
        .demo-form-heading {margin-top:0px;font-weight: 500;}
        .demo-form-row{margin-top:20px;}
        .demo-form-field{width:300px;padding:10px;}
        .demo-form-submit{color:#FFF;background-color:#414444;padding:10px 50px;border:0;cursor:pointer;}
    </style>
</head>
<body>

<div style="margin:20px 0;text-align:right;"><a href="index.php" class="button_link">Back to List</a></div>
<div class="frm-add">
    <h1 class="demo-form-heading">Edit Record</h1>
    <form name="frmAdd" action="" method="post">
        <div class="demo-form-row">
            <label>Title:</label><br>
            <input type="text" name="post_title" class="demo-form-field" value="<?php echo $result[0]["post_title"]; ?>" required>
        </div>
        <div class="demo-form-row">
            <label>Description:</label><br>
            <textarea name="description" class="demo-form-field" rows="5" required><?php echo $result[0]["description"]; ?></textarea>
        </div>
        <div class="demo-form-row">
            <label>Date:</label><br>
            <input type="date" name="post_at" class="demo-form-field" value="<?php echo $result[0]["post_at"]; ?>">
        </div>
        <div class="demo-form-row">
            <input name="save_record" type="submit" value="Save" class="demo-form-submit">
        </div>
    </form>
</div>

</body>
</html>

