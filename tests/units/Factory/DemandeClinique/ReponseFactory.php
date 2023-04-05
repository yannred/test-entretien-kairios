<?php

namespace App\Factory\DemandeClinique\tests\units;

use atoum\atoum;

class ReponseFactory extends atoum\test
{
    public function testCreer()
    {
        $this
            ->assert('Test de création OK')
            ->given(
                $depot = $this->getDepot(),
                $titre = 'titre',
                $description = 'description',
                $type = 1
            )
            ->if(
                $reponseFactory = $this->getTestedInstance()
            )
            ->then
                ->object($reponseFactory->creer($depot, $titre, $description, $type))
                    ->isInstanceOf(\App\Entity\DemandeClinique\Reponse::class)
        ;
    }

    private function getDepot()
    {
        return new \mock\App\Entity\DemandeClinique\Depot();
    }

    private function getTestedInstance()
    {
        return $this->newTestedInstance();
    }
}