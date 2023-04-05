<?php

namespace App\Normalizer;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ExceptionNormalizer implements NormalizerInterface
{
    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof \Throwable;
    }

    /** @var HttpException $exception */
    public function normalize($exception, string $format = null, array $context = []): array
    {
        return $this->getData($exception);
    }

    private function getData(\Throwable $exception): array
    {
        return [
            'message' =>$exception->getMessage(),
            'code' => $exception->getCode(),
            'previous' => $exception->getPrevious() ? $this->getData($exception->getPrevious()) : null,
        ];
    }
}