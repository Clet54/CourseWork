<?php
    namespace Clet\Model;

    use Clet\Interfaces\Response;
    use Clet\Model\Primitive\Base;
    /**
     * Form response class
     */
    class Responses extends Base implements Response
    {
        /**
         * @var \Clet\Model\Posts|null
         */
        protected ?Posts $posts = null;
        /**
         * Get the post
         */
        public function get_post()
        : Posts
        {
            return (!isset($this->posts) or !$this->posts) ? Posts::instance() : $this->posts;
        }
        /**
         * @inheritDoc
         */
        public function handle_responses()
        : bool
        {
            if (isset($_REQUEST['action']) && !empty($action = $_REQUEST['action']))
            {
                switch ($action)
                {
                    case 'forgotten':
                        if ($this->validate_forgotten()) $this->redirect($action);
                        break;
                    case 'login':
                        if ($this->validate_login()) $this->redirect($action);
                        break;
                    case 'contact':
                        if ($this->validate_contact()) $this->redirect($action);
                        break;
                    case 'registration':
                        if ($this->validate_registration()) $this->redirect($action);
                        break;
                }
            }

            return false;
        }
        /**
         * Redirects to the action
         *
         * @param mixed $action The form action to redirect to
         *
         * @return void
         */
        protected function redirect(mixed $action)
        : void
        {
            if (!empty($post = $this->get_post()))
            {
                $uri = match ($action)
                {
                    'forgotten' => $post::get_site_url('login'),
                    'login'     => $post::get_site_url('profile'),
                    default     => $post::get_site_url()
                };
                header("Location: $uri");
                exit;
            }
        }
        /**
         * Validate contact form
         *
         * @return bool
         */
        protected function validate_contact()
        : bool
        {
            global $names, $names_status, $email, $email_status, $massages, $massages_status, $mailed;
            extract($_REQUEST);
            $names_status    = $email_status = $massages_status = '';
            $valid           = !empty($names = trim($names));
            $names_status    = !$valid ? 'is-invalid' : 'is-valid';
            $valid           = !empty($massages = trim($massages));
            $massages_status = !$valid ? 'is-invalid' : 'is-valid';
            $mailed          = false;
            if (!preg_match('/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}\b/i', $email))
            {
                $email_status = 'is-invalid';
                $valid        = false;
            }
            if ($valid)
            {
                $file      = $this->get_post()::get_root_assets('/images/792.jpeg');
                $mime_type = mime_content_type($file);
                $encode    = base64_encode(file_get_contents($file));
                $src       = "data:$mime_type;base64,$encode";
                $html      = "
<!doctype html>
<html lang='en-gb'>
  <head>
    <meta charset='utf-8'>+
    <title>Thanks for contacting us</title>
    <link
        href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'
        integrity='sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD'
        crossorigin='anonymous'
        rel='stylesheet' 
    />
  </head>
  <body class='no-js home'>
  <div>file:$file</div>
  <div>mime_type:$mime_type</div>
  <div>encode:$encode</div>
  <div>src:$src</div>
    <h2 class='display-2 text-center'>Thank you <strong>$names</strong> for contacting us</h2>
    <p class='lead text-info mt-2'>Have a plate of this bellow:</p>
    <img class='rounded-4' src='$src' alt='Egusi soup' title='Egusi soup' width='280' height='250'>
  </body>
</html>";
                $title     = $this->posts->get_title();
                $subject   = 'Thanks for contacting us';
                $headers[] = 'MIME-Version: 1.0';
                $headers[] = 'Content-type: text/html; charset=iso-8859-1';
                $headers[] = "To: $names <$email>";
                $headers[] = "From: $title <dcodejava@gmail.com>";
                // Mailed
                $mailed = @mail($email, $subject, $html, implode("\r\n", $headers));
            }

            return false;
        }
        /**
         * Validate forgotten password form
         *
         * @return bool
         */
        protected function validate_forgotten()
        : bool
        {
            global $user, $user_status;
            extract($_REQUEST);
            $user_status = '';
            $valid       = !empty($user = trim($user)) && !(strlen($user) < 8 || strlen($user) > 24);
            $user_status = !$valid ? 'is-invalid' : 'is-valid';

            return $valid;
        }
        /**
         * Validate login form
         *
         * @return bool
         */
        protected function validate_login()
        : bool
        {
            global $user, $user_status, $password, $password_status, $visibility, $remember;
            extract($_REQUEST);
            $valid       = true;
            $user_status = $password_status = 'is-valid';
            $remember    = !empty($remember) ? ' checked' : '';
            $visibility  = !empty($visibility) ? ' checked' : '';
            if (empty($user = trim($user)) || strlen($user) < 8 || strlen($user) > 24)
            {
                $user_status = 'is-invalid';
                $valid       = false;
            }
            if (empty($password = trim($password)) || strlen($password) < 8 || strlen($password) > 24)
            {
                $password_status = 'is-invalid';
                $valid           = false;
            }
            if ($valid) $valid = $this->get_post()->login($user, $password);

            return $valid;
        }
        /**
         * Validate registration form
         *
         * @return bool
         */
        protected function validate_registration()
        : bool
        {
            global $names,  $names_status,  $username, $username_status, $email, $email_status, $confirm_email, $confirm_email_status, $password, $password_status, $confirm_password, $confirm_password_status;
            extract($_REQUEST);
            $valid           = true;
            $username_status = $email_status = $password_status = $confirm_email_status = 'is-valid';
            if (empty($names = trim($names)) || strlen($names) < 8 || strlen($names) > 72)
            {
                $names_status = 'is-invalid';
                $valid           = false;
            }
            if (empty($username = trim($username)) || strlen($username) < 8 || strlen($username) > 24)
            {
                $username_status = 'is-invalid';
                $valid           = false;
            }
            if (empty($password = trim($password)) || strlen($password) < 8 || strlen($password) > 24)
            {
                $password_status = 'is-invalid';
                $valid           = false;
            }
            if (!preg_match('/\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}\b/i', $email))
            {
                $email_status = 'is-invalid';
                $valid        = false;
            }
            if ($confirm_email !== $email || empty($confirm_email))
            {
                $confirm_email_status = 'is-invalid';
                $valid                = false;
            }
            if ($confirm_password !== $password || empty($confirm_password))
            {
                $confirm_password_status = 'is-invalid';
                $valid                   = false;
            }

            return $valid;
        }
        /**
         * @inheritDoc
         */
        public function __construct(object|array $defaults = []) { parent::__construct($defaults); }
    }
