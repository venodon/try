<?php


class Observer_Views extends Orm\Observer
{
    /**
     * @param $model
     * @return void
     */
    public function after_load(Orm\Model $model)
    {
        $model->views = rand(1,100);
    }
}