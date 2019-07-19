<?php

declare(strict_types=1);

namespace Component\Resource\Generator;

interface RandomnessGeneratorInterface
{
    /**
     * @param int $length
     *
     * @return string
     */
    public function generateUriSafeString(int $length): string;

    /**
     * @param int $length
     *
     * @return string
     */
    public function generateNumeric(int $length): string;

    /**
     * @param int $min
     * @param int $max
     *
     * @return int
     */
    public function generateInt(int $min, int $max): int;
}
