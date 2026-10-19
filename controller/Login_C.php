<?php
class Login_C extends Controller
{
    public function index()
    {
        $psn = '';
        if (method_exists($this->session, 'userdata')) {
            $psn = $this->session->userdata('pesan');
        }

        $data['psn'] = $psn;
        $this->load->view('login', $data);
    }

    public function CekLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('Login_C/index');
            return;
        }

        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['pass'])
            ? trim($_POST['pass'])
            : (isset($_POST['password']) ? trim($_POST['password']) : '');

        // LOGIN KHUSUS JELISA067
        if ($email == 'jelisa067@mahasiswa.atmaluhur.ac.id'
            && $password == '12345') {

            $this->session->set_userdata('emailuser', $email);
            $this->session->set_userdata('nm_user', 'Jelisa Dewi Komariah - 067');
            $this->session->set_userdata('pesan', '');

            redirect('Admin_C/index');
            return;
        }

        // LOGIN NORMAL
        require_once dirname(__DIR__) . '/model/Login_M.php';

        $loginModel = new Login_M();
        $datauser = $loginModel->ambildata($email);

        if ($datauser && $password == $datauser['password']) {
            $this->session->set_userdata('emailuser', $email);
            $this->session->set_userdata('nm_user', 'Jelisa Dewi Komariah - 067');

            redirect('Admin_C/index');
        } else {
            $this->session->set_userdata(
                'pesan',
                'Gagal: Silahkan cek email, password, atau status akun Anda...'
            );

            $this->session->set_flashdata(
                'pesan',
                'Gagal: Silahkan cek email, password, atau status akun Anda...'
            );

            redirect('Login_C/index');
        }
    }
}