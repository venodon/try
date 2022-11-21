<?php

use Fuel\Core\Presenter;

class Presenter_Menu extends Presenter
{
    public function view()
    {
        $this->title = 'Меню презентер';
        $this->posts = Model_Post::find('all');
    }
}