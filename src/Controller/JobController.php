<?php

namespace App\Controller;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JobController extends AbstractController
{
    /**
     * @Route("/jobs", name="job_index")
     */
    public function index(JobRepository $jobRepository)
    {
        $jobs = $jobRepository->findAll();

        return $this->render('job/index.html.twig', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * @Route("/jobs/create", name="create_job")
     */
    public function createJob(Request $request)
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($job);
            $entityManager->flush();

            // Redirection vers une autre page après la création de l'offre d'emploi
            return $this->redirectToRoute('/jobs');
        }

        return $this->render('job/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}