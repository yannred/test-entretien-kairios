<?php

namespace App\DataFixtures\DemandeClinique;

use App\Entity\DemandeClinique\Reponse;
use App\Enum\DemandeClinique\Reponse\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReponseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getDatas() as [$name, $description, $date, $depot, $type]) {
            $reponse = new Reponse();
            $reponse->setTitre($name);
            $reponse->setDescription($description);
            $reponse->setDateCreation($date);
            $reponse->setDepot($this->getReference('depot_'.$depot));
            $reponse->setType($type);
            $manager->persist($reponse);
        }

        $manager->flush();
    }

    private function getDatas(): iterable
    {
        yield ['Réponse numéro 1', 'Ceci est la description de la réponse numéro 1', new \DateTime('2023-01-01 00:00:00'), 1, Type::PRIORITAIRE];
        yield ['Réponse numéro 2', 'Ceci est la description de la réponse numéro 2', new \DateTime('2023-01-01 01:00:00'), 1, Type::PRIORITAIRE];
        yield ['Réponse numéro 3', 'Ceci est la description de la réponse numéro 3', new \DateTime('2023-01-01 02:00:00'), 1, Type::DANS_L_HEURE];
        yield ['Réponse numéro 4', 'Ceci est la description de la réponse numéro 4', new \DateTime('2023-01-01 03:00:00'), 1, Type::DANS_L_HEURE];
    }

    public function getDependencies()
    {
        return [
            DepotFixtures::class,
        ];
    }
}