<?php

declare(strict_types=1);

namespace App\Service\Serializer;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DataUriNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;

final class CustomSerializer
{
    public $serializer;

    public function __construct()
    {
        $classMetadataFactory = new ClassMetadataFactory(
            new AnnotationLoader(
                new AnnotationReader()
            )
        );

        $this->serializer = new Serializer(
            [
                new ArrayDenormalizer(),
                new DateTimeNormalizer(),
                new DataUriNormalizer(),
                new ObjectNormalizer(
                    $classMetadataFactory,
                    null,
                    null,
                    new PhpDocExtractor()
                ),
                new PropertyNormalizer(),
            ],
            [
                new JsonEncoder(),
            ]
        );
    }

    public function serialize($data): string
    {
        return $this->serializer->serialize($data, JsonEncoder::FORMAT, [
            ObjectNormalizer::SKIP_NULL_VALUES => true,
            ObjectNormalizer::PRESERVE_EMPTY_OBJECTS => true,
        ]);
    }

    public function deserialize(string $data, string $type)
    {
        return $this->serializer->deserialize($data, $type, JsonEncoder::FORMAT);
    }
}
