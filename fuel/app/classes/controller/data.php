<?php

use Fuel\Core\Controller_Rest;
use Fuel\Core\Input;

class Controller_Data extends Controller_Rest
{
    protected $format = 'json';

    /**
     * @return object
     */
    public function get_list()
    {
        $page = Input::get('page') ?? 1;
        $perPage = Input::get('perPage') ?? 3;
        return $this->response([
            'success' => true,
            'posts' => Model_Post::find('first')->to_array(true),
        ]);
    }

    /**
     * @return object
     */
    public function get_post()
    {
        $post = null;
        $id = Input::get('id') ?? 0;
        if ($id) {
            $post = Model_Post::query()->where('id', '=', (int)$id)->where('status', '=', Model_Post::STATUS_ACTIVE)->get_one();
        }
        return $this->response([
            'post' => $post,
            'message' => $post ? 'ok' : 'Не найдено поста с id=' . $id]);
    }

    /**
     * @return object
     * @throws Exception
     */
    public function post_post()
    {
        $id = (int)Input::post('id');
        if (!$id) {
            $post = new Model_Post();
        } else {
            $post = Model_Post::find($id);
        }
        if ($post) {
            $post->title = Input::post('title');
            $post->preview = Input::post('preview');
            $post->body = Input::post('body');
            $post->status = (int)Input::post('status');
        }
        $success = false;
        if ($post->valid()) {
            $post->save();
            $success = true;
        }
        return $this->response([
            'success' => $success,
            'post' => $post
        ]);
    }

    /**
     * @return object
     * @throws Exception
     */
    public function delete_post()
    {
        $id = (int)Input::delete('id');
        $post = Model_Post::find($id);
        if ($post) {
            $post->delete();
        }
        return $this->response(['success' => true]);
    }
}