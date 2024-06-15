<?php

namespace App\Api\v1\Controller\DemandeClinique;

use App\Entity\DemandeClinique\Reponse;
use App\Manager\DemandeClinique\ReponseManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/demande-clinique")
 */
class ReponsesController extends AbstractController
{
    /** @var ReponseManager */
    private $reponseManager;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(ReponseManager $reponseManager, EntityManagerInterface $entityManager)
    {
        $this->reponseManager = $reponseManager;
        $this->entityManager = $entityManager;
    }


    /**
     * @Route("/reponses/valider", name="api_v1_depots_valider_reponse", methods={"POST"})
     */
    public function valider(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if(!isset($data['ids']) || !isset($data['reason'])){
            throw new BadRequestHttpException('ids et/ou reason manquants');
        }

        foreach ($data['ids'] as $id) {
            if($reponse = $this->entityManager->getRepository(Reponse::class)->find($id)){
                $this->reponseManager->valider($reponse, $data['reason']);
            } else {
                throw new BadRequestHttpException('Reponse non trouvée');
            }
        }

        return $this->json([], Response::HTTP_OK);
    }

}
