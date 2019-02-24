<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сервис для самостоятельной записи на прием к врачу - Форма записи</title>
</head>
<body>
<div>
    <a href="index.php?action=read" class="button_link">Просмотр очереди</a>
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