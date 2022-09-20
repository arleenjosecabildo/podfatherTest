<?php
namespace tests\Models;

require_once '../../app/bootstrap.php';

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertEquals;
use app\Models\CsvModel;

/**
 *
 * @author arleen
 *
 */
class CsvModelTest extends TestCase
{

    /**
     * TMP dir
     *
     * @var string
     */
    const TMP_PATH = "/public/tmp/";

    /**
     * test file
     */
    private $file = 'pod-data.csv';

    function testGetHeader()
    {
        $expected = [
            "Customer",
            "Site",
            "Due By",
            "Completed At",
            "Job Type",
            "Late",
            "Flagged",
            "Number of Items"
        ];

        $object = new CsvModel($this->file);
        $actual = $object->getHeader();
        assertEquals($expected, $actual);
    }

    function testGetCsvFile()
    {
        $testFile = 'pod-data.csv';
        $object = new CsvModel($this->file);
        $reflector = new \ReflectionClass('app\Models\CsvModel');

        $method = $reflector->getMethod('getCsvFile');
        $method->setAccessible(true);
        $expected = $method->invoke($object, $this->file);
        $testFile = $method->invoke($object, $testFile);

        assertEquals($expected, $testFile);
    }
}

