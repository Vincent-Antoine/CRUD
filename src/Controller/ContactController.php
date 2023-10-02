<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class ContactController extends AbstractController
{
    /**
     * @Route("/new", name="contact_new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            // Redirigez vers la liste des contacts après l'ajout d'un nouveau contact
            return $this->redirectToRoute('contact_list');
        }

        return $this->render('/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contacts", name="contact_list")
     */
    public function list(EntityManagerInterface $entityManager)
    {
        $contacts = $entityManager->getRepository(Contact::class)->findAll();

        return $this->render('/list.html.twig', [
            'contacts' => $contacts,
        ]);
    }

    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('base.html.twig');
    }

    /**
     * @Route("/contact/edit/{id}", name="contact_edit")
     */
    public function edit(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Redirigez vers la liste après la modification
            return $this->redirectToRoute('contact_list');
        }

        return $this->render('Contact/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/contact/delete/{id}", name="contact_delete")
     */
    public function delete(Contact $contact, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($contact);
        $entityManager->flush();

        // Redirigez vers la liste après la suppression
        return $this->redirectToRoute('contact_list');
    }
}
