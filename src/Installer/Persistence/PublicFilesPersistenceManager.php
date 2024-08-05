<?php

declare(strict_types=1);

namespace Siarko\Deployment\Installer\Persistence;

use Siarko\Deployment\Installer\PhpProxyFileGenerator;
use Siarko\Files\Api\DirectoryInterface;
use Siarko\Files\Api\Persistence\FilePersistenceInterface;
use Siarko\Files\FileFactory;

class PublicFilesPersistenceManager
{

    /**
     * @param FilePersistenceInterface $filePersistence
     * @param FileFactory $fileFactory
     * @param DirectoryInterface $pubDirectory
     * @param PhpProxyFileGenerator $proxyFileGenerator
     */
    public function __construct(
        private readonly FilePersistenceInterface $filePersistence,
        private readonly FileFactory $fileFactory,
        private readonly DirectoryInterface $pubDirectory,
        private readonly PhpProxyFileGenerator $proxyFileGenerator
    )
    {
    }

    /**
     * @param string $sourcePath
     * @return void
     */
    public function deployPublicFile(string $sourcePath): void
    {
        $sourceFile = $this->fileFactory->create();
        $sourceFile->setPath($sourcePath);
        $proxyFile = $this->fileFactory->create();
        $proxyFile->setPath($this->pubDirectory->getFilePath($sourceFile->getPathInfo()->getBasename()));
        $proxyFile->setContent($this->proxyFileGenerator->generate($sourceFile));
        $this->filePersistence->write($proxyFile);
    }

}