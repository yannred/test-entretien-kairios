<?php

namespace App\Normalizer\DemandeClinique\tests\units;

use atoum\atoum;
use Doctrine\Common\Collections\ArrayCollection;

class DepotNormalizer extends atoum\test
{
    private $reponseNormalizer;

    public function beforeTestMethod()
    {
        $this->reponseNormalizer = new \mock\App\Normalizer\DemandeClinique\ReponseNormalizer();
        $this->calling($this->reponseNormalizer)->normalize = [
            'reponse' => 1,
        ];
    }

    public function testNormalize()
    {
        $this
            ->assert('Test de normalisation OK')
            ->given(
                $reponse = $this->getReponse(),
                $depot = $this->getDepot([$reponse])
            )
            ->if(
                $depotNormalizer = $this->getTestedInstance()
            )
            ->then
                ->array($depotNormalizer->normalize($depot))
                    ->isEqualTo([
                        'id' => 1,
                        'date_creation' => '2019-01-01 00:00:00',
                        'titre' => 'titre',
                        'description' => 'description',
                        'reponses' => [
                            [
                                'reponse' => 1,
                            ],
                        ],
                    ])
                ->mock($this->reponseNormalizer)
                    ->call('normalize')
                        ->withArguments($reponse)
                        ->once()
        ;
    }

    private function getDepot($reponses = [])
    {
        $depot = new \mock\App\Entity\DemandeClinique\Depot();
        $this->calling($depot)->getReponses = new ArrayCollection($reponses);
        $this->calling($depot)->getId = 1;
        $this->calling($depot)->getDateCreation = new \DateTime('2019-01-01 00:00:00');
        $this->calling($depot)->getTitre = 'titre';
        $this->calling($depot)->getDescription = 'description';


        return $depot;
    }

    private function getReponse()
    {
        return new \mock\App\Entity\DemandeClinique\Reponse();
    }

    private function getTestedInstance()
    {
        return $this->newTestedInstance($this->reponseNormalizer);
    }
}