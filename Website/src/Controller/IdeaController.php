<?php

namespace App\Controller;

use App\Entity\Idea;
use App\Entity\Upvote;
use App\Form\IdeaType;
use App\Repository\IdeaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/idea")
 */
class IdeaController extends Controller
{
    /**
     * @Route("/", name="idea_index", methods="GET")
     */
    public function index(IdeaRepository $ideaRepository): Response
    {
        return $this->render('idea/index.html.twig', ['ideas' => $ideaRepository->findAll()]);
    }

    /**
     * @Route("/new", name="idea_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $idea = new Idea();
        $session = new Session();
        $user = $session->get('user');
        $idea->setIdCreator($user);
        $idea->setUpvotes(0);
        $form = $this->createForm(IdeaType::class, $idea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($idea);
            $em->flush();

            return $this->redirectToRoute('idea_index');
        }

        return $this->render('idea/new.html.twig', [
            'idea' => $idea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="idea_show", methods="GET")
     */
    public function show(Idea $idea): Response
    {
        return $this->render('idea/show.html.twig', ['idea' => $idea]);
    }

    /**
     * @Route("/{id}/edit", name="idea_edit", methods="GET|POST")
     */
    public function edit(Request $request, Idea $idea): Response
    {
        $form = $this->createForm(IdeaType::class, $idea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('idea_edit', ['id' => $idea->getId()]);
        }

        return $this->render('idea/edit.html.twig', [
            'idea' => $idea,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="idea_delete", methods="DELETE")
     */
    public function delete(Request $request, Idea $idea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$idea->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($idea);
            $em->flush();
        }

        return $this->redirectToRoute('idea_index');
    }

    /**
     * @Route("/upvote/{id}", name="idea_upvote", methods="GET|POST")
     */
    public function upvote(Idea $idea) {

        $session = new Session();
        $user = $session->get('user');

        $upvote = new Upvote();
        $upvote->setUserId($user);
        $upvote->setIdeaId($idea);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->persist($upvote);
        $em->flush();

        return $this->redirectToRoute('idea_index');
    }
}
