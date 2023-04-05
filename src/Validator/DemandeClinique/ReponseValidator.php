<?php

namespace App\Validator\DemandeClinique;

use App\Entity\DemandeClinique\Reponse;
use App\Enum\DemandeClinique\Reponse\Type;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ReponseValidator
{
    public function valider(Reponse $reponse): void
    {
        if (in_array($reponse->getType(), Type::getAll()) === false) {
            throw new BadRequestHttpException('Le type de réponse n\'est pas valide');
        }
    }
}