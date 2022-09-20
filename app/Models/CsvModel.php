<?php
namespace app\Models;

use app\Libraries\CsvHandler;

/**
 *
 * @author arleen
 *
 */
class CsvModel
{

    private $fileHandler = null;

    /**
     * tmp directory
     *
     * @var string
     */
    const TMP_PATH = "/public/tmp/";

    /**
     */
    public function __construct($file)
    {
        $this->fileHandler = new CsvHandler($this->getCsvFile($file));
    }

    public function getHeader()
    {
        return $this->fileHandler->getHeader();
    }

    public function getData()
    {
        $this->fileHandler->buildData();
    }

    private function getCsvFile($file)
    {
        $fullPath = $this->getCsvPath() . $file;

        return ($this->isWindows()) ? str_replace([
            '/'
        ], '\\', $fullPath) : $fullPath;
    }

    /**
     *
     * @return string
     */
    private function getCsvPath()
    {
        return dirname(__DIR__, 2) . self::TMP_PATH;
    }

    private function isWindows()
    {
        return (strpos(strtolower(php_uname()), 'windows') !== false) ? true : false;
    }
}

