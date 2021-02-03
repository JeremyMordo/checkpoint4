<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommentRepository;

class GuestBookController extends AbstractController
{
    /**
     * @Route("/livredor", name="guestbook")
     */
    public function guestbook(CommentRepository $commentRepository): Response
    {
        $comments = $commentRepository->findAll();
        return $this->render('home/guestbook.html.twig', ['comments' => $comments]);
    }
}
