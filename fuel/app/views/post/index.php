<?php
/**
 * @var Model_Post[] $posts
 * @var string $presenterMenu
 */

use Fuel\Core\Html;

?>
<h2>Список <span class='muted'>постов</span></h2>
<br>
<?php if ($posts): ?>
<div class="row">
    <div class="col-sm-10">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Заголовок</th>
                <th>Превью</th>
                <th>Текст</th>
                <th>Статус</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($posts as $item): ?>
                <tr>

                    <td><?php echo $item->title; ?></td>
                    <td><?php echo $item->preview; ?></td>
                    <td><?php echo $item->body; ?></td>
                    <td><?php echo $item->getStatusName($item->status); ?></td>
                    <td>
                        <div class="btn-toolbar">
                            <div class="btn-group">
                                <?php echo Html::anchor('post/view/' . $item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?><?php echo Html::anchor('post/edit/' . $item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?><?php echo Html::anchor('post/delete/' . $item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>                    </div>
                        </div>

                    </td>
                </tr>
            <?php endforeach; ?>    </tbody>
        </table>

        <?php else: ?>
            <p>Посты отсутствуют.</p>

        <?php endif; ?><p>
            <?php echo Html::anchor('post/create', 'Добавить пост', array('class' => 'btn btn-success')); ?>

        </p>
    </div>
    <div class="col-sm-2">
        <?= $presenterMenu ?>
    </div>
</div>
