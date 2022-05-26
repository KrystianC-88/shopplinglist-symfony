<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'user' => 'xD',
        ]);
    }

    #[Route('/lists', name: 'app_lists')]
    public function Lists(): Response
    {
        $user = $this->getUser();

        $rooms = $user->getRooms();

        

        return $this->render('user/lists.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
