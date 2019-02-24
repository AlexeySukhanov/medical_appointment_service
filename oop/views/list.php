<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сервис для самостоятельной записи на прием к врачу - Список записей</title>
</head>
<body>
<div><a href="index.php?action=create" class="button_link">Записаться на прием</a></div>
<table class="tbl-qa">
    <thead>
    <tr>
        <th class="table-header">Номер заявки</th>
        <th class="table-header">Дата приема</th>
        <th class="table-header">Специалист</th>
        <th class="table-header">Описание симптомов</th>
        <th class="table-header">Дата и время формирования заявки</th>
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
                    <a href="index.php?action=update&id=<?= $row["id"]; ?>">Редактировать</a>/
                    <a href="index.php?action=delete&id=<?= $row["id"]; ?>">Удалить</a>
                </td>
            </tr>
        <?php
        endforeach;
    endif;
    ?>
    </tbody>
</table>
</body>
</html>
</html>