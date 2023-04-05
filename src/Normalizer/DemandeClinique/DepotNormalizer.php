<?php

namespace App\Normalizer\DemandeClinique;

use App\Entity\DemandeClinique\Depot;
use App\Entity\DemandeClinique\Reponse;
use App\Normalizer\DemandeClinique\ReponseNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class DepotNormalizer implements NormalizerInterface
{
    /** @var ReponseNormalizer $reponseNormalizer */
    private $reponseNormalizer;

    public function __construct(ReponseNormalizer $reponseNormalizer)
    {
        $this->reponseNormalizer = $reponseNormalizer;
    }

    public function normalize($object, string $format = null, array $context = [])
    {
        return [
            'id' => $object->getId(),
            'date_creation' => $object->getDateCreation()->format('Y-m-d H:i:s'),
            'titre' => $object->getTitre(),
            'description' => $object->getDescription(),
            'reponses' => array_map(function(Reponse $reponse) {
                return $this->reponseNormalizer->normalize($reponse);
            }, $object->getReponses()->toArray()),
        ];
    }

    public function supportsNormalization($data, string $format = null)
    {
        return $data instanceof Depot;
    }
}