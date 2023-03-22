<?php
    namespace Clet\Abstracts;

    use Clet\Model\Posts;
    use Clet\Interfaces\Views;
    use Clet\Model\Primitive\Base;
    /**
     * The view class to reduce the get posts
     */
    abstract class View extends Base implements Views
    {
        /**
         * @inheritDoc
         */
        public function get_post()
        : Posts
        {
            return (!isset($this->posts) or !$this->posts) ? Posts::instance() : $this->posts;
        }
    }
