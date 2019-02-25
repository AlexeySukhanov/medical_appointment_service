<?php require_once 'views/parts/header.php'; ?>

<div class="h4 separator-left margin-top-3 margin-bottom-2">Форма записи на приём</div>
<hr>
<form action="<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" method="post">
    <fieldset>
            <div class="grid-x grid-margin-x">
                <div class="large-6 cell">
                    <label for="doctor">Выбор доктора</label>
                    <select id="doctor" name="doctor" required>
                        <option value=""></option>
                        <option <?= $result["doctor"] == 'Терапевт'?'selected ':''; ?>value="Терапевт">Терапевт</option>
                        <option <?= $result["doctor"] == 'Хирург'?'selected ':''; ?>value="Хирург">Хирург</option>
                    </select>
                </div>
                <div class="large-6 cell">
                    <label for="date">Выбор времени посещения доктора (пять&nbsp;ближайщих&nbsp;дат)</label>
                    <input id="date" type="date" name="visit_date" value="<?= $result["visit_date"]; ?>" min="<?= date('Y-m-d') ?>" max="<?= date('Y-m-d', strtotime('+4 day')); ?>" required>
                </div>
            </div>
            <div class="grid-x grid-margin-x">
                <div class="large-12 cell">
                    <label for="symptoms">Описание симптомов</label>
                    <textarea id="symptoms" name="symptoms" rows="4" style="resize: none;"><?= $result["symptoms"]; ?></textarea>
                    <input class="button float-right small success hollow" type="submit" name="send_form" value="<?= $button_text; ?>">
                </div>

            </div>
    </fieldset>
</form>
<hr>
<a href="index.php?action=read" class="button expanded shadow">Просмотр очереди заявок</a>

<?php require_once 'views/parts/footer.php'; ?>