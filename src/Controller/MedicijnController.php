<?php

namespace App\Controller;

use App\Entity\Medicijn;
use App\Entity\Patient;
use App\Entity\Recept;
use App\form\medicijnFormType;
use App\form\ReceptFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\Routing\Annotation\Route;

class MedicijnController extends AbstractController
{

    /**
     * @Route("/newMed" ,name="new")
     */

    public function newMed(EntityManagerInterface $em,Request $request)
    {
        $medicijn = new Medicijn();
        $form = $this->createForm(medicijnFormType::class , $medicijn);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $medicijn = $form->getData();


            $em->persist($medicijn);
            $em->flush();

            $this->addFlash('success','added medicijn');

            return $this->redirectToRoute("show");

        }

        return $this->render('/medicijn/medForm.html.twig', ['medForm'=> $form->createView(),]);

    }
    /**
     * @route("/{id}/deleteMed", name="delete")
     */
    public function deleteMed($id, EntityManagerInterface $em){
        $medicijn = $em->getRepository(Medicijn::class)->find($id);

        $em->remove($medicijn);
        $em->flush();

        return $this->redirectToRoute('show');
    }

    /**
     * @Route("/{id}/updateMed", name="update")
     */
    public function updateMed($id, EntityManagerInterface $em, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $medicijn = $em->getRepository(Medicijn::class)->find($id);
        $form = $this->createForm(medicijnFormType::class, $medicijn);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $med = $form->getData();

            $medicijn->setName($med->getName());
            $medicijn->setPrice($med->getPrice());
            $medicijn->setDiscription($med->getDiscription());
            $medicijn->setSideEffect($med->getSideEffect());
            $medicijn->setInsurance($med->getInsurance());
            $em->flush();

            $this->addFlash('success','changed medicijn');
            return $this->redirectToRoute('show');

        }

        return $this->render('/medicijn/medForm.html.twig', [
            'medForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/{id}/addRecept", name="addRecept")
     */
    public function addRecept($id,EntityManagerInterface $em,Request $request): Response{
        $rec = new Recept();
        $form = $this->createForm(ReceptFormType::class, $rec);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $med = $form->getData();
            $pat = $em->getRepository(Patient::class)->find($id);
            $med->setPatient($pat);

            $em = $this->getDoctrine()->getManager();
            $em->persist($med);
            $em->flush();

            return $this->redirectToRoute('show');
        }

        return $this->render('/medicijn/medForm.html.twig',[
            'medForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/showRecept" ,name="showRecept")
     */
    public function showRecept(): Response {
        $recept = $this->getDoctrine()->getRepository(Recept::class)->findAll();

        if (!$recept){
            throw $this->createNotFoundException('no recepten found');
        }
        return $this->render('/recept/show.html.twig', ['recept' => $recept]);
    }


    /**
     * @Route("/ ", name="show")
     */

    public function showMedicijn(): Response
    {
        $medicijn = $this->getDoctrine()
            ->getRepository(Medicijn::class)
            ->findAll();

        if (!$medicijn) {
            throw $this->createNotFoundException(
                'No medicijn found '
            );
        }
        return $this->render('/medicijn/medicijn.html.twig', ['medicijn' => $medicijn]);
    }
}
