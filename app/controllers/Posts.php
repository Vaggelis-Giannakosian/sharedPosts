<?php
/**
 * Created by PhpStorm.
 * User: lostre
 * Date: 24/2/2019
 * Time: 11:30 πμ
 */

class Posts extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }


    public function index()
    {
        //Get Posts
        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function add()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize the post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];
            //VALIDATE TITLE
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            //VALIDATE BODY
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }
            //MAKE SURE NO ERRORS
            if (empty($data['title_err']) && empty($data['body_err'])) {
                //validated

                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Post Added');
                    redirect('posts');
                } else {
                    die('Sth went wrong');
                }


            } else {
                //load the view with errors
                $this->view('posts/add', $data);
            }

        } else {
            $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => '',
            ];
            $this->view('posts/add', $data);
        }
    }

    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user,
        ];
        $this->view('posts/show', $data);
    }

    public function edit($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize the post array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];
            //VALIDATE TITLE
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }
            //VALIDATE BODY
            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body text';
            }
            //MAKE SURE NO ERRORS
            if (empty($data['title_err']) && empty($data['body_err'])) {
                //validated

                if ($this->postModel->updatePost($data)) {
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                } else {
                    die('Sth went wrong');
                }


            } else {
                //load the view with errors
                $this->view('posts/edit', $data);
            }

        } else {
            //get existing post from model
            $post = $this->postModel->getPostById($id);
            //check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
                'title_err' => '',
                'body_err' => '',
            ];
            $this->view('posts/edit', $data);
        }
    }

    public function delete($id)
    {
        //get existing post from model
        $post = $this->postModel->getPostById($id);
        //check for owner
        if ($post->user_id != $_SESSION['user_id']) {
            redirect('posts');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->postModel->deletePost($id)) {
                flash('post_message', 'Post Removed');
                redirect('posts');
            } else {
                die("Sth went wrong");
            }
        } else {
            redirect('posts');
        }

    }

}