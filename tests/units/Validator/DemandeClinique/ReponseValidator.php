<?php

namespace App\Validator\DemandeClinique\tests\units;

use atoum\atoum;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ReponseValidator extends atoum\test
{
    public function testValiderOk()
    {
        $this
            ->assert('Test de validation OK')
            ->given(
                $reponse = $this->getReponse()
            )
            ->if(
                $reponseValidator = $this->getTestedInstance()
            )
            ->then
                ->variable($reponseValidator->valider($reponse))
                    ->isNull()
        ;
    }

    public function testValiderKo()
    {
        $this
            ->assert('Test de validation KO')
            ->given(
                $reponse = $this->getReponse(6)
            )
            ->if(
                $reponseValidator = $this->getTestedInstance()
            )
            ->then
                ->exception(function () use ($reponseValidator, $reponse) {
                    $reponseValidator->valider($reponse);
                })
                    ->isInstanceOf(BadRequestHttpException::class)
        ;
    }

    private function getReponse($type = 1)
    {
        $reponse = new \mock\App\Entity\DemandeClinique\Reponse();
        $reponse->getMockController()->getType = $type;

        return $reponse;
    }

    private function getTestedInstance()
    {
        return $this->newTestedInstance();
    }
}