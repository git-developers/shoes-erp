<?php

declare(strict_types=1);

namespace Bundle\ThemeBundle\Asset\Installer;

use Symfony\Component\Console\Output\OutputInterface;

interface OutputAwareInterface
{
    /**
     * @param OutputInterface $output
     */
    public function setOutput(OutputInterface $output): void;
}
