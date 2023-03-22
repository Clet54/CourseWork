<?php
    namespace Clet\Model;

    use Clet\Abstracts\View;
    use Clet\Utilities\Utility as Util;
    /**
     * Header class
     */
    class Header extends View
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
            $home        = $about = $source = $sources = $recipes = $contact = $guess = $signup = $login = '';
            $posts       = !empty($post) ? $post : $this->get_post();
            $slug        = $posts->get_slug();
            $home_url    = Util::get_site_url();
            $about_url   = Util::get_site_url('/about');
            $contact_url = Util::get_site_url('/contact');
            $sources_url = Util::get_site_url('/source');
            $recipes_url = Util::get_site_url('/source/recipes');
            $login_url   = Util::get_site_url('/login');
            $signup_url  = Util::get_site_url('/registration');
            /** The switch to activate menuitem */
            switch ($post->get_slug())
            {
                case 'about':
                    $about = ' active';
                    break;
                case 'contact':
                    $contact = ' active';
                    break;
                case 'source':
                    $source = $sources = ' active';
                    break;
                case 'recipes':
                    $source = $recipes = ' active';
                    break;
                case 'signup':
                case 'registration':
                    $guess = $signup = ' active';
                    break;
                case 'login':
                    $guess = $login = ' active';
                    break;
                default:
                    $home = ' active';
                    break;
            }

            return "
    <header class='container-xxl sticky-top mb-3 pb-1 $slug'>
      <div class='navbar navbar-expand-md bd-navbar $slug'>
        <nav class='container-lg bd-gutter flex-wrap flex-lg-nowrap' aria-label='Main navigation'>
          <a class='navbar-brand' href='$home_url'> <img class='d-inline-block align-text-bottom' src='{$posts->get_assets_url('images/favicons/f505307344.png')}' alt='Logo' />
            {$posts->get_brand()}</a>
          <button
              class='navbar-toggler'
              type='button'
              data-bs-toggle='collapse'
              data-bs-target='#navbarSupportedContent'
              aria-controls='navbarSupportedContent'
              aria-expanded='false'
              aria-label='Toggle navigation'
          >
            <span class='navbar-toggler-icon'></span>
          </button>
          <div class='collapse navbar-collapse pt-3' id='navbarSupportedContent'>
            <ul class='navbar-nav ms-auto'>
              <li class='nav-item'>
                <a class='nav-link$home' aria-current='page' href='$home_url'><i class='fs-3 bi bi-house'></i>Home</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link$about' href='$about_url'><i class='fs-3 bi bi-info-square'></i>about us</a>
              </li>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle$source' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'><i class='fs-3 bi bi-collection'></i>food source</a>
                <ul class='dropdown-menu border-top-0 rounded-top-0'>
                  <li><a class='dropdown-item$sources' href='$sources_url'><i class='fs-5 bi bi-stack'></i>sources</a></li>
                  <li><a class='dropdown-item$recipes' href='$recipes_url'><i class='fs-5 bi bi-file-text'></i>recipes<i class='fs-3 bi brightness-alt-low-fill'></i></a>
                  </li>
                </ul>
              </li>
              <li class='nav-item dropdown'>
                <a class='nav-link dropdown-toggle$guess' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false'><i class='fs-3 bi bi-person'></i>guess</a>
                <ul class='dropdown-menu border-top-0 rounded-top-0'>
                  <li><a class='dropdown-item$signup' href='$signup_url'><i class='fs-5 bi bi-pencil'></i>signup</a></li>
                  <li><a class='dropdown-item$login' href='$login_url'><i class='fs-5 bi bi-box-arrow-in-right'></i>login</a></li>
                  <li>
                    <hr class='dropdown-divider' />
                  </li>
                  <li><a class='dropdown-item$contact' href='$contact_url'><i class='fs-5 bi bi-pin-map'></i>contact us</a></li>
                </ul>
              </li>
              <li class='nav-item'>
                <a class='nav-link$contact' href='$contact_url'><i class='fs-3 bi bi-pin-map'></i>contact us</a>
              </li>
            </ul>
          </div>
        </nav>

      </div>
      <div class='container-lg'>
        <form class='d-flex ms-auto' role='search'>
          <div class='input-group mb-3'>
            <input type='search' class='form-control' placeholder='Search' aria-label='Carry out a search' aria-describedby='button-search'>
            <button class='btn btn-light' type='submit' id='button-search'>Go</button>
          </div>
        </form>
      </div>
    </header>";
        }
    }
