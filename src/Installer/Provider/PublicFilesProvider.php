<?php

declare(strict_types=1);

namespace Siarko\Deployment\Installer\Provider;

use Siarko\Files\Path\PathInfo;
use Siarko\Paths\Api\Provider\Pool\PathProviderPoolInterface;

class PublicFilesProvider
{

    public const PATH_PROVIDER_POOL_TYPE = 'public_files';

    /**
     * @param PathProviderPoolInterface $pathProviderPool
     * @param PathInfo $pathInfo
     */
    public function __construct(
        private readonly PathProviderPoolInterface $pathProviderPool,
        private readonly PathInfo $pathInfo
    )
    {
    }

    /**
     * @return array
     */
    public function getSourcePublicFiles(): array
    {
        $result = [];
        foreach ($this->pathProviderPool->getProviders(self::PATH_PROVIDER_POOL_TYPE) as $provider) {
            $pathInfo = $this->pathInfo->read($provider->getConstructedPath());
            $files = $pathInfo->readDirectoryFiles("/.*\.php$/");
            $result = array_merge($result, $files);
        }
        return $result;
    }
}