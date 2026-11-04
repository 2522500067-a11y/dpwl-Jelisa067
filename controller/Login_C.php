
<?php
class Login_C extends Controller
{
    public function __construct()
    {
        // Session sudah dipanggil melalui index.php
    }

    public function index()
    {
        $psn = isset($_SESSION['pesan'])
            ? $_SESSION['pesan'] : '';

        $data['psn'] = $psn;

        // Memanggil view login secara langsung
        include dirname(__DIR__) . '/view/login.php';
    }

    public function CekLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            redirect('Login_C/index');
            return;
        }

        $email = isset($_POST['email'])
            ? trim($_POST['email']) : '';

        $password = isset($_POST['pass'])
            ? trim($_POST['pass'])
            : (isset($_POST['password'])
                ? trim($_POST['password']) : '');

        // LOGIN KHUSUS JELISA
        if (
            $email == 'Jelisa067@atmaluhur.ac.id'
            && $password == '12345'
        ) {
            $_SESSION['emailuser'] = $email;
            $_SESSION['nm_user'] = 'Jelisa - 067';
            $_SESSION['pesan'] = '';

            redirect('Admin_C/index');
            return;
        }

        // LOGIN NORMAL
        require_once dirname(__DIR__) . '/model/Login_M.php';

        $loginModel = new Login_M();
        $datauser = $loginModel->ambildata($email);

        if ($datauser && $password == $datauser['password']) {

            $_SESSION['emailuser'] = $email;
            $_SESSION['nm_user'] = $datauser['nm_user'];

            redirect('Admin_C/index');
            return;

        } else {

            $_SESSION['pesan'] =
                'Gagal: Silahkan cek email, password, atau status akun Anda...';

            redirect('Login_C/index');
            return;
        }
    }
}
