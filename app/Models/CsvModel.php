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
     * Constructor
     *
     * @param string $file
     */
    public function __construct($file)
    {
        $this->fileHandler = new CsvHandler($this->getCsvFile($file));
    }

    /**
     * Get CSV headers
     *
     * @return string|array
     */
    public function getHeader()
    {
        return $this->fileHandler->getHeader();
    }

    /**
     * Get CSV data
     */
    public function getData()
    {
        return $this->fileHandler->buildData();
    }
    
    public function search() {
        
    }

    /**
     *
     * @param unknown $file
     * @return string|mixed
     */
    private function getCsvFile($file)
    {
        return ($this->isWindows()) ? str_replace([
            '/'
        ], '\\', $this->getCsvFullPath($file)) : $this->getCsvFullPath($file);
    }

    /**
     *
     * @return string
     */
    private function getCsvFullPath($file)
    {
        return dirname(__DIR__, 2) . self::TMP_PATH . $file;
    }

    /**
     * Check if OS is Windows or others
     */
    private function isWindows()
    {
        return (strpos(strtolower(php_uname()), 'windows') !== false) ? true : false;
    }
}

