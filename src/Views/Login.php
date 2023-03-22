<?php
    namespace Clet\Views;

    use Clet\Abstracts\View;
    use Clet\Model\Posts;
    /**
     * The login form class
     */
    class Login extends View
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
            global $user, $password, $visibility, $remember;
            $posts = !empty($post) ? $post : $this->get_post();
            $slug  = $posts->get_slug();

            return "
    <main class='container-md text-capitalize $slug'>
      <h1 class='display-2 mb-4'>sign in</h1>
      <form class='row g-3 mb-5 needs-validation $slug' action='{$posts->get_page_url()}' id='$slug' name='$slug' novalidate>
        <input type='hidden' name='action' value='$slug'>
        <div class='form-floating mb-3'>
          <input class='form-control bd-color ps-1 rounded-0 bg-transparent' id='user' name='user' value='$user' minlength='8' maxlength='24' placeholder='Enter user ID' required />
          <label for='user'>user <span class='text-uppercase'>id</span></label>
           <div class='valid-feedback'>Looks good!</div>
           <div class='invalid-feedback'>User <span class='text-uppercase'>id</span> must be minimum of 8 and maximum or 24 text!</div>
        </div>
        <div class='form-floating'>
          <input type='password' class='form-control bd-color ps-1 rounded-0 bg-transparent' id='password' name='password' value='$password' minlength='8' maxlength='16' placeholder='Enter Password' required />
          <label for='password'>Password</label>
           <div class='valid-feedback'>Looks good!</div>
           <div class='invalid-feedback'>Password must be minimum of 8 and maximum of 16 charathers and may include punchations!</div>
        </div>
        <div class='col-6'>
          <div class='form-check'>
            <input class='form-check-input' type='checkbox' id='visibility' name='visibility' aria-describedby='visibilityFeedback' $visibility />
            <label class='form-check-label' id='visibilityFeedback' for='visibility'> Show password</label>
          </div>
          <div class='form-check'>
            <input class='form-check-input' type='checkbox' id='remember' name='remember' aria-describedby='rememberFeedback' $remember />
            <label class='form-check-label' id='rememberFeedback' for='remember'> Keep me login</label>
          </div>
        </div>
        <div class='col-6 text-end'>
          <a class='btn btn-link' href='{$posts::get_site_url('login/forgotten')}' role='button'>Forgotten password?</a>
        </div>
        <div class='col-12 text-center'>
          <button class='btn bg-success-subtle w-100 text-capitalize rounded-0' type='submit'>sign in</button>
        </div>
        <div class='mt-0 py-3 position-relative text-center'>
          <span class='d-inline-block px-1 new z-3'>New Account</span>
          <hr class='horizontal-divider position-absolute z-n1' />
        </div>
        <div class='col-12 text-center mt-0'>
          <a class='btn bg-success-subtle w-100 text-capitalize rounded-0' href='{$posts::get_site_url('registration')}' role='button'>Create new account</a>
        </div>
      </form>
    </main>
    ";
        }
        /**
         * @inheritDoc
         */
        public function __construct(object|array $defaults = []) { parent::__construct($defaults); }
    }
