<?php

declare(strict_types=1);

namespace Siarko\Deployment\Installer\Persistence;

use Siarko\Files\Api\DirectoryInterface;
use Siarko\Files\Api\Persistence\FilePersistenceInterface;
use Siarko\Files\FileFactory;

class PublicFilesPersistenceManager
{

    /**
     * @param FilePersistenceInterface $filePersistence
     * @param FileFactory $fileFactory
     * @param DirectoryInterface $pubDirectory
     */
    public function __construct(
        private readonly FilePersistenceInterface $filePersistence,
        private readonly FileFactory $fileFactory,
        private readonly DirectoryInterface $pubDirectory
    )
    {
    }

    /**
     * @param string $sourcePath
     * @return void
     */
    public function copyPublicFile(string $sourcePath): void
    {
        $file = $this->fileFactory->create();
        $file->setPath($sourcePath);

        $this->filePersistence->copy($file, $this->pubDirectory);
    }

}