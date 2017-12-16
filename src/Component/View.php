<?php

namespace App\Component;

class View {

    private $path = ROOT . '/resources/views/';
    public function __construct()
    {
    }

    public function render($templateName, $data = [], $layoutName = 'layout/main') {
        $view = $this->_render($templateName, $data);
        $data['content'] = $view;
        return $this->_render($layoutName, $data);
    }

    protected function _render($templateName, $data = []) {
        try {
            ob_start();
            $this->protectedScope($this->path.$templateName.'.php', $data);
            $output = ob_get_clean();
        } catch(\Exception $e) { // PHP < 7
            ob_end_clean();
            throw $e;
        }
        return $output;
    }

    protected function protectedScope ($___templatePath, array $data) {
        extract($data);
        include $___templatePath;
    }
}