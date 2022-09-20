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
    {}

    /**
     * Main method
     */
    public function index()
    {
        $inputs = $_POST;

        $this->model = new CsvModel('pod-data.csv');
        $this->view = new \app\Libraries\Template();

        if (isset($inputs['search']) && ! empty(trim($inputs['search']))) {
            $keywords = strtolower($inputs['search']);
            $rs = $this->model->search($keywords);
        } else {
            $rs = $this->model->getData();
        }

        $table = $this->view->render('Index/table.php', [
            'header' => $this->model->getHeader(),
            'rs' => $rs
        ], true);

        $this->view->render('Index/index.php', [
            'table' => $table
        ]);
    }

    /**
     * entry point
     */
    public function run()
    {
        $this->index();
    }
}


