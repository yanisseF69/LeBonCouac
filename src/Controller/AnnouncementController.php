<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Announcement;
use App\Form\AnnouncementType;
use App\Repository\AnnouncementRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnnouncementController extends AbstractController
{
    #[Route('/announcement', name: 'announcement', methods:['GET'])]
    public function index(AnnouncementRepository $repository, PaginatorInterface $paginator,
    Request $request) : Response
    {
        $announcements = $paginator->paginate(
            $repository->findAll(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('announcement/index.html.twig', [
            'announcements' => $announcements,
        ]);
    }

    #[Route('/announcement/new', name : 'create', methods:['GET', 'POST'])]
    public function new(): Response {

        $announcement = new Announcement();
        $form = $this->createForm(AnnouncementType::class, $announcement);
        
        return $this->render('/announcement/new.html.twig',
                ['form' => $form->createView()]
        );
    }
}
