<?php
    namespace Clet\Model;

    use Clet\Views\About;
    use Clet\Views\Forgotten;
    /**
     * The main engine for the project
     */
    class Main
    {
        /**
         * @var \Clet\Views\Forgotten
         */
        public Forgotten $forgotten;
        /**
         * @var \Clet\Model\Head
         */
        public Head $head;
        /**
         * @var \Clet\Model\Header
         */
        public Header $header;
        /**
         * @var \Clet\Model\Foot
         */
        public Foot $foot;
        /**
         * @var \Clet\Model\Footer
         */
        public Footer $footer;
        /**
         * @var \Clet\Model\Posts
         */
        public Posts $posts;
        /**
         * @var \Clet\Model\Responses
         */
        public Responses $responses;
        /**
         * The class constructor
         */
        public function __construct()
        {
            $this->posts     = Posts::instance();
            $this->responses = new Responses(['posts' => $this->posts]);
            $this->head      = new Head(['posts' => $this->posts]);
            $this->foot      = new Foot(['posts' => $this->posts]);
            $this->footer    = new Footer(['posts' => $this->posts]);
            $this->header    = new Header(['posts' => $this->posts]);
            $this->forgotten = new Forgotten(['posts' => $this->posts]);
        }
        /**
         * We can handle our self
         *
         * @return string
         */
        public function __toString()
        : string
        {
            return __METHOD__;
        }
        /**
         * Post getter
         */
        public function get_post()
        : Posts
        {
            return !isset($this->posts) ? Posts::instance() : $this->posts;
        }
    }
