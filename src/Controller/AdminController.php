<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use App\Repository\CommentRepository;
use App\Entity\User;
use Datetime;

class AdminController extends AbstractController
{
    /**
     * @Route("/administration", name="dashboard")
     * @param UserRepository $userRepository
     * @return Response
    */
    public function dashboard(CommentRepository $commentRepository, UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        $comments = $commentRepository->findAll();
        $nbComments = count($comments);

        $commentsYear = 0;
        foreach ($comments as $comment) {
            $datetime = $comment->getDateTime();
            $origin = new DateTime('now');
            $target = $datetime;
            $interval = $origin->diff($target);
            if ($interval->format('%y%') < 5) {
                $commentsYear += 1;
            }
        }
        return $this->render('admin/admin.html.twig', [
            'users' => $users,
            'nbcomments' => $nbComments,
            'commentsyear' => $commentsYear]);
    }

        /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dashboard');
    }
}
