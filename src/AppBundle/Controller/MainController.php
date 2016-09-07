<?php
/**
 * Created by PhpStorm.
 * User: danbevan
 * Date: 06/09/2016
 * Time: 14:45
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }

    public function listAction()
    {
        return $this->render('user/list.html.twig');
    }
}