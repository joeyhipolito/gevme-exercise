<?php
// autoload multiple classes from multiple directories
if (!function_exists('doorche_autoload')) {
    function doorche_autoload($class) {
        // List all directories
        $paths = array(
            SYSPATH,
            ROOT . 'libs',
            ROOT . 'helpers',
            ROOT . 'services',
            APPPATH . 'models',
            APPPATH . 'dao'
        );
        foreach ($paths as $path) {
            $file = $path . DS . $class . EXT;
            if (is_file($file)) {
                include $file;
            }
        }
    }
}
spl_autoload_register('doorche_autoload');