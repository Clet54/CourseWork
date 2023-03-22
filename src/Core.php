<?php
    namespace Clet;

    use Exception;
    /**
     * The core application class
     */
    class Core extends Model\Main
    {
        /**
         * The single instance of the class.
         *
         * @var \Clet\Core|null
         */
        protected static ?Core $_instance = null;
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
         * Core class to string
         *
         * @return string
         */
        public function __toString()
        : string
        {
            return "<!doctype html>
<html lang='en-gb'>$this->head
  <body class='no-js {$this->posts->get_slug()}'>$this->header$this->posts{$this->generate_body_noscript_main()}$this->footer$this->foot
  </body>
</html>";
        }
        /**
         * Generate no script content
         *
         * @return string
         */
        public function generate_body_noscript_main()
        : string
        {
            return "
    <main class='no-script required-script'>
      <div class='px-4 py-5 my-5 text-center'>
        <img class='d-block mx-auto mb-4' src='{$this->get_post()->get_assets_url('images/favicons/f505307344.png')}' alt='Nigeria cooked food &#x2022; Home'>
        <h1 class='display-5 fw-bold text-danger'>Enable JavaScript</h1>
        <div class='col-lg-6 mx-auto'>
          <p class='lead mb-4'>Our site is build with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive
                               prebuilt components, and powerful JavaScript plugins.</p>
          <div class='d-grid gap-2 d-sm-flex justify-content-sm-center'>
            <a
                class='btn btn-outline-primary btn-lg px-4 gap-3'
                href='https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwiOp8bky9b9AhW7gf0HHbQ7ABcQwqsBegQICRAF&url=https%3A%2F%2Fwww.youtube.com%2Fwatch%3Fv%3DskQDwhL3TYY&usg=AOvVaw1LoToaS4FmIvYnGV7Z4w0g'
                target='_blank' role='button'
            >
              <i class='bi bi-youtube me-1'></i>Learn how<i class='bi bi-box-arrow-in-right ms-1'></i>
            </a>
            <a
                class='btn btn-outline-secondary btn-lg px-4'
                href='https://www.google.com/search?q=enable+javascript+in+your+browser&client=opera&hs=ElQ&sxsrf=AJOqlzUnw7zfBm4VkGca1VwPE72aHreuWA%3A1678631001762&ei=WeANZM6WLruD9u8PtPeAuAE&ved=0ahUKEwiOp8bky9b9AhW7gf0HHbQ7ABcQ4dUDCA4&uact=5&oq=enable+javascript+in+your+browser&gs_lcp=Cgxnd3Mtd2l6LXNlcnAQAzIECAAQQzIFCAAQgAQyBQgAEIAEMgUIABCABDIGCAAQFhAeMggIABAWEB4QDzIGCAAQFhAeMgYIABAWEB4yBggAEBYQHjIGCAAQFhAeOgoIABBHENYEELADSgQIQRgAUN0EWN0EYOoQaAFwAXgAgAG5AYgBuQGSAQMwLjGYAQCgAQHIAQjAAQE&sclient=gws-wiz-serp'
                role='button'
            >
              <i class='bi bi-google me-1'></i>Google how<i class='bi bi-box-arrow-in-right ms-1'></i>
            </a>
          </div>
        </div>
      </div>
    </main>";
        }
        /**
         * Main Extension Instance.
         * Ensures only one instance of the Queue is loaded or can be loaded.
         *
         * @return \Clet\Core
         * @uses \is_null()
         */
        public static function instance()
        : Core
        {
            return is_null(self::$_instance) ? self::$_instance = new self() : self::$_instance;
        }
        /**
         * @inheritDoc
         */
        public function __construct() { parent::__construct(); }
    }
