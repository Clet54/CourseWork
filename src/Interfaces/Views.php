<?php
    namespace Clet\Interfaces;

    use Clet\Model\Posts;
    /**
     * Views interface to render page contents
     */
    interface Views
    {
        /**
         * Get the post to use for content rendering
         *
         * @return Posts
         */
        public function get_post()
        : Posts;
        /**
         * Render the content(s)
         *
         * @param Posts|null $post The post class the fetch the required database content(s).
         *
         * @return string
         */
        public function render(Posts $post = null)
        : string;
    }
