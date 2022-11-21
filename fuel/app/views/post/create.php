<?php

use Fuel\Core\Html;

?>
<h2>Новый <span class='muted'>пост</span></h2>
<br>

<?php echo render('post/_form'); ?>

<p><?php echo Html::anchor('post', 'Вернуться'); ?></p>
