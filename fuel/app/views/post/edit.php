<?php

use Fuel\Core\Html;

/* @var Model_Post $post */
?>
<h2>Изменить <span class='muted'>пост</span> <?= $post->title ?></h2>
<br>

<?php echo render('post/_form'); ?>
<p>
    <?php echo Html::anchor('post/view/' . $post->id, 'View'); ?> |
    <?php echo Html::anchor('post', 'Back'); ?></p>
