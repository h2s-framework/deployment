<?php

declare(strict_types=1);

namespace H2S\Deployment\Installer;

use Siarko\Deployment\Api\InstallerInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublicFiles implements InstallerInterface
{

    public function __construct(

    )
    {
    }

    /**
     * @param OutputInterface $output
     * @return ?int status
     */
    public function install(OutputInterface $output): ?int
    {
        // TODO: Implement install() method.
    }
}