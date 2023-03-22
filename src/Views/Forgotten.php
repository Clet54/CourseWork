<?php
    namespace Clet\Views;

    use Clet\Abstracts\View;
    use Clet\Model\Posts;
    /**
     * The forgotten password class
     */
    class Forgotten extends View
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
            global $user, $user_status;
            $posts = !empty($post) ? $post : $this->get_post();
            $slug  = $posts->get_slug();

            return "
    <main class='container-md text-capitalize $slug'>
      <h1 class='display-2 mb-4'>forgotten password?</h1>
      <div class='alert alert-info alert-dismissible fade show' role='alert'>
        <i class='bi bi-info-circle-fill fs-3 flex-shrink-0 me-2' role='img' aria-label='Info:'></i>You will be redirected to Login
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>
      <form class='row g-3 mb-5 needs-validation $slug' id='$slug' name='$slug' action='{$posts->get_page_url()}' novalidate>
        <input type='hidden' name='action' value='$slug'>
        <div class='form-floating mb-3'>
          <input class='form-control bd-color ps-1 rounded-0 bg-transparent $user_status' id='user' name='user' value='$user' minlength='8' maxlength='24' placeholder='Enter user ID' required />
          <label for='user'>user <span class='text-uppercase'>id</span> or email address</label>
           <div class='valid-feedback'>Looks good!</div>
           <div class='invalid-feedback'>User <span class='text-uppercase'>id</span> must be minimum of 8 and maximum or 24 text or a valid e-mail address!</div>
        </div>
        <div class='col-12 text-center'>
          <button class='btn bg-success-subtle text-capitalize rounded-0' type='submit'>reset password</button>
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
