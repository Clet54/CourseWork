<?php
    namespace Clet\Utilities;

    class Post extends Utility
    {
        /** The single instance of the class. */
        protected static ?Post $_instance = null;
        /**
         * Get brand name
         *
         * @return string
         * @todo Get brand from database
         */
        public function get_brand()
        : string
        {
            return 'Nigeria cooked food';
        }
        /**
         * Get the current page url
         *
         * @return string
         */
        public function get_page_url()
        : string
        {
            return self::site_url();
        }
        /**
         * Generates the page content authors
         *
         * @return string
         * @todo Implement getting page authors from
         */
        public function get_post_authors()
        : string
        {
            return __METHOD__;
        }
        /**
         * Generates the page meta description
         *
         * @return string
         * @todo Implement getting page description from
         */
        public function get_post_description()
        : string
        {
            return __METHOD__;
        }
    }
