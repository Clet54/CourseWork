<?php
    namespace Clet\Views;

    use Clet\Abstracts\View;
    use Clet\Model\Posts;
    /**
     * The registration form class
     */
    class Registration extends View
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
            global $name, $username, $email, $confirm_email, $password, $confirm_password, $name_status, $username_status, $email_status, $confirm_email_status, $password_status, $confirm_password_status;
            $posts = !empty($post) ? $post : $this->get_post();
            $slug  = $posts->get_slug();

            return "
    <main class='login container-md text-capitalize $slug'>
      <h1 class='display-2 mb-5 text-center'>$slug</h1>
      <form class='row g-3 mb-5 needs-validation $slug' action='{$posts::get_site_url('registration')}' id='$slug' name='$slug' novalidate>
        <input type='hidden' name='action' value='$slug'>
        <div class='row mb-3'>
          <label class='col-sm-3 col-form-label' for='name'>Name:</label>
          <div class='col-sm-9'>
            <input class='form-control $names_status' id='name' name='name' value='$name' placeholder='Example John' minlength='8' maxlength='72' required />
            <div class='valid-feedback'>Looks good!</div>
            <div class='invalid-feedback'>Username must be minimum of 8 and maximum or 24 text!</div>
          </div>
        </div>
        <div class='row mb-3'>
          <label class='col-sm-3 col-form-label' for='username'>Username:</label>
          <div class='col-sm-9'>
            <input class='form-control $username_status' id='username' name='username' value='$username' minlength='8' maxlength='24' required />
            <div class='valid-feedback'>Looks good!</div>
            <div class='invalid-feedback'>Username must be minimum of 8 and maximum or 24 text!</div>
          </div>
        </div>
        <div class='row mb-3'>
          <label class='col-sm-3 col-form-label' for='email'>email:</label>
          <div class='col-sm-9'>
            <input class='form-control $email_status' type='email' id='email' name='email' value='$email' required />
            <div class='valid-feedback'>Looks good!</div>
            <div class='invalid-feedback'>Invalid e-mail address!</div>
          </div>
        </div>
        <div class='row mb-3'>
          <label class='col-sm-3 col-form-label' for='confirm_email'>confirm email:</label>
          <div class='col-sm-9'>
            <input class='form-control $confirm_email_status' type='email' id='confirm_email' name='confirm_email' value='$confirm_email' required />
            <div class='valid-feedback'>Looks good!</div>
            <div class='invalid-feedback'>Confirmation e-mail mismatched!</div>
          </div>
        </div>
        <div class='row mb-3'>
          <label class='col-sm-3 col-form-label' for='password'>password:</label>
          <div class='col-sm-9'>
            <input class='form-control $password_status' type='password' id='password' name='password' value='$password' minlength='8' maxlength='16' required />
            <div class='valid-feedback'>Looks good!</div>
            <div class='invalid-feedback'>Password must be minimum of 8 and maximum of 16 charathers and may include punchations!</div>
          </div>
        </div>
        <div class='row mb-3'>
          <label class='col-sm-3 col-form-label' for='confirm_password'>confirm password:</label>
          <div class='col-sm-9'>
            <input class='form-control $confirm_password_status' type='password' id='confirm_password' name='confirm_password' value='$confirm_password' required />
            <div class='valid-feedback'>Looks good!</div>
            <div class='invalid-feedback'>
              Confirmation password mismatched!
            </div>
          </div>
        </div>
        <div class='col-12 text-center'>
          <button class='btn bg-secondary text-capitalize' type='submit'>sign up</button>
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
