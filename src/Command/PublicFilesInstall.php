<?php

declare(strict_types=1);

use Siarko\Deployment\Api\InstallerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PublicFilesInstall extends Command
{

    public function __construct(
        private readonly InstallerInterface $installer
    )
    {
        parent::__construct("Public Files Installer");
    }


    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName('deploy:public')
            ->setDescription("Deploy main application files to public directory");
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return $this->installer->install($output) ?? 0;
    }

}