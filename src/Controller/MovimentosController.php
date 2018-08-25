<?php

namespace App\Controller;

use App\Entity\Movimentos;
use App\Form\MovimentosType;
use App\Repository\MovimentosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movimentos")
 */
class MovimentosController extends Controller
{
    /**
     * @Route("/", name="movimentos_index", methods="GET")
     */
    public function index(MovimentosRepository $movimentosRepository): Response
    {
        return $this->render('movimentos/index.html.twig', ['movimentos' => $movimentosRepository->findAll()]);
    }

    /**
     * @Route("/new", name="movimentos_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $movimento = new Movimentos();
        $form = $this->createForm(MovimentosType::class, $movimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($movimento);
            $em->flush();

            return $this->redirectToRoute('movimentos_index');
        }

        return $this->render('movimentos/new.html.twig', [
            'movimento' => $movimento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movimentos_show", methods="GET")
     */
    public function show(Movimentos $movimento): Response
    {
        return $this->render('movimentos/show.html.twig', ['movimento' => $movimento]);
    }

    /**
     * @Route("/{id}/edit", name="movimentos_edit", methods="GET|POST")
     */
    public function edit(Request $request, Movimentos $movimento): Response
    {
        $form = $this->createForm(MovimentosType::class, $movimento);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('movimentos_edit', ['id' => $movimento->getId()]);
        }

        return $this->render('movimentos/edit.html.twig', [
            'movimento' => $movimento,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="movimentos_delete", methods="DELETE")
     */
    public function delete(Request $request, Movimentos $movimento): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movimento->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($movimento);
            $em->flush();
        }

        return $this->redirectToRoute('movimentos_index');
    }
}
