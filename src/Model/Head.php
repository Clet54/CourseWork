<?php
    namespace Clet\Model;

    use Clet\Abstracts\View;
    /**
     * The HTML document head tag
     */
    class Head extends View
    {
        /**
         * @var \Clet\Model\Posts|null
         */
        public ?Posts $posts = null;
        /**
         * @inheritDoc
         */
        public function __construct(array|object $defaults = []) { parent::__construct($defaults); }
        /**
         * We can handle our self
         *
         * @return string
         */
        public function __toString()
        : string
        {
            return $this->render($this->get_post());
        }
        /**
         * @inheritDoc
         */
        public function render(Posts $post = null)
        : string
        {
            return "
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta name='description' content='{$this->posts->get_post_description()}'>
    <meta name='author' content='{$this->posts->get_post_authors()}'>
    <meta name='generator' content='JetBrains PhpStorm 2022.3.2'>

    <title>{$this->posts->get_title()}</title>

    <link rel='canonical' href='{$this->get_post()->get_canonical_url()}'>

    <link
        href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'
        integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD'
        crossorigin='anonymous'
        rel='stylesheet' 
    />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css' />
    <link href='{$this->posts->get_assets_url('/css/core.css')}' rel='stylesheet' />
    <!-- Favicons -->
    <link rel='apple-touch-icon' href='{$this->posts->get_assets_url('images/favicons/f505307344.png')}' sizes='180x180'>
    <link rel='icon' href='{$this->posts->get_assets_url('images/favicons/f505307344.png')}' sizes='32x32' type='image/png'>
    <link rel='icon' href='{$this->posts->get_assets_url('images/favicons/f505307344.png')}' sizes='16x16' type='image/png'>
  </head>";
        }
    }
