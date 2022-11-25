<?php

use Fuel\Core\Controller_Template;
use Fuel\Core\Input;
use Fuel\Core\Presenter;
use Fuel\Core\Request;
use Fuel\Core\Response;
use Fuel\Core\Session;
use Fuel\Core\View;

/**
 * @property Controller_Template $template
 */

class Controller_Post extends Controller_Template
{

    public function action_index()
    {
//        $widget = Request::forge('data/list')->execute();
        $category = Model_Category::find(1);
        $d = $category->posts;
        $data['posts'] = Model_Post::find('all',['related'=>'category']);
        $this->template->title = "Посты";
        $presenterMenu = Presenter::forge('menu');
        $data['presenterMenu'] = $presenterMenu;
        $this->template->content = View::forge('post/index', $data);
    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('post');

        if (!$data['post'] = Model_Post::find($id)) {
            Session::set_flash('error', 'Could not find post #' . $id);
            Response::redirect('post');
        }

        $this->template->title = "Post";
        $this->template->content = View::forge('post/view', $data);

    }

    public function action_create()
    {
        if (Input::method() == 'POST') {
            $val = Model_Post::validate('create');

            if ($val->run()) {
                $post = Model_Post::forge(array(
                    'title' => Input::post('title'),
                    'preview' => Input::post('preview'),
                    'body' => Input::post('body'),
                    'status' => Input::post('status'),
                ));

                if ($post and $post->save()) {
                    Session::set_flash('success', 'Added post #' . $post->id . '.');

                    Response::redirect('post');
                } else {
                    Session::set_flash('error', 'Could not save post.');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Posts";
        $this->template->content = View::forge('post/create');

    }

    public function action_edit($id = null)
    {
        is_null($id) and Response::redirect('post');

        if (!$post = Model_Post::find($id)) {
            Session::set_flash('error', 'Could not find post #' . $id);
            Response::redirect('post');
        }
        /* @var Model_Post $post */
        $val = Model_Post::validate('edit');

        if ($val->run()) {
            $post->title = Input::post('title');
            $post->preview = Input::post('preview');
            $post->body = Input::post('body');
            $post->status = Input::post('status');

            if ($post->save()) {
                Session::set_flash('success', 'Updated post #' . $id);

                Response::redirect('post');
            } else {
                Session::set_flash('error', 'Could not update post #' . $id);
            }
        } else {
            if (Input::method() == 'POST') {
                $post->title = $val->validated('title');
                $post->preview = $val->validated('preview');
                $post->body = $val->validated('body');
                $post->status = $val->validated('status');

                Session::set_flash('error', $val->error());
            }

            $this->template->set_global('post', $post, false);
        }

        $this->template->title = "Posts";
        $this->template->content = View::forge('post/edit');

    }

    public function action_delete($id = null)
    {
        is_null($id) and Response::redirect('post');

        if ($post = Model_Post::find($id)) {
            $post->delete();

            Session::set_flash('success', 'Deleted post #' . $id);
        } else {
            Session::set_flash('error', 'Could not delete post #' . $id);
        }

        Response::redirect('post');

    }

}
