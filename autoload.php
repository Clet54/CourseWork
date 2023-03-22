<?php
    spl_autoload_register(function ($class)
    {
        /** Project specific namespace prefix */
        $prefix = 'Clet\\';
        /** Project base directory for the namespace */
        $base_dir = __DIR__ . '/src/';
        /** The length to test the for the namespace prefix */
        $length = strlen($prefix);
        /** Test class, if false, move to the next registered autoloader */
        if (strncmp($prefix, $class, $length) !== 0) return;
        /** Get the relative class name */
        $relative_class = substr($class, $length);
        /**
         * Replace namespace prefix with the base directory, replace namespace
         * separators with directory separators in the relative class name, append with PHP extension.
         *
         * If the file exists, require it
         *
         * @uses \is_readable()
         * @uses \str_replace()
         */
        if (is_readable($file = $base_dir . str_replace('\\', '/', $relative_class) . '.php')) require $file;
    });
