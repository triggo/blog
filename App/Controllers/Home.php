<?php

namespace App\Controllers;

use Core\Controller;
use \Core\View;

class Home extends Controller
{
    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        View::render('Home/index.php');
    }
}
