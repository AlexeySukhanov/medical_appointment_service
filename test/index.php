<?php require_once("db.php");?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP PDO CRUD</title>
    <style>
    body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
    .tbl-qa{width: 100%;font-size:0.9em;background-color: #f5f5f5;}
    .tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
    .tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;vertical-align:top;}
    .button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
    </style>
</head>
<body>

<?php
$pdo_statement = $DBH->prepare("SELECT * FROM posts ORDER BY id DESC");
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
?>

<div style="text-align:right;margin:20px;"><a href="add.php" class="button_link"><img src="crud-icon/add.png" title="Add New Record" alt="Add New Record" style="vertical-align:bottom">Create</a></div>
<table class="tbl-qa">
    <thead>
        <tr>
            <th class="table-header" width="20%">Title</th>
            <th class="table-header" width="40%">Description</th>
            <th class="table-header" width="20%">Date</th>
            <th class="table-header" width="5%">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if(!empty($result)){
        foreach($result as $row){
    ?>
    <tr>
        <td><?php echo $row["post_title"]; ?></td>
        <td><?php echo $row["description"]; ?></td>
        <td><?php echo $row["post_at"]; ?></td>
        <td>
            <a class="ajax-action-links" href="edit.php?id=<?php echo $row["id"]; ?>">
                <img src="crud-icon/edit.png" alt="Edit" title="Edit">
            </a>
            <a class="ajax-action-links" href="delete.php?id=<?php echo $row["id"]; ?>">
                <img src="crud-icon/delete.png" alt="Delete" title="Delete">
            </a>
        </td>
    </tr>
    <?php
        }
    }
    ?>
    </tbody>
</table>

</body>
</html>
