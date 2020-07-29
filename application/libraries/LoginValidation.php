<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class LoginValidation extends CI_Form_validation
{
    protected $CI;
    function __construct()
    {
        parent::__construct();
        // reference to the CodeIgniter super object 
        $this->CI = &get_instance();
    }
    function password_check($pwd)
    {
        $this->CI->form_validation->set_message('password', 'The %s is not valid.');
        if (strlen($pwd) < 8 && !preg_match("#[0-9]+#", $pwd) && !preg_match("#[a-zA-Z]+#", $pwd)) {
            return TRUE;
        }

        return FALSE;
    }
}
