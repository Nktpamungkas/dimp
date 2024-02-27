<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    
    function __construct() {
        parent::__construct();
        $this->load->helper('captcha','string');
    }
    
    function index()
    {
        redirect('login');
    }
    
    function login()
    {
        if(isset($_POST['submit'])){
            $username   =  $this->input->post('username');
            $password   =  $this->input->post('password');
            $login      =  $this->db->get_where('app_users',array('username'=>$username,'password'=>  md5($password)));
          
				if ($login->num_rows()>0){
                    $r  = $login->row_array();
                    $data   =   array('id_users'            => $r['id_users'],
                                      'device_code_session' => 'emptyy',
                                      'level'               => $r['level'],
                                      'sess_login_absen'    => substr(time(), 0,10),
                                      'nama'                => $r['nama'],
                                      'username'            => $username);
                    $this->session->set_userdata($data);
                    $this->db->update('app_users',array('last_login'=>  time()), 'username',$username);
                    //redirect('mahasiswa');
                    redirect('dashboard'); //('obat');
				}else{
					redirect('auth/login');
				}
        }else{
            $this->load->view('login');
        }
    }
    
    function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
    
    function logoutpmb()
    {
        $this->session->sess_destroy();
        redirect('publik/loginpsb');
    }
}