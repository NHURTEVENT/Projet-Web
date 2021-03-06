<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\Photo;
use App\Form\PhotoType;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/photo")
 */
class PhotoController extends Controller
{
    /**
     * @Route("/", name="photo_index", methods="GET")
     */
    public function index(PhotoRepository $photoRepository): Response
    {
        return $this->render('photo/index.html.twig', ['photos' => $photoRepository->findAll()]);
    }

    /**
     * @Route("/new/{event_id}", name="photo_new", methods="GET|POST")
     */
    public function new(Request $request, $event_id): Response
    {
        $session = new Session();
        $user = $session->get('user');

        $repo = $this->getDoctrine()->getRepository(Event::class);
        $event = $repo->find($event_id);

        $photo = new Photo();
        $photo->setUserId($user);
        $photo->setEventId($event);

        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush();

            return $this->redirectToRoute('photo_index');
        }

        return $this->render('photo/new.html.twig', [
            'photo' => $photo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="photo_show", methods="GET")
     */
    public function show(Photo $photo): Response
    {
        return $this->render('photo/show.html.twig', ['photo' => $photo]);
    }

    /**
     * @Route("/{id}/edit", name="photo_edit", methods="GET|POST")
     */
    public function edit(Request $request, Photo $photo): Response
    {
        $form = $this->createForm(PhotoType::class, $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('photo_edit', ['id' => $photo->getId()]);
        }

        return $this->render('photo/edit.html.twig', [
            'photo' => $photo,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="photo_delete", methods="DELETE")
     */
    public function delete(Request $request, Photo $photo): Response
    {
        if ($this->isCsrfTokenValid('delete'.$photo->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($photo);
            $em->flush();
        }

        return $this->redirectToRoute('photo_index');
    }

}
