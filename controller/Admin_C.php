
<?php
class Admin_C extends Controller
{
    public function index()
    {
        // Mengambil nama user dari session PHP
        $info['nm_user'] = isset($_SESSION['nm_user'])
            ? $_SESSION['nm_user'] : '';

        // Mengambil pesan session
        $info['info_psn'] = isset($_SESSION['pesan'])
            ? $_SESSION['pesan'] : '';

        // Menghapus pesan setelah dibaca (flashdata)
        unset($_SESSION['pesan']);

        // Memanggil tampilan header
        extract($info);
        include dirname(__DIR__) . '/view/layout/header.php';

        // Memanggil tampilan sidebar
        extract($info);
        include dirname(__DIR__) . '/view/layout/sidebar.php';

        // Memanggil tampilan starter
        include dirname(__DIR__) . '/view/layout/starter.php';

        // Memanggil tampilan footer
        include dirname(__DIR__) . '/view/layout/footer.php';
    }
}
