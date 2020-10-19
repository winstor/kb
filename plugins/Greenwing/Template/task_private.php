<div class="
        task-board
        <?= $task['is_draggable'] ? 'draggable-item ' : '' ?>
        <?= $task['is_active'] == 1 ? 'task-board-status-open '.($task['date_modification'] > (time() - $board_highlight_period) ? 'task-board-recent' : '') : 'task-board-status-closed' ?>
        color-<?= $task['color_id'] ?>"
     data-task-id="<?= $task['id'] ?>"
     data-column-id="<?= $task['column_id'] ?>"
     data-swimlane-id="<?= $task['swimlane_id'] ?>"
     data-position="<?= $task['position'] ?>"
     data-owner-id="<?= $task['owner_id'] ?>"
     data-category-id="<?= $task['category_id'] ?>"
     data-due-date="<?= $task['date_due'] ?>"
     data-task-url="">

    <div class="task-board-sort-handle" style="display: none;"><i class="fa fa-arrows-alt"></i></div>

    <?php if ($this->board->isCollapsed($task['project_id'])): ?>
        <div class="task-board-collapsed">
            <div class="task-board-saving-icon" style="display: none;"><i class="fa fa-spinner fa-pulse"></i></div>
            <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
                <?= $this->render('task/dropdown', array('task' => $task, 'redirect' => 'board')) ?>
                <?php if ($this->projectRole->canUpdateTask($task)): ?>
                    <?= $this->modal->large('edit', '', 'TaskModificationController', 'edit', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
                <?php endif ?>
            <?php else: ?>
                <strong><?= '#'.$task['id'] ?></strong>
            <?php endif ?>

            <?php if (! empty($task['assignee_username'])): ?>
                <span title="<?= $this->text->e($task['assignee_name'] ?: $task['assignee_username']) ?>">
                    <?= $this->text->e($this->user->getInitials($task['assignee_name'] ?: $task['assignee_username'])) ?>
                </span> -
            <?php endif ?>
            <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']), false, '', $this->text->e($task['title'])) ?>
        </div>
    <?php else: ?>
        <div class="task-board-expanded">
            <div class="task-board-saving-icon" style="display: none;"><i class="fa fa-spinner fa-pulse fa-2x"></i></div>
            <div class="task-board-header">
                <?php if ($this->user->hasProjectAccess('TaskModificationController', 'edit', $task['project_id'])): ?>
                    <?= $this->render('task/dropdown', array('task' => $task, 'redirect' => 'board')) ?>

                    <?php if ($this->projectRole->canUpdateTask($task)): ?>
                        <a  title="编辑" href="/?controller=TaskModificationController&action=edit&task_id=<?= $task['id'] ?>&project_id=<?= $task['project_id'] ?>" class="js-modal-large">
                            <i class="fa fa-edit fa-fw js-modal-large" aria-hidden="true"></i>
                        </a>
                    <!--
                        <?= $this->modal->large('edit', '', 'TaskModificationController', 'edit', array('task_id' => $task['id'], 'project_id' => $task['project_id'])) ?>
                        -->
                        <a  title="添加子任务" href="/?controller=SubtaskController&action=create&task_id=<?= $task['id'] ?>&project_id=<?= $task['project_id'] ?>" class="js-modal-large">
                            <i class="fa fa-plus-square-o fa-fw js-modal-large" aria-hidden="true"></i>
                        </a>
                        <a  title="添加内部关联" href="/?controller=TaskInternalLinkController&action=create&task_id=<?= $task['id'] ?>&project_id=<?= $task['project_id'] ?>" class="js-modal-large">
                            <i class="fa fa-code-fork fa-fw js-modal-large" aria-hidden="true"></i>
                        </a>
                        <a  title="添加评论" href="/?controller=CommentListController&action=show&task_id=<?= $task['id'] ?>&project_id=<?= $task['project_id'] ?>" class="js-modal-large">
                            <i class="fa fa-commenting-o fa-fw js-modal-large" aria-hidden="true"></i>
                        </a>
                        <a  title="附加文档" href="/?controller=TaskFileController&action=create&task_id=<?= $task['id'] ?>&project_id=<?= $task['project_id'] ?>" class="js-modal-large">
                            <i class="fa fa-upload fa-fw js-modal-large" aria-hidden="true"></i>
                        </a>
                        <a  title="复制到另一项目" href="/?controller=TaskDuplicationController&action=copy&task_id=<?= $task['id'] ?>&project_id=<?= $task['project_id'] ?>" class="js-modal-large">
                            <i class="fa fa-share-square-o fa-fw js-modal-large" aria-hidden="true"></i>
                        </a>
                    <?php endif ?>
                    <?php else: ?>
                        <strong><?= '#'.$task['id'] ?></strong>
                    <?php endif ?>

            </div>

            <?= $this->hook->render('template:board:private:task:before-title', array('task' => $task)) ?>

            <div class="task-board-title">
                <?php if (! empty($task['description'])): ?>
                <span class="tooltip" data-href="/?controller=BoardTooltipController&action=description&task_id=<?= $task['id'] ?>&project_id=<?= $task['project_id'] ?>">
                    <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']),false,'','',true) ?>
                </span>
                <?php else: ?>
                    <?= $this->url->link($this->text->e($task['title']), 'TaskViewController', 'show', array('task_id' => $task['id'], 'project_id' => $task['project_id']),false,'','',true) ?>
                <?php endif ?>
            </div>
            <?= $this->hook->render('template:board:private:task:after-title', array('task' => $task)) ?>

            <?php if (! empty($task['category_id'])): ?>
            <div class="task-board-category-container task-board-category-container-color">
                <h4><?= t('Category'); ?></h4>
                <span class="task-board-category category-<?= $this->text->e($task['category_name']) ?> <?= $task['category_color_id'] ? "color-{$task['category_color_id']}" : '' ?>">
                    <?php if ($not_editable): ?>
                        <?= $this->text->e($task['category_name']) ?>
                    <?php else: ?>
                        <?= $this->url->link(
                            $this->text->e($task['category_name']),
                            'TaskModificationController',
                            'edit',
                            array('task_id' => $task['id'], 'project_id' => $task['project_id']),
                            false,
                            'js-modal-medium' . (! empty($task['category_description']) ? ' tooltip' : ''),
                            t('Change category')
                        ) ?>
                        <?php if (! empty($task['category_description'])): ?>
                            <?= $this->app->tooltipMarkdown($task['category_description']) ?>
                        <?php endif ?>
                    <?php endif ?>
                </span>
            </div>
            <?php endif ?>

            <?php if (! empty($task['tags'])): ?>
                <div class="task-tags">
                    <!-- <h4><?= t('Tags'); ?></h4> -->
                    <ul>
                    <?php foreach ($task['tags'] as $tag): ?>
                        <li class="task-tag <?= $tag['color_id'] ? "color-{$tag['color_id']}" : '' ?>"><?= $this->text->e($tag['name']) ?></li>
                    <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>
            

            <?= $this->render('board/task_footer', array(
                'task' => $task,
                'not_editable' => $not_editable,
                'project' => $project,
            )) ?>

        </div>
    <?php endif ?>
</div>
