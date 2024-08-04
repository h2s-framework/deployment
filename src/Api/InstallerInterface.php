<?php

namespace Siarko\Deployment\Api;

use Symfony\Component\Console\Output\OutputInterface;

interface InstallerInterface
{

    /**
     * @param OutputInterface $output
     * @return ?int status
     */
    public function install(OutputInterface $output): ?int;
}