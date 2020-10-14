<div style="min-height: 300px;border-bottom: #f0ad4e solid 1px">
    <div class="page-header">
        <h2>便利贴</h2>
    </div>
    <?php
    $events = array();
    $note_events = count($events);
    ?>

    <div class="dashboard-activity">
        <?php if ($note_events === 0): ?>
            <p class="alert"><?= t('还没有内容可显示.') ?></p>
        <?php else: ?>
        <div class="table-list">
            <?php  foreach ($events as $key=>$event): ?>
                <div class="table-list-row color-grey dashboard-activity-content" style="border-top: 1px solid #ccdcf3;margin-bottom:20px">
                    <div>
                        <p>this is a test</p>
                        <p>this is a test</p>
                        <p>this is a test</p>
                        <p>this is a test</p>
                    </div>
                </div>
             <?php endforeach ?>
        </div>
        <?php endif ?>
    </div>

</div>