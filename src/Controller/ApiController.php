<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Job;
use App\Repository\JobRepository;
use App\Service\ApiPoleEmploi;

class ApiController extends AbstractController
{
    
    public function checkNewOffers()
    {
        
        $apiPoleEmploi = new ApiPoleEmploi();
        $items = $apiPoleEmploi->getNewOffers();
        $em = $this->getDoctrine()->getManager();
        foreach($items as $item){
            $idPoleEmploi = $item->id;
            if(is_null($em->getRepository(Job::class)->findOneByReference($idPoleEmploi))){
                $this->addLastOffer($item);
            }
        }
    }
    
    private function addLastOffer(object $item)
    {
        
        $em = $this->getDoctrine()->getManager();
        
        $company = 'Non précisée';
        if(isset($item->entreprise->nom)){
            $company = $item->entreprise->nom;
        }
        
        $place = 'Région de Bordeaux';
        if(isset($item->lieuTravail->libelle)){
            $place = $item->lieuTravail->libelle;
        }
        
        $link = '';
        if(isset($item->origineOffre->urlOrigine)){
            $link = $item->origineOffre->urlOrigine;
        }
        
        $newJob = new Job();
        $newJob->setTitle($item->appellationlibelle);
        $newJob->setDescription($item->description);
        $newJob->setPlace($place);
        $newJob->setType($item->typeContratLibelle);
        $newJob->setCompany($company);
        $newJob->setDate(new \DateTime($item->dateActualisation));
        $newJob->setReference($item->id);
        $newJob->setLink($link);
        
        $em->persist($newJob);
        $em->flush();
    }

}
