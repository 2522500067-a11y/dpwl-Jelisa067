<?php
class Penyewa_C067 extends Controller
{
    public function index()
    {
        $m = $this->model('m_master/Penyewa_M067');
        $dt['dtpenyewa'] = $m->datapenyewa067();

        $this->view('Layout/header');
        $this->view('Layout/sidebar');
        $this->view('v_master/penyewaview067', $dt);
        $this->view('Layout/footer');
    }

    public function create()
    {
        $this->view('Layout/header');
        $this->view('Layout/sidebar');
        $this->view('v_master/create_penyewaview067');
        $this->view('Layout/footer');
    }

    // PERBAIKAN 1: Tambahin ini, biar tombol Tambah yang manggil 'tambah' gak error lagi
    public function tambah()
    {
        $this->create();
    }

    public function edit($user = '')
    {
        $user = urldecode($user);

        $m = $this->model('m_master/Penyewa_M067');
        $detail = $m->detail067($user);

        // PERBAIKAN 3: Kirim pakai 2 nama, biar View manapun yang dipakai tetep kebaca
        $dt['p'] = $detail;
        $dt['penyewa'] = $detail;

        $this->view('Layout/header');
        $this->view('Layout/sidebar');
        $this->view('v_master/edit_penyewaview067', $dt);
        $this->view('Layout/footer');
    }

    public function simpan()
    {
        $m = $this->model('m_master/Penyewa_M067');

        // Biar gak error kalau nama input di form beda, pakai 2 kemungkinan
        $user = trim($_POST['username067'] ?? $_POST['user_plg067'] ?? '');

        // PERBAIKAN 2: Foldernya samain sama View: assets/foto_penyewa/
        $folder = 'assets/foto_penyewa/';

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $ft_ktp = '';
        $ft_sim_a = '';

        if (!empty($_FILES['ft_ktp067']['name'])) {
            $ft_ktp = 'KTP_' . $user . '_' . time() . '.' . pathinfo($_FILES['ft_ktp067']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['ft_ktp067']['tmp_name'], $folder . $ft_ktp);
        }

        if (!empty($_FILES['ft_sim_a067']['name'])) {
            $ft_sim_a = 'SIM_A_' . $user . '_' . time() . '.' . pathinfo($_FILES['ft_sim_a067']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['ft_sim_a067']['tmp_name'], $folder . $ft_sim_a);
        }

        $data = [
            'user_plg067' => $user,
            'sandi067' => $_POST['password067'] ?? $_POST['sandi067'] ?? '',
            'nik067' => $_POST['nik067'] ?? '',
            'nm_lngkp067' => $_POST['nama_lengkap067'] ?? $_POST['nm_lngkp067'] ?? '',
            'no_hp067' => $_POST['no_handphone067'] ?? $_POST['no_hp067'] ?? '',
            'almt_lngkp067' => $_POST['alamat_lengkap067'] ?? $_POST['almt_lngkp067'] ?? '',
            'ft_ktp' => $ft_ktp,
            'ft_sim_a' => $ft_sim_a
        ];

        $m->simpan067($data);

        echo "<script>
            window.location.href='" . base_url('?url=c_master/Penyewa_C067/index') . "';
        </script>";
    }

    public function ubah()
    {
        $m = $this->model('m_master/Penyewa_M067');

        $user_lama = $_POST['user_lama067'] ?? $_POST['username067'] ?? $_POST['user_plg067'] ?? '';

        $detail = $m->detail067($user_lama);

        if ($detail) {
            $detail = array_change_key_case($detail, CASE_LOWER);
        }

        $folder = 'assets/foto_penyewa/';

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $ft_ktp = $detail['ft_ktp'] ?? '';
        $ft_sim_a = $detail['ft_sim_a'] ?? '';

        $user_baru = $_POST['username067'] ?? $_POST['user_plg067'] ?? $user_lama;

        if (!empty($_FILES['ft_ktp067']['name'])) {
            $ft_ktp = 'KTP_' . $user_baru . '_' . time() . '.' . pathinfo($_FILES['ft_ktp067']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['ft_ktp067']['tmp_name'], $folder . $ft_ktp);
        }

        if (!empty($_FILES['ft_sim_a067']['name'])) {
            $ft_sim_a = 'SIM_A_' . $user_baru . '_' . time() . '.' . pathinfo($_FILES['ft_sim_a067']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['ft_sim_a067']['tmp_name'], $folder . $ft_sim_a);
        }

        $data = [
            'user_plg067' => $user_baru,
            'sandi067' => $_POST['password067'] ?? $_POST['sandi067'] ?? '',
            'nik067' => $_POST['nik067'] ?? '',
            'nm_lngkp067' => $_POST['nama_lengkap067'] ?? $_POST['nm_lngkp067'] ?? '',
            'no_hp067' => $_POST['no_handphone067'] ?? $_POST['no_hp067'] ?? '',
            'almt_lngkp067' => $_POST['alamat_lengkap067'] ?? $_POST['almt_lngkp067'] ?? '',
            'ft_ktp' => $ft_ktp,
            'ft_sim_a' => $ft_sim_a,
            'user_lama067' => $user_lama
        ];

        $m->ubah067($data);

        echo "<script>
            window.location.href='" . base_url('?url=c_master/Penyewa_C067/index') . "';
        </script>";
    }

    // PERBAIKAN 4: Cadangan, biar kalau form Update-nya manggil UpdatePenyewa, tetep jalan
    public function UpdatePenyewa()
    {
        $this->ubah();
    }

    public function hapus($user = '')
    {
        $m = $this->model('m_master/Penyewa_M067');

        $m->hapus067(urldecode($user));

        echo "<script>
            window.location.href='" . base_url('?url=c_master/Penyewa_C067/index') . "';
        </script>";
    }
}
?>