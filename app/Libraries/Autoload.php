<?php

/**
 * Include file
 * @author arleen
 *
 */
class Autoload
{

    /**
     * Namespace separator \
     *
     * @var string
     */
    const NAMESPACE_SEPARATOR = '\\';

    /**
     * php extension
     *
     * @var string
     */
    const PHP_EXTENSION = '.php';

    /**
     *
     * @param string $className
     * @return boolean
     */
    static public function loader($className)
    {
        $file = $_SERVER["DOCUMENT_ROOT"] . '/' . str_replace(self::NAMESPACE_SEPARATOR, '/', $className) . self::PHP_EXTENSION;
        if (! file_exists($file))
            return false;

        include $file;
    }
}
spl_autoload_register('Autoload::loader');