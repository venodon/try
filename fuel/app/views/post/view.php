<?php

use Fuel\Core\Html;

/**
 * @var Model_Post $post
 */
?>

    <h2>Просмотр поста <span class='muted'>#<?php echo $post->id; ?></span></h2>

    <p>
        <strong>Title:</strong>
        <?php echo $post->title; ?></p>
    <p>
        <strong>Preview:</strong>
        <?php echo $post->preview; ?></p>
    <p>
        <strong>Body:</strong>
        <?php echo $post->body; ?></p>
    <p>
        <strong>Status:</strong>
        <?php echo $post->status; ?></p>

<?php echo Html::anchor('post/edit/' . $post->id, 'Edit'); ?> |
<?php echo Html::anchor('post', 'Back'); ?>