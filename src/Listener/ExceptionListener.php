<?php

namespace App\Listener;

use App\Normalizer\ExceptionNormalizer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ExceptionListener
{
    /** @var ExceptionNormalizer $normalizer */
    private $normalizer;

    public function __construct(
        ExceptionNormalizer $normalizer
    ) {
        $this->normalizer = $normalizer;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        if ($event->getThrowable() instanceof HttpException) {
            $data = $this->normalizer->normalize($event->getThrowable());
            $event->setResponse(new JsonResponse($data, $event->getThrowable()->getStatusCode()));
        }
    }
}