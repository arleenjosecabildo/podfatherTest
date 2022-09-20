<?php
namespace app\Libraries;

/**
 *
 * @author arleen
 *
 */
class Template
{

    /**
     * Default view path
     *
     * @var string
     */
    const VIEW_PATH = '/public/views/';

    /**
     * Data
     *
     * @var array
     */
    public $data = [];

    /**
     *
     * @var string Path to template file.
     */
    function render($template, $v_data, $return = false)
    {
        $template = $this->getTemplateDir(self::getDocRoot() . self::VIEW_PATH . $template);

        if (! is_file($template)) {
            throw new \RuntimeException('Template not found: ' . $template);
        }

        $result = function ($file, array $data = array()) {
            ob_start();
            extract($data, EXTR_SKIP);
            try {
                include $file;
            } catch (\Exception $e) {
                ob_end_clean();
                throw $e;
            }
            return ob_get_clean();
        };

        if (! $return) {
            echo $result($template, $v_data);
        } else {
            return $result($template, $v_data);
        }
    }

    /**
     *
     * @param string $template
     * @return mixed
     */
    function getTemplateDir($template)
    {
        if (strpos(strtolower(php_uname()), 'windows') !== false) {
            $template = str_replace([
                '/'
            ], '\\', $template);
        }
        return $template;
    }

    /**
     * Get Document Root
     *
     * @return string
     */
    static function getDocRoot()
    {
        return dirname(__DIR__, 2);
    }
}

