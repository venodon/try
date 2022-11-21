<?php

use Fuel\Core\Presenter;

/**
 * @property string $title
 * @property Model_Post[] $posts
 */
class Presenter_Menu extends Presenter
{
    public function view()
    {
        $this->title = 'Меню презентер';
        $this->posts = Model_Post::query()->where('status', '=', Model_Post::STATUS_ACTIVE)->get();
    }
}