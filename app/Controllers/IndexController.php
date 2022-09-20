<?php
namespace app\Controllers;

use app\Models\CsvModel;

/**
 *
 * @author arleen
 *
 */
class IndexController
{

    /**
     *
     * @var \app\Libraries\CsvHandler
     */
    private $fileHandler = null;

    /**
     *
     * @var \app\Libraries\Template();
     */
    private $view = null;

    /**
     * tmp directory
     *
     * @var string
     */
    const TMP_PATH = "/public/tmp/";

    private $mode = null;

    /**
     * constructor
     */
    public function __construct()
    {
//         $this->view = new \app\Libraries\Template();
    }


    function init() {
        //$this->fileHandler = new \app\Libraries\CsvHandler($this->getCsvFile('pod-data.csv'));
        $this->view = new \app\Libraries\Template();
    }
    /**
     * Main method
     */
    public function index()
    {
        $this->model= new CsvModel('pod-data.csv');

        $this->view = new \app\Libraries\Template();
          
        $table = $this->view->render('Index/table.php', [
            'header' => $this->model->getHeader(),
            'rs' => $this->model->getData()
        ], true);

        $this->view->render('Index/index.php', [
            'table' => $table
        ]);
    }

    /**
     * Load csv data
     */
    function loadData()
    {
        //$reqs = $_REQUEST;

       // if (empty($reqs)) {
            //echo 'hello';
            //echo json_encode($this->fileHandler->buildData());
       // }
        $this->init();
        echo json_encode($this->fileHandler->buildData());
    }

    /**
     * entry point
     */
    public function run()
    {
        $this->index();
    }

    public function search()
    {
        echo 'search';
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

    /**
     * Check is OS is windows or other
     *
     * @return boolean
     */
    private function isWindows()
    {
        return (strpos(strtolower(php_uname()), 'windows') !== false) ? true : false;
    }

    /**
     * Get args from datatable
     *
     * @param array $reqs
     */
    private function getReqsFromDataTable(array $reqs)
    {
        $colIndex = null;
        $orderCol = null;
        $sortOrder = null;

        if (! empty($reqs['order'][0]['column'])) {
            $colIndex = $reqs['order'][0]['column'];
            $sortOrder = $reqs['order'][0]['dir'];
            $orderCol = $reqs['columns'][$colIndex]['data'];
        }

        $searchStr = $reqs['search']['value'];
        $length = $reqs['length'];
        $start = $reqs['start'];

        return [
            'searchStr' => $searchStr,
            'length' => $length,
            'start' => $start,
            'sortOrder' => $sortOrder,
            'orderCol' => $orderCol
        ];
    }


}


