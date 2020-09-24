<?php

namespace App\Controller;

use App\Form\FormulaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Liste;
use Symfony\Contracts\Translation\TranslatorInterface;

class Controller extends AbstractController
{
    /**
     * @Route("/liste", name="liste")
     */
    public function index()
    {
        return $this->render('serie/liste.html.twig');
    }
    /**
     * @Route("/liste/{id}", name="serie_detail",
     *  requirements={"id":"\d+"},
     *  methods={"GET"})
     */
    public function detail($id)
    {

        $repo = $this->getDoctrine()->getRepository(Liste::class);
        $liste = $repo->find($id);
        return $this->render('serie/detail.html.twig',["liste"=>$liste]);
    }
    /**
     * @Route("/add", name="add")
     */
    public function add(EntityManagerInterface $em,Request $request)
    {

        if(!$this->isGranted("ROLE_USER"))
        {
            dump($this->getUser());
            return $this->redirectToRoute();
        }else
        {
            dump($this->getUser());
        }
        $liste = new Liste();
        $listeForm = $this->createForm(FormulaireType::class,$liste);
        $listeForm->handleRequest($request);
        if($listeForm->isSubmitted())
        {
            $liste->setDate(new \DateTime());
           $em->persist($liste);
           $em->flush();
           $this->addFlash("bravo","sauvegardé");
           return $this->redirectToRoute('serie_detail',['id' => $liste->getId()]);
        }
        return $this->render('serie/add.html.twig',[
            "listeForm"=>$listeForm->createView()
            ]
        );
    }
    /**
     * @Route("/delete", name="delete")
     */
    public function delete($id,EntityManagerInterface $em)
    {
            $serieRepo = $this->getDoctrine()->getRepository(Serie::class);
            $serie = $serieRepo->find($id);
            $em->remove($serie);
            $em->flush();
            $this->addFlash('reussi',supprimé);
            return $this->redirectToRoute('home');

    }
}
