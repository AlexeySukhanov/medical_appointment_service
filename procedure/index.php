<?php
require_once("db.php");
$result = $pdo->query("SELECT * FROM appointments ORDER BY id DESC");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сервис для самостоятельной записи на прием к врачу - Список записей</title>
    <style>
    body{width:615px;font-family:arial;letter-spacing:1px;line-height:20px;}
    .tbl-qa{width: 100%;font-size:0.9em;background-color: #f5f5f5;}
    .tbl-qa th.table-header {padding: 5px;text-align: left;padding:10px;}
    .tbl-qa .table-row td {padding:10px;background-color: #FDFDFD;vertical-align:top;}
    .button_link {color:#FFF;text-decoration:none; background-color:#428a8e;padding:10px;}
    </style>
</head>
<body>

<div style="text-align:right;margin:20px;"><a href="form.php?action=create" class="button_link">Записаться на прием</a></div>
<table class="tbl-qa">
    <thead>
        <tr>
            <th class="table-header" width="10%">Номер заявки</th>
            <th class="table-header" width="10%">Дата приема</th>
            <th class="table-header" width="20%">Специалист</th>
            <th class="table-header" width="40%">Описание симптомов</th>
            <th class="table-header" width="20%">Дата и время формирования заявки</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if(!empty($result)):
        foreach($result as $row): ?>
        <tr>
            <td><?= $row["id"]; ?></td>
            <td><?= date_format( date_create($row["visit_date"]), 'd-m-Y' ) ?></td>
            <td><?= $row["doctor"]; ?></td>
            <td><?= $row["symptoms"]?:'Описание симптомов отсутствует'; ?></td>
            <td><?= date_format( date_create($row["application_date"]), 'G:i:s d-m-Y' ) ?></td>
            <td>
                <a class="ajax-action-links" href="form.php?action=edit&id=<?= $row["id"]; ?>">Редактировать</a>/
                <a class="ajax-action-links" href="delete.php?id=<?= $row["id"]; ?>">Удалить</a>
            </td>
        </tr>
    <?php
        endforeach;
    endif; ?>
    </tbody>
</table>

</body>
</html>
