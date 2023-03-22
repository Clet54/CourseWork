<?php
    namespace Clet\Utilities;

    /**
     * Base utility class
     */
    class Utility
    {
        /**
         * Get local site assets
         *
         * @param string $path The asset path
         *
         * @return string
         */
        public static function get_assets_url(string $path)
        : string
        {
            return self::get_site_url("/assets/$path");
        }
        /**
         * Get the host
         *
         * @return string
         */
        public static function get_host()
        : string
        {
            return $_SERVER['HTTP_HOST'];
        }
        /**
         * Get the host url
         *
         * @return string
         * @uses \isset()
         * @uses \empty()
         */
        public static function get_host_url()
        : string
        {
            $protocol = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? 'https' : 'http';
            $host     = self::get_host();

            return "$protocol://$host/";
        }
        /**
         * Get web root directory and append a base folder if supplied.
         *
         * @param string $ds System directory separator for Windows uses both \ & /.
         *
         * @return string
         * @uses \preg_replace()
         * @uses \str_replace()
         */
        public static function get_root(string $ds = DIRECTORY_SEPARATOR)
        : string
        {
            return preg_replace('%[\\\\/]+%', $ds, (str_replace($_SERVER['SCRIPT_NAME'], '', $_SERVER['SCRIPT_FILENAME'])) . $ds);
        }
        /**
         * Get assets directory and append path if supplied.
         *
         * @param string $path The path to append to get rooted path
         * @param string $ds   System directory separator for Windows uses both \ & /.
         *
         * @return string
         * @uses \preg_replace()
         */
        public static function get_root_assets(string $path = '', string $ds = DIRECTORY_SEPARATOR)
        : string
        {
            return preg_replace('%[\\\\/]+%', $ds, self::get_root() . $ds . 'assets' . $ds . $path);
        }
        /**
         * Get the current page url
         *
         * @param string $path The path to append to this page
         *
         * @return string
         * @uses \preg_match()
         * @uses \preg_replace()
         */
        public static function get_site_url(string $path = '')
        : string
        {
            if (preg_match('%^[/\w]+$%', $path)) $path = "/$path";

            return self::get_host_url() . preg_replace('%^/%', '', preg_replace('%[/\\\\]+%', '/', $path));
        }
        /**
         * Get the current page url
         *
         * @param bool $include_query Return 'REQUEST_URI' as is, if true.
         *
         * @return string
         * @uses \filter_input()
         * @uses \parse_url()
         * @uses \preg_replace()
         */
        public static function site_url(bool $include_query = false)
        : string
        {
            $url = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $uri = $include_query ? $url : parse_url($url, PHP_URL_PATH);

            return self::get_host_url() . preg_replace('%^/%', '', $uri);
        }
    }
