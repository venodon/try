<?php

use Fuel\Core\Form;
use Fuel\Core\Input;

/**
 * @var Model_Post $post
 */
?>

<?php echo Form::open(array("class" => "form-horizontal")); ?>
    <fieldset>
        <div class="form-group">
            <?php echo Form::label('Заговолок', 'title', array('class' => 'control-label')); ?>
            <?php echo Form::input('title', Input::post('title', isset($post) ? $post->title : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Title')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Превью', 'preview', array('class' => 'control-label')); ?>
            <?php echo Form::input('preview', Input::post('preview', isset($post) ? $post->preview : ''), array('class' => 'col-md-4 form-control', 'placeholder' => 'Preview')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Текст', 'body', array('class' => 'control-label')); ?>
            <?php echo Form::textarea('body', Input::post('body', isset($post) ? $post->body : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder' => 'Body')); ?>
        </div>
        <div class="form-group">
            <?php echo Form::label('Статус', 'status', array('class' => 'control-label')); ?>
            <?php echo Form::select('status', Input::post('status', isset($post) ? $post->status : ''), [Model_Post::STATUS_LIST], array('class' => 'col-md-4 form-control', 'placeholder' => 'Status')); ?>
        </div>

        <div class="form-group">
            <label class='control-label'>&nbsp;</label>
            <?php echo Form::submit('submit', 'Сохранить', array('class' => 'btn btn-primary')); ?>
        </div>
    </fieldset>
<?php echo Form::close(); ?>