<?php
/* @var Model_Post[] $posts */

use Fuel\Core\Html;

?>
<h3>Это меню</h3>
<p>(тут только активные)</p>
<ul>
    <?php foreach ($posts as $post):?>
    <li><?= Html::anchor('/post/view/'.$post->id, $post->title)?></li>
    <?php endforeach; ?>
</ul>