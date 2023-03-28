<?php
    namespace Clet\Model;

    use Clet\Abstracts\View;
    use Clet\Utilities\Utility as Util;
    /**
     * The footer class
     */
    class Footer extends View
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
            $home        = $about = $contact = '';
            $posts       = !empty($post) ? $post : $this->get_post();
            $home_url    = Util::get_site_url();
            $about_url   = Util::get_site_url('/about');
            $contact_url = Util::get_site_url('/contact');
            /** The switch to activate menuitem */
            switch ($post->get_slug())
            {
                case 'about':
                    $about = ' active';
                    break;
                case 'contact':
                    $contact = ' active';
                    break;
                case 'home':
                    $home = ' active';
                    break;
            }

            return "
    <footer class='container-fluid border-top py-3 mt-4 {$posts->get_slug()}'>
      <div class='d-flex flex-wrap justify-content-between align-items-center'>
        <p class='col-md-4 mb-0 text-muted'>&COPY; 2023 Cletus Chigozie Opara</p>

        <a href='$home_url' class='col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none'>
        <img class='bi me-2' src='{$posts->get_assets_url('images/favicons/2023.jpeg')}' width='40' height='32'  alt='Logo'/>
      </a>

        <ul class='nav col-md-4 justify-content-end text-capitalize'>
          <li class='nav-item'><a href='$home_url' class='nav-link px-2 text-muted$home'>Home</a></li>
          <li class='nav-item'><a href='$about_url' class='nav-link px-2 text-muted$about'>About</a></li>
          <li class='nav-item'><a href='$contact_url' class='nav-link px-2 text-muted$contact'>contact</a></li>
        </ul>
      </div>
    </footer>
";
        }
    }
