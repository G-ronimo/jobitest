<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Job;
use App\Repository\JobRepository;
use App\Controller\ApiController;
use App\Service\ApiPoleEmploi;

class JobController extends AbstractController
{

    /**
     * @Route("/", name="jobs")
     */
    public function index(ApiController $apiController)
    {
        $apiController->checkNewOffers();
        $jobs = $this->getDoctrine()->getRepository(Job::class)->findLastJobs(10);
        
        return $this->render('job/index.html.twig', [
            'jobs' => $jobs,
            'title' => 'Pôle Emploi : les 10 dernières offres à pouvroir à Bordeaux',
            'pagetitle' => 'Les offres d\'emplois publiées par Pôle Emploi',
        ]);
    }

    /**
     * @Route("/job/{id}/show/", name="job_show", requirements={"page"="\d+"})
     */
    public function showAction(Job $job)
    {   
        $item = $this->getDoctrine()->getRepository(Job::class)->find($job);
        
        return $this->render('job/show.html.twig',[
            'job' => $item,
            'title' => 'Pôle Emploi : '.$item->getTitle(),
            'pagetitle' => 'Les offres d\'emplois publiées par Pôle Emploi',
        ]);
    }

}
