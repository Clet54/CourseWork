<?php
    namespace Clet\Model;

    use Clet\Interfaces\Views;
    use Clet\Utilities\Post;
    use Clet\Views\About;
    use Clet\Views\Contact;
    use Clet\Views\Forgotten;
    use Clet\Views\Home;
    use Clet\Views\Login;
    use Clet\Views\Recipes;
    use Clet\Views\Registration;
    use Clet\Views\Sources;
    use Exception;
    /**
     * The post class manages the site contents
     */
    class Posts extends Post implements Views
    {
        /** The single instance of the class. */
        protected static Post|null $_instance = null;
        /**
         * Prevent cloning of a *Singleton* instance
         *
         * @return void
         * @throws Exception
         */
        public function __clone()
        {
            throw new Exception('Do not clone a singleton instance.');
        }
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
         * Prevent unserializing of a *Singleton* instance.
         *
         * @return void
         * @throws Exception
         */
        public function __wakeup()
        {
            throw new Exception('Do not unserialize a singleton instance.');
        }
        /**
         * Get the canonical url
         *
         * @return string
         */
        public function get_canonical_url()
        : string
        {
            return self::site_url();
        }
        /**
         * Get brand name
         *
         * @return string
         */
        public function get_brand()
        : string
        {
            return 'Nigeria cooked food';
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
        /**
         * Get page slugs to load appropriate page post
         *
         * @return string
         */
        public function get_slug()
        : string
        {
            if (empty($slug = '') && !empty($paths = explode('/', self::get_page_url())))
            {
                if (empty($slug = array_pop($paths)) || !preg_match('/\A\w+\z/', $slug)) $slug = array_pop($paths);
            }

            return empty($slug) || $slug === self::get_host() ? 'home' : $slug;
        }
        /**
         * Gets the page title
         *
         * @return string
         */
        public function get_title()
        : string
        {
            return 'Nigeria cooked food &#x2022; ' . match ($this->get_slug())
                {
                    'login'                    => 'Login your credentials',
                    'recipe', 'recipes'        => 'Food recipes',
                    'register', 'registration' => 'Signup',
                    'about', 'about_us'        => 'About us',
                    'source', 'sources'        => 'Food sources',
                    'contact', 'contact_us'    => 'Contact us',
                    default                    => 'Home'
                };
        }
        /**
         * Main Extension Instance.
         * Ensures only one instance of the Queue is loaded or can be loaded.
         *
         * @return Posts|null
         * @uses \is_null()
         */
        public static function instance()
        : ?Posts
        {
            return is_null(self::$_instance) ? self::$_instance = new self() : null;
        }
        /**
         * The verification of user credentials
         *
         * @param string $user     The user ID
         * @param string $password The user password
         *
         * @return bool
         * @todo Login from database
         */
        public function login(string $user, string $password)
        : bool
        {
            return $user === $password;
        }
        /**
         * @inheritDoc
         */
        public function get_post()
        : Posts
        {
            return $this;
        }
        /**
         * @inheritDoc
         */
        public function render(Posts $post = null)
        : string
        {
            $posts = !empty($post) ? $post : $this->get_post();
            $_post = ['posts' => $posts];

            return match ($this->get_slug())
            {
                'home'              => new Home($_post),
                'about'             => new About($_post),
                'contact'           => new Contact($_post),
                'login'             => new Login($_post),
                'recipes'           => new Recipes($_post),
                'source', 'sources' => new Sources($_post),
                'registration'      => new Registration($_post),
                'forgotten'         => new Forgotten($_post),
                default             => "
    <main class='container my-5'>
      <div class='row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg'>
        <div class='col-lg-7 p-3 p-lg-5 pt-lg-3'>
          <h1 class='display-4 fw-bold lh-1'>4<span class='text-white'>0</span>4 Your request is not found</h1>
          <p class='lead'>Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, 
          responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
          <div class='d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3'>
            <a class='btn btn-outline-primary btn-lg px-4 me-md-2 fw-bold' href='{$posts::get_site_url()}' role='button'><i class='fs-3 bi bi-house me-1'></i>Go Home</a>
            <a class='btn btn-outline-secondary btn-lg px-4' href='{$posts::get_site_url('/about')}' role='button'>Learn more<i class='fs-3 bi bi-chevron-right ms-1'></i></a>
          </div>
        </div>
        <div class='col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg'>
          <img class='rounded' src='{$posts::get_assets_url('/images/789.jpeg')}' alt='Jellof Rice' title='Nigeria Jellof Rice' width='720'>
        </div>
      </div>
    </main>",
            };
        }
    }
