<?php

declare(strict_types=1);

namespace Siarko\Deployment\Installer;

use Siarko\Deployment\Api\InstallerInterface;
use Siarko\Deployment\Installer\Persistence\PublicFilesPersistenceManager;
use Siarko\Deployment\Installer\Provider\PublicFilesProvider;
use Symfony\Component\Console\Output\OutputInterface;

class PublicFiles implements InstallerInterface
{

    /**
     * @param PublicFilesProvider $publicFilesProvider
     * @param PublicFilesPersistenceManager $publicFilesPersistenceManager
     */
    public function __construct(
        private readonly PublicFilesProvider $publicFilesProvider,
        private readonly PublicFilesPersistenceManager $publicFilesPersistenceManager
    )
    {
    }

    /**
     * @param OutputInterface $output
     * @return ?int status
     */
    public function install(OutputInterface $output): ?int
    {
        $files = $this->publicFilesProvider->getSourcePublicFiles();
        foreach ($files as $file) {
            try{
                $this->publicFilesPersistenceManager->deployPublicFile($file);
                $output->writeln("<info>File deployed: ".$file." </info>");
            }catch (\Exception $e){
                $output->writeln("Error deploying file: ".$file);
                $output->writeln($e->getMessage());
            }
        }
        return 0;
    }
}