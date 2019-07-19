<?php

declare(strict_types=1);

namespace Component\Image\Repository;

use Component\Image\Model\ImageInterface;
use Component\Core\Repository\RepositoryInterface;

interface ImageRepositoryInterface extends RepositoryInterface
{

//    /**
//     * @return array
//     */
//    public function gatazo(): array;

    public function find($id);
    public function findAll(): array;

    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|ImageInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array|ImageInterface[]
     */
    public function findByNamePart(string $phrase, string $locale): array;
}
