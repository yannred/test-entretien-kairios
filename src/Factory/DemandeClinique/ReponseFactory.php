<?php

namespace App\Factory\DemandeClinique;

use App\Entity\DemandeClinique\Depot;
use App\Entity\DemandeClinique\Reponse;

class ReponseFactory
{
    public function creer(Depot $depot, string $titre, string $description, int $type): Reponse
    {
        return (new Reponse())
            ->setTitre($titre)
            ->setDescription($description)
            ->setDateCreation(new \DateTime())
            ->setDepot($depot)
            ->setType($type)
        ;
    }
}