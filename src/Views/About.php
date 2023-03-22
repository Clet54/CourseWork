<?php
    namespace Clet\Views;

    use Clet\Abstracts\View;
    use Clet\Model\Posts;
    class About extends View
    {
        /**
         * @var \Clet\Model\Posts|null
         */
        public ?Posts $posts = null;
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
            $posts = !empty($post) ? $post : $this->get_post();

            return "
    <main class='container my-5'>
      <div class='row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg'>
        <div class='col-lg-7 p-3 p-lg-5 pt-lg-3'>
          <h3 class='display-6 fw-bold lh-1'>{$posts->get_title()}</h3>
          <p class='lead'>Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, 
          responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        </div>
        <div class='col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg'>
          <img class='rounded' src='{$posts::get_assets_url('/images/791.jpeg')}' alt='Jellof Rice' title='Nigeria Jellof Rice' width='720'>
        </div>
      </div>
    </main>
    ";
        }
        /**
         * @inheritDoc
         */
        public function __construct(object|array $defaults = []) { parent::__construct($defaults); }
    }
