<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

//::: CONTROLLER/AUTH.PHP ::://

class Auth extends Controller {

    //=== LOAD MODEL ===//
    public function __construct()
    {
        parent::__construct();
        $this->call->model('AuthM', 'authM');
    }

    //=== LOGIN FORM ===//
    public function login()
    {
        $this->call->view('auth/login');
    }

    //=== LOGIN ===///
    public function verify()
    {
        if ($this->form_validation->submitted()) {
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $data = $this->lauth->login($email, $password);
            
            if (empty($data)) {
                $this->session->set_flashdata('alert', 'error');
                $this->session->set_flashdata('message', 'These credentials do not match our records.');
                $this->call->view('auth/login');
            } else {
                $getSessionInfo = $this->authM->getUser($data);
                $newdata = array(
                    'id'         => $getSessionInfo['id'] ?? '',
                    'username'   => $getSessionInfo['username'] ?? '',
                    'email'      => $getSessionInfo['email'] ?? '',
                    'role'       => $getSessionInfo['role'] ?? '',
                    'first_name' => $getSessionInfo['first_name'] ?? '',
                    'logged_in'  => TRUE
                );

                $this->session->set_userdata($newdata);
                $this->session->set_flashdata('alert', 'success');
                $this->session->set_flashdata('message', 'Login successful. Welcome back!');
                $this->lauth->set_logged_in($data);
                $userRole = $this->session->userdata('role');
                $firstTimeUser = $this->session->userdata('first_name');
                if ($userRole == 'admin') {
                    redirect('home');
                } else if ($userRole == 'patient' && $firstTimeUser == null) {
                    redirect('client/newClient');
                } else if ($userRole == 'patient' && $firstTimeUser != null) {
                    redirect('client/appointment');
                }
            }
        } else {
            $this->call->view('auth/login');
        }
    }


    //=== REGISTER ===//
     public function register()
    {
        if ($this->form_validation->submitted()) {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = $this->io->post('password');
            $password_confirmation = $this->io->post('password_confirmation');
            $email_token = bin2hex(random_bytes(50));

            $this->form_validation
                ->name('username')
                ->required()
                ->is_unique('users', 'username', $username, 'Username was already taken.')
                ->min_length(5, 'Username name must not be less than 5 characters.')
                ->max_length(20, 'Username name must not be more than 20 characters.')
                ->alpha_numeric_dash('Special characters are not allowed in username.')
                ->name('password')
                    ->required()
                    ->min_length(8, 'Password must be at least 8 characters.')
                ->name('password_confirmation')
                    ->required()
                    ->min_length(8, 'Password confirmation must be at least 8 characters.')
                    ->matches('password', 'Passwords did not match.')
                ->name('email')
                    ->required()
                    ->is_unique('users', 'email', $email, 'Email was already taken.')
                    ->valid_email('Please provide a valid email.');
            if ($this->form_validation->run()) {
                if ($this->lauth->register($username, $email, $password, $email_token)) {
                    $data = $this->lauth->login($email, $password);
                    $this->lauth->set_logged_in($data);
                    set_flash_alert('success', 'You are registered. Please log in.');
                    redirect('auth/login');
                } else {
                    set_flash_alert('danger', config_item('SQLError'));
                    redirect('auth/register');
                }
            } else {
                set_flash_alert('danger', $this->form_validation->errors());
                redirect('auth/register');
            }
        } else {
            $this->call->view('auth/register');
        }
    }

    //=== EMAIL TOKEN ===//
    private function send_password_token_to_email($email, $token) {
		$template = file_get_contents(ROOT_DIR.PUBLIC_DIR.'/templates/reset_password_email.html');
		$search = array('{token}', '{base_url}');
		$replace = array($token, base_url());
		$template = str_replace($search, $replace, $template);
		$this->email->recipient($email);
		$this->email->subject('LavaLust Reset Password');
		$this->email->sender('sample@email.com');
		$this->email->reply_to('sample@email.com');
		$this->email->email_content($template, 'html');
		$this->email->send();
	}

    //=== PW RESET ===//
	public function password_reset() {
		if($this->form_validation->submitted()) {
			$email = $this->io->post('email');
			$this->form_validation
				->name('email')->required()->valid_email();
			if($this->form_validation->run()) {
				if($token = $this->lauth->reset_password($email)) {
					$this->send_password_token_to_email($email, $token);
                    $this->session->set_flashdata(['alert' => 'is-valid']);
				} else {
					$this->session->set_flashdata(['alert' => 'is-invalid']);
				}
			} else {
				set_flash_alert('danger', $this->form_validation->errors());
			}
		}
		$this->call->view('auth/password_reset');
	}

    //=== NEW PW ===//
    public function set_new_password() {
        if($this->form_validation->submitted()) {
            $token = $this->io->post('token');
			if(isset($token) && !empty($token)) {
				$password = $this->io->post('password');
				$this->form_validation
					->name('password')
						->required()
						->min_length(8, 'New password must be atleast 8 characters.')
					->name('re_password')
						->required()
						->min_length(8, 'Retype password must be atleast 8 characters.')
						->matches('password', 'Passwords did not matched.');
						if($this->form_validation->run()) {
							if($this->lauth->reset_password_now($token, $password)) {
								set_flash_alert('success', 'Password was successfully updated.');
							} else {
								set_flash_alert('danger', config_item('SQLError'));
							}
						} else {
							set_flash_alert('danger', $this->form_validation->errors());
						}
			} else {
				set_flash_alert('danger', 'Reset token is missing.');
			}
    	redirect('auth/set-new-password/?token='.$token);
        } else {
             $token = $_GET['token'] ?? '';
            if(! $this->lauth->get_reset_password_token($token) && (! empty($token) || ! isset($token))) {
                set_flash_alert('danger', 'Invalid password reset token.');
            }
            $this->call->view('auth/new_password');
        }
		
	}
}
?>