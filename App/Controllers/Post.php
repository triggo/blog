<?php

namespace App\Controllers;

use Core\Controller;
use Core\View;

class Post extends Controller
{
    /**
     * Posts list
     *
     * @return void
     */
    public function indexAction()
    {
        $posts = (new \App\Models\Post())->getAll();

        View::render('Posts/index.php', ['posts' => $posts]);
    }

    /**
     * Create form
     *
     * @return void
     */
    public function createAction()
    {
        View::render('Posts/create.php');
    }

    /**
     * Save post in DB
     */
    public function storeAction()
    {
        $post = new \App\Models\Post();

        $file = pathinfo($_FILES['cover']['name']);
        $ext = $file['extension']; // get the extension of the file
        $newFile = microtime() . '.' .$ext;

        $uploadPath = 'images/';
        $cover = $uploadPath . $newFile;

        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        move_uploaded_file( $_FILES['cover']['tmp_name'], $cover);

        try {
            $post->savePost($_POST, $cover);
            echo json_encode(['status' => true], JSON_UNESCAPED_UNICODE);die;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Display post
     */
    public function showAction()
    {
        $post = (new \App\Models\Post())->getCurrentPost($_GET['id']);

        if($post == false) {
            View::render('404.php');die;
        }

        View::render('Posts/show.php', ['post' => $post]);
    }

    /**
     * Remove post from DB
     */
    public function deleteAction()
    {
        try {
            (new \App\Models\Post())->deleteCurrentPost($_POST['id']);
            echo json_encode(['status' => true], JSON_UNESCAPED_UNICODE);die;
        } catch (\Exception $e) {
            echo json_encode(['status' => false, 'msg' => $e->getMessage() ], JSON_UNESCAPED_UNICODE);die;
        }
    }
}