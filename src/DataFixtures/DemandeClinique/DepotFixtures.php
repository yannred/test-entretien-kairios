<?php

namespace App\DataFixtures\DemandeClinique;

use App\Entity\DemandeClinique\Depot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepotFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getDatas() as [$id, $name, $description, $date]) {
            $depot = new Depot();
            $depot->setTitre($name);
            $depot->setDescription($description);
            $depot->setDateCreation($date);
            $manager->persist($depot);

            $this->addReference('depot_'.$id, $depot);
        }

        $manager->flush();
    }

    private function getDatas(): iterable
    {
        yield [1, 'Dépot numéro 1', 'Ceci est la description du dépot numéro 1', new \DateTime('2023-01-01 00:00:00')];
        yield [2, 'Dépot numéro 2', 'Ceci est la description du dépot numéro 2', new \DateTime('2023-01-01 01:00:00')];
        yield [3, 'Dépot numéro 3', 'Ceci est la description du dépot numéro 3', new \DateTime('2023-01-01 02:00:00')];
        yield [4, 'Dépot numéro 4', 'Ceci est la description du dépot numéro 4', new \DateTime('2023-01-01 03:00:00')];
        yield [5, 'Dépot numéro 5', 'Ceci est la description du dépot numéro 5', new \DateTime('2023-01-01 04:00:00')];
    }
}