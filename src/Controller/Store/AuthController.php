<?php

namespace App\Controller\Store;

use App\API\Customers;
use App\Infrastructure\FileHandler;
use App\Infrastructure\Mailing;
use App\Infrastructure\Responses;
use App\Infrastructure\StringHelper;
use PHPMailer\PHPMailer\Exception;
use Random\RandomException;

class AuthController extends HomeController
{

    /**
     * @var float|int
     */
    public $session_expiry;

    public function __construct()
    {
        parent::__construct();
        $current_time = time();
        $this->session_expiry = $current_time + (30 * 24 * 60 * 60);
    }

    public function register(): void
    {
        require $this->views . 'auth/register.php';
        die();
    }

    /**
     * @throws RandomException
     */
    public function doRegister(): void
    {
        $this->customerAPI = new Customers();
        if (!isset($_POST['agree_terms'])) {
            die(Responses::alertResponseUI('Agree to terms and conditions.', 'danger'));
        }
        unset($_POST['agree_terms']);
        $first_name = StringHelper::sanitize_text_field($_POST['first_name'] ?? '');
        $last_name = StringHelper::sanitize_text_field($_POST['last_name'] ?? '');
        $email = StringHelper::sanitize_email($_POST['email'] ?? '');
        $phone = StringHelper::sanitize_phone_number($_POST['phone'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
            die(Responses::alertResponseUI('Error occurred while registering! Missing required field', 'danger'));
        }
        if (!StringHelper::is_email($email)) {
            die(Responses::alertResponseUI('Invalid email address format!', 'danger'));
        }
        if (!preg_match('/^[0-9\-+\s]{7,15}$/', $phone)) {
            die(Responses::alertResponseUI('Invalid phone number format!', 'danger'));
        }
        if ($password !== $confirm_password) {
            die(Responses::alertResponseUI('Passwords do not match!', 'danger'));
        }
        if (!empty($password) && strlen($password) < 8) {
            die(Responses::alertResponseUI('Password must be at least 8 characters long!', 'danger'));
        }
        unset($_POST['confirm_password']);
        $_POST['password'] = password_hash($password, PASSWORD_DEFAULT);
        $_POST['customer_name'] = trim($first_name . ' ' . $last_name);
        $result = $this->customerAPI->createCustomer($_POST);
        if ($result['response'] !== '200') {
            die(Responses::alertResponseUI('Error occurred: ' . $result['message'], 'danger'));
        }
        echo Responses::alertResponseUI('Registration successful!', 'success');
        try {
            $this->register_notification(
                [
                    'firstname' => $first_name,
                    'lastname' => $last_name,
                    'name' => trim($first_name . ' ' . $last_name),
                    'email_address' => $email,
                    'host_url' => URL,
                    'support_email' => SUPPORT_EMAIL,
                    'site_name' => $this->site_name,
                ]
            );
        } catch (\JsonException|Exception $e) {

        }
        die('<script>openRegisterSuccess("' . base64_encode($email) . '");</script>');
    }

    public function register_success(): void
    {
        if (!empty($_GET['email'])) {
            $email = base64_decode($_GET['email']);
        }
        require $this->views . 'auth/register-success.php';
        die();
    }

    public function login(): void
    {
        require $this->views . 'auth/login.php';
        die();
    }

    /**
     * @throws RandomException
     * @throws \JsonException
     */
    public function doLogin(): void
    {
        $email = StringHelper::sanitize_email($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        if (empty($email) || empty($password)) {
            die(Responses::alertResponseUI('Please enter both username and password.', 'danger'));
        }
        $this->customerAPI = new Customers();
        $getCustomer = $this->customerAPI->getCustomer(['email' => $email]);
        if (empty($getCustomer)) {
            die(Responses::alertResponseUI('Invalid email or password !', 'danger'));
        }
        if (!password_verify($password, $getCustomer[0]['password'])) {
            die(Responses::alertResponseUI('Invalid email or password !', 'danger'));
        }
        $params = [
            'last_login' => $this->current_timestamp,
            'login_status' => 1,
            'pkField' => 'id',
            'pk' => $getCustomer[0]['id'],
        ];
        @$this->customerAPI->updateCustomer($params);
        $param = [
            'id' => $getCustomer[0]['id'],
            'customer_id' => $getCustomer[0]['customer_id'],
            'customer_name' => $getCustomer[0]['customer_name'],
            'email' => $getCustomer[0]['email'],
            'phone' => $getCustomer[0]['phone'],
            'address' => $getCustomer[0]['address'],
        ];
        $params = json_encode($param, JSON_THROW_ON_ERROR);
        setcookie($this->auth_session, $params, $this->session_expiry, BASE_PATH);
        if (empty($_POST['redirection'])) {
            $this->replace(BASE_PATH);
        } else {
            $this->replace($_POST['redirection']);
        }
    }

    public function logout()
    {

    }

    public function forgot_password(): void
    {
        require $this->views . 'auth/forgot-password.php';
        die();
    }

    /**
     * @throws RandomException
     * @throws \JsonException
     * @throws Exception
     */
    public function doForgotPassword(): void
    {
        $email = StringHelper::sanitize_email($_POST['email'] ?? '');
        if (empty($email)) {
            die(Responses::alertResponseUI('Enter a valid email address!', 'danger'));
        }
        if (!StringHelper::is_email($email)) {
            die(Responses::alertResponseUI('Invalid email address format!', 'danger'));
        }
        $this->customerAPI = new Customers();
        $getCustomer = $this->customerAPI->getCustomer(['email' => $email]);
        if (empty($getCustomer)) {
            die(Responses::alertResponseUI('This email does not exist!', 'danger'));
        }
        $update = [
            'pass_flag' => 1,
            'pkField' => 'id',
            'pk' => $getCustomer[0]['id']
        ];
        $result = $this->customerAPI->updateCustomer($update);
        if ($result['response'] !== '200') {
            die(Responses::alertResponseUI('Error occurred: ' . $result['message'], 'danger'));
        }
        echo '<script>$("#forgot-password")[0].reset();</script>';
        $this->password_notification([
            'fullname' => trim($getCustomer[0]['first_name'] . ' ' . $getCustomer[0]['last_name']),
            'email_address' => $email,
            'host_url' => URL,
            'support_email' => SUPPORT_EMAIL,
            'site_name' => $this->site_name,
        ]);
        echo Responses::alertResponseUI('An email has been sent to your registered email address!', 'success');
    }

    /**
     * @throws \JsonException
     * @throws RandomException
     */
    public function password_reset($email): void
    {
        if (empty($email)) {
            $this->replace(BASE_PATH);
        }
        $params = json_decode(base64_decode($email), true, 512, JSON_THROW_ON_ERROR);
        $this->customerAPI = new Customers();
        $params['pass_flag'] = 1;
        $getCustomer = $this->customerAPI->getCustomer($params);
        if (empty($getCustomer)) {
            $this->page_title = "Invalid Reset Link | " . $this->site_name;
            require $this->views . 'pages/password-error.php';
            die();
        }
        $this->page_title = "Password Reset | " . $this->site_name;
        $auth_id = base64_encode(json_encode(['id' => $getCustomer[0]['id']], JSON_THROW_ON_ERROR));
        require $this->views . 'pages/password-reset.php';
        die();
    }

    /**
     * @throws \JsonException
     */
    public function change_password(): void
    {
        $_POST['auth_token'] = json_decode(base64_decode($_POST['auth_token']), true, 512, JSON_THROW_ON_ERROR);
        if ($_POST['new_password'] !== $_POST['confirm_password']) {
            die(Responses::alertResponseUI('Passwords do not match!', 'danger'));
        }
        $hashed_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $params = [
            'pass_flag' => 0,
            'password' => $hashed_password,
            'pkField' => 'id',
            'pk' => $_POST['auth_token']['id']
        ];
        $this->customerAPI = new Customers();
        $updateCustomer = $this->customerAPI->updateCustomer($params);
        if ($updateCustomer['response'] !== '200') {
            die(Responses::alertResponseUI('Error occurred: ' . $updateCustomer['message'], 'danger'));
        }
        echo Responses::alertResponseUI('Password reset successful! Redirecting...', 'success');
        $this->replace(BASE_PATH);
    }


    /**
     * @throws Exception
     * @throws \JsonException
     */
    public function register_notification($params = []): void
    {
        if (!empty($params)) {
            $fileHandler = new FileHandler();
            $mailController = new Mailing();
            $params['activation_link'] = URL . 'activation/' . base64_encode(json_encode(['email' => $params['email_address']], JSON_THROW_ON_ERROR));
            $params['logo_url'] = URL . 'assets/images/logo.png';
            $template = __DIR__ . '/../../../view/store/templates/registration-notice.html';
            $message = $fileHandler->fileTempParse($template, $params);
            $mail = [
                'subject' => 'Account Registration - ' . $this->site_name,
                'message' => $message,
                'name_from' => $this->site_name,
                'name_to' => trim($params['name']),
                'to' => $params['email_address'],
                'from' => SMTP_USER
            ];
            $mailController->sendMail($mail);
        }
    }

    /**
     * @throws Exception
     * @throws \JsonException
     */
    public function password_notification($params = []): void
    {
        if (!empty($params)) {
            $fileHandler = new FileHandler();
            $mailController = new Mailing();
            $params['reset_link'] = URL . 'auth/password-reset/' . base64_encode(json_encode(['email' => $params['email_address']], JSON_THROW_ON_ERROR));
            $params['logo_url'] = URL . 'assets/images/logo.png';
            $template = __DIR__ . '/../../../view/store/templates/password-notice.html';
            $message = $fileHandler->fileTempParse($template, $params);
            $mail = [
                'subject' => 'Password Reset - ' . $this->site_name,
                'message' => $message,
                'name_from' => $this->site_name,
                'name_to' => trim($params['fullname']),
                'to' => $params['email_address'],
                'from' => SMTP_USER
            ];
            $mailController->sendMail($mail);
        }
    }

}