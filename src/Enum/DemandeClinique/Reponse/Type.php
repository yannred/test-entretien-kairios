<?php

namespace App\Enum\DemandeClinique\Reponse;

class Type
{
    const PRIORITAIRE = 1;
    const DANS_L_HEURE = 2;
    const DANS_LA_JOURNEE = 3;
    const DANS_LES_48_HEURES = 4;

    public static function getAll(): array
    {
        return [
            self::PRIORITAIRE,
            self::DANS_L_HEURE,
            self::DANS_LA_JOURNEE,
            self::DANS_LES_48_HEURES,
        ];
    }
}