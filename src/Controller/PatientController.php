<?php


namespace App\Controller;

use App\Entity\Patient;
use App\form\PatientFormType;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends abstractController
{
    /**
     * @Route("/newPat", name="newPat")
     */
    public function newPat(EntityManagerInterface $em, Request $request)
    {

        $patient = new Patient;
        $form = $this->createForm(PatientFormType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();

            $em->persist($patient);
            $em->flush();
            return $this->redirectToRoute('showPat');
        }
        return $this->render('/patient/patForm.html.twig', ['patForm' => $form->createView(),]);
    }

    /**
     * @Route("/{id}/DeletePat" , name="deletePat")
     */
    public function DeletePat($id, EntityManagerInterface $em)
    {
        $patient = $em->getRepository(Patient::class)->find($id);

        $em->remove($patient);
        $em->flush();

        return $this->redirectToRoute('showPat');
    }

    /**
     * @Route("/{id}/updatePat" , name="updatePat")
     */
    public function updatepat($id, EntityManagerInterface $em, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $patient = $em->getRepository(Patient::class)->find($id);
        $form = $this->createForm(PatientFormType::class, $patient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $pat = $form->getData();

            $patient->setName($pat->getName());
            $patient->setBirthdate($pat->getBirthdate());
            $patient->setAdress($pat->getAdress());
            $patient->setInsuranceType($pat->getInsuranceType());
            $em->flush();

            $this->addFlash('success', 'changed Patient');
            return $this->redirectToRoute('showPat');
        }
        return $this->render('/patient/patForm.html.twig', [
            'patForm' => $form->createView(),
        ]);
    }


    /**
     * @Route("/showPat", name="showPat")
     */
    public function showPat(): \Symfony\Component\HttpFoundation\Response
    {
        $patient = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->findAll();

        if (!$patient) {
            throw $this->createNotFoundException(
                'No medicijn found '
            );
        }
        return $this->render('/patient/patient.html.twig', ['patient' => $patient]);
    }

}