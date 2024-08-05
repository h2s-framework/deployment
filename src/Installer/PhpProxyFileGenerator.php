<?php

declare(strict_types=1);

namespace Siarko\Deployment\Installer;

use Nette\PhpGenerator\PhpFile;
use Siarko\Files\Api\FileInterface;

class PhpProxyFileGenerator
{

    public const COMPOSER_AUTOLOAD_GLOBAL = '_composer_autoload_path';

    /**
     * @param FileInterface $sourceFile
     * @return string
     */
    public function generate(FileInterface $sourceFile): string
    {
        $file = new PhpFile();
        $file->setStrictTypes();
        $content = $file->__toString();
        $content .= $this->generateSetGlobal(
            self::COMPOSER_AUTOLOAD_GLOBAL,
            realpath($GLOBALS[self::COMPOSER_AUTOLOAD_GLOBAL])
            ).PHP_EOL;
        $content .= $this->generateInclude($sourceFile->getPath()).PHP_EOL;
        return $content;
    }

    /**
     * @param string $name
     * @param string $content
     * @return string
     */
    private function generateSetGlobal(string $name, string $content): string
    {
        return '$GLOBALS[\''.$name.'\'] = \''.$content.'\';';
    }

    /**
     * @param string $path
     * @return string
     */
    private function generateInclude(string $path): string
    {
        return 'include \''.$path.'\';';
    }
}