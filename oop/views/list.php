<?php require_once 'views/parts/header.php'; ?>

<div class="h4 separator-left margin-top-3 margin-bottom-2">Список заявок на запись к врачу</div>
    <hr>
    <table class="bordered hover unstriped text-center" style="font-size: smaller">
        <thead class="">
        <tr>
            <th class="text-center">Номер заявки</th>
            <th class="text-center">Дата приема</th>
            <th class="text-center">Специалист</th>
            <th class="text-center">Описание симптомов</th>
            <th class="text-center">Дата&nbsp;и&nbsp;время формирования&nbsp;заявки</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(!empty($result)):
            foreach($result as $row): ?>
                <tr>
                    <td class="align-self-middle"><b><?= $row["id"]; ?></b></td>
                    <td class="align-self-middle"><?= date_format( date_create($row["visit_date"]), 'd-m-Y' ); ?></td>
                    <td class="align-self-middle"><?= $row["doctor"]; ?></td>
                    <td class="align-self-middle"><?= $row["symptoms"]?:'<span class="subheader">-&nbsp;Описание отсутствует&nbsp;-</span>'; ?></td>
                    <td class="align-self-middle"><?= date_format( date_create($row["application_date"]), 'G:i:s d-m-Y' ) ?></td>
                    <td class="button-group tiny class=align-self-middle" style="margin:12px 0 6px;">
                        <a class="button success hollow" href="index.php?action=update&id=<?= $row["id"]; ?>">Редактировать</a>
                        <a class="button alert hollow" href="index.php?action=delete&id=<?= $row["id"]; ?>">Удалить</a>
                    </td>
                </tr>
            <?php
            endforeach;
        endif;
        ?>
        </tbody>
    </table>
    <hr>
    <a href="index.php?action=create" class="button expanded shadow">Записаться на приём</a>
<?php require_once 'views/parts/footer.php'; ?>