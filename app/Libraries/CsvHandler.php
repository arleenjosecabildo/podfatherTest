<?php
namespace app\Libraries;

use app\Interfaces\FileHandler;

/**
 *
 * @author arleen
 *
 */
class CsvHandler extends \SplFileObject implements FileHandler
{

    /**
     *
     * @var array
     */
    private $headers = [];

    /**
     * csv line
     * @var unknown
     */
    private $line;

    /**
     *
     * @var array
     */
    private $rows = [];

    /**
     *
     * @var string
     */
    private $delimiter = ',';

    /**
     *
     * @var string
     */
    private $enclosure = '"';

    /**
     *
     * @var string
     */
    private $escape = '\\';

    /**
     *
     * @var unknown
     */
    private $header = null;

    /**
     *
     * @link http://www.php.net/manual/en/splfileobject.construct.php
     * @param mixed $file_name
     * @param mixed $open_mode
     *            [optional]
     * @param mixed $use_include_path
     *            [optional]
     * @param mixed $context
     *            [optional]
     */
    public function __construct($file_name, $open_mode = null, $use_include_path = null, $context = null)
    {
        parent::__construct($file_name, 'r', $use_include_path = null, $context = null);
        $this->setFlags(\SplFileObject::READ_CSV | \SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
        $this->setCsvControl($this->delimiter, $this->enclosure, $this->escape);
    }

    /**
     *
     * @param array $header
     * @return mixed
     */
    private function formatHeader(&$header = array())
    {
        return str_replace(' ', '_', $header);
    }

    /**
     *
     * {@inheritdoc}
     * @see \app\Interfaces\FileHandler::read()
     */
    public function read()
    {
        $line = [];
        $this->rewind();

        while ($this->eof() === false) {
            $this->next();
            $line[] = $this->current();
        }

        return $line;
    }

    /**
     * Get csv headers
     */
    public function buildHeader()
    {
        $this->seek(0);
        $this->header = $this->current();
    }

    /**
     * Combine header and line
     *
     * @return array[]
     */
    public function buildData()
    {
        $this->buildHeader();

        if (! empty($this->header) && $this->key() === 0) {
            $this->next();
        }

        $data = [];
        $header = $this->formatHeader($this->header);

        while ($this->eof() === false) {

            $line = $this->current();

            $data[] = array_combine($header, $line);

            $this->next();
        }

        return $data;
    }

    /**
     * return csv headers
     *
     * @return string|array
     */
    public function getHeader()
    {
        if (empty($this->header))
            $this->buildHeader();

        return $this->header;
    }
}

