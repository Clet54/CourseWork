<?php
    namespace Clet\Views;

    use Clet\Abstracts\View;
    use Clet\Model\Posts;
    /**
     * The contact class
     */
    class Contact extends View
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
            global $names, $names_status, $email, $email_status, $massages, $massages_status, $mailed;
            $posts = !empty($post) ? $post : $this->get_post();
            $slug  = $posts->get_slug();
            $form  = "
          <form class='row g-3 mt-5 mb-5 needs-validation $slug' action='{$posts->get_page_url()}' id='$slug' name='$slug' novalidate>
            <input type='hidden' name='action' value='$slug'>
            <div class='col col-sm-12 col-md-6'>
            <div class='mb-3'>
              <label for='names' class='form-label'>Names</label>
              <input class='form-control $names_status' id='names' name='names' value='$names' placeholder='Names' required />
              <div class='valid-feedback'>Looks good!</div>
              <div class='invalid-feedback'>Please give us your names!</div>
            </div>
            </div>
            <div class='col col-sm-12 col-md-6'>
            <div class='mb-3'>
              <label for='email' class='form-label'>Email address</label>
              <input type='email' class='form-control $email_status' id='email' name='email' value='$email' placeholder='email@domain.com' aria-required='true' required />
              <div class='valid-feedback'>Looks good!</div>
              <div class='invalid-feedback'>Invalid email address!</div>
            </div>
            </div>
            <div class='mb-3'>
              <label for='massages' class='form-label'>Message area</label>
              <textarea class='form-control $massages_status' id='massages' name='massages' placeholder='Write us and we will get back to you' rows='3' aria-required='true' required>$massages</textarea>
              <div class='valid-feedback'>Looks good!</div>
              <div class='invalid-feedback'>Enter your massages!</div>
            </div>
            <div class='col-12 text-end'>
              <button class='btn btn-success text-capitalize' type='submit'>contact us</button>
            </div>
          </form>";
            $mail  = "
          <p class='lead'>Thank you <strong>$names</strong> for contacting us, you will recieve a mail from us</p>
          <div class='d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3'>
            <a class='btn btn-outline-primary btn-lg px-4 me-md-2 fw-bold' href='{$posts::get_site_url()}' role='button'><i class='fs-3 bi bi-house me-1'></i>Go Home</a>
            <a class='btn btn-outline-secondary btn-lg px-4' href='{$posts::get_site_url('/about')}' role='button'>Learn more<i class='fs-3 bi bi-chevron-right ms-1'></i></a>
          </div>";
            $html  = $mailed ? $mail : $form;

            return "
    <main class='container my-5'>
      <div class='row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg'>
        <div class='col-lg-7 p-3 p-lg-5 pt-lg-3'>
          <h3 class='display-6 fw-bold lh-1'>{$posts->get_title()}</h3>$html
        </div>
        <div class='col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg'>
          <img class='rounded' src='{$posts::get_assets_url('/images/792.jpeg')}' alt='Naija Jellof Rice' title='Nigeria Jellof Rice' width='720'>
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
