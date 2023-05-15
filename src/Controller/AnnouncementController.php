<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Image;
use App\Entity\Announcement;
use App\Form\AnnouncementType;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\AnnouncementRepository;
use App\Repository\ImageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


class AnnouncementController extends AbstractController
{
    #[Route('/announcement', name: 'announcement_index', methods:['GET'])]
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

    #[Route('/announcement/success', name : 'announcement_success')]
    public function success() : Response {
        return $this->render('announcement/success.html.twig');
    }

    #[Route('/announcement/new', name : 'create', methods:['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $doctrine): Response {

        if(!$this->getUser()) return $this->render('/announcement/connect.html.twig');

        $announcement = new Announcement();
        $form = $this->createForm(AnnouncementType::class, $announcement);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        
            
            $announcement->setUser($this->getUser());
            $entityManager = $doctrine->getManager();
            $entityManager->persist($announcement);

            $file = $form->get('image')->getData();
            
            if($file->isFile()){
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                
                $image = new Image();
                $image->setFileName($fileName);
                $image->setType($file->getMimeType());
                $image->setSize($file->getSize());

                try {
                    $file->move(
                        $this->getParameter('images_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                
                

                $announcement->addImage($image);
                $image->setAnnouncement($announcement);


                $entityManager->persist($image);
                $entityManager->flush();
            }

    
            return $this->redirectToRoute('announcement_success');
        }
        
        return $this->render('/announcement/new.html.twig',
                ['form' => $form->createView()]
        );
    }

    #[Route('/announcement/detail/{id}', name : 'detail')]
    public function detail($id, ManagerRegistry $doctrine, ImageRepository $imageRepository) : Response {

        $announcement = $doctrine->getManager()
                        ->getRepository(Announcement::class)
                        ->find($id);

        $images = $imageRepository->findBy(['announcement' => $announcement]);

        if($images == null){
            $images = $imageRepository->findBy(['filename' => 'vide.jpg']);
        }

        


        return $this->render('/announcement/detail.html.twig',
                ['announcement' => $announcement,
                'images' => $images]);
    }
}
