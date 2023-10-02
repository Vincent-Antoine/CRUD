<?php

namespace App\Controller;

use App\Entity\Personnalite;
use App\Form\PersonnaliteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PersonnaliteController extends AbstractController
{
    #[Route('/personnalite', name: 'app_personnalite')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PersonnaliteController.php',
        ]);
    }

    /**
     * *@Route("/new", name="personnalite_new")
     */

    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $personnalite = new Personnalite();
        $form = $this->createForm(PersonnaliteType::class, $personnalite);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($personnalite);
            $entityManager->flush();

            // Vous devriez rediriger vers une route existante après la soumission réussie du formulaire.
            return $this->redirectToRoute('app_personnalite');
        }

        return $this->render('/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/list", name="personnalite_list")
     */
    public function list(EntityManagerInterface $entityManager)
    {
        $personnalites = $entityManager->getRepository(Personnalite::class)->findAll();

        return $this->render('/list.html.twig', [
            'personnalites' => $personnalites,
        ]);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('base.html.twig');
    }
}
