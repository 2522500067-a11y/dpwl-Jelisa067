
<?php
class Penyewa_M067 extends Model
{
    function datapenyewa067()
    {
        $dtpenyewa = $this->db->prepare("
            SELECT user_plg067, sandi067, nik067, nm_lngkp067,
            no_hp067, almt_lngkp067, ft_ktp, ft_sim_a
            FROM penyewa
            WHERE user_plg067 IS NOT NULL
            AND TRIM(user_plg067) != ''
        ");

        $dtpenyewa->execute();

        $result = $dtpenyewa->get_result()->fetch_all(MYSQLI_ASSOC);

        $fix = [];

        foreach ($result as $r) {
            $fix[] = array_change_key_case($r, CASE_LOWER);
        }

        return $fix;
    }

    public function cekuser067($user_plg067)
    {
        $user_plg067 = urldecode($user_plg067);

        $sql = $this->db->prepare("
            SELECT user_plg067
            FROM penyewa
            WHERE user_plg067 = ?
        ");

        $sql->bind_param("s", $user_plg067);
        $sql->execute();

        return $sql->get_result()->num_rows > 0;
    }

    public function simpan067($data)
    {
        $data = array_change_key_case($data, CASE_LOWER);

        foreach ($data as $k => $v) {
            if ($v === null) {
                $data[$k] = '';
            }
        }

        // Cek username agar tidak duplikat
        if ($this->cekuser067($data['user_plg067'])) {
            die("Error: Username sudah terdaftar!");
        }

        // Password wajib diisi
        if (empty($data['sandi067'])) {
            die("Error: Password tidak boleh kosong!");
        }

        // Enkripsi password
        if (password_get_info($data['sandi067'])['algo'] === null) {
            $data['sandi067'] = password_hash(
                $data['sandi067'],
                PASSWORD_DEFAULT
            );
        }

        $sql = $this->db->prepare("
            INSERT INTO penyewa
            (user_plg067, sandi067, nik067, nm_lngkp067,
            no_hp067, almt_lngkp067, ft_ktp, ft_sim_a)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");

        if (!$sql) {
            die("Error Prepare: " . $this->db->error);
        }

        $sql->bind_param(
            "ssssssss",
            $data['user_plg067'],
            $data['sandi067'],
            $data['nik067'],
            $data['nm_lngkp067'],
            $data['no_hp067'],
            $data['almt_lngkp067'],
            $data['ft_ktp'],
            $data['ft_sim_a']
        );

        if (!$sql->execute()) {
            die("Error DB: " . $sql->error);
        }

        return true;
    }

    public function detail067($user_plg067)
    {
        $user_plg067 = urldecode($user_plg067);

        $sql = $this->db->prepare("
            SELECT *
            FROM penyewa
            WHERE user_plg067 = ?
        ");

        $sql->bind_param("s", $user_plg067);
        $sql->execute();

        $result = $sql->get_result()->fetch_assoc();

        if ($result) {
            return array_change_key_case($result, CASE_LOWER);
        }

        return $result;
    }

    public function ubah067($data)
    {
        $data = array_change_key_case($data, CASE_LOWER);

        foreach ($data as $k => $v) {
            if ($v === null) {
                $data[$k] = '';
            }
        }

        $user_lama = $data['user_lama067']
            ?? $data['user_plg067_lama']
            ?? $data['user_plg067'];

        // Hash password baru jika diisi
        if (!empty($data['sandi067'])) {

            $data['sandi067'] = password_hash(
                $data['sandi067'],
                PASSWORD_DEFAULT
            );

            $sql = $this->db->prepare("
                UPDATE penyewa SET
                user_plg067 = ?,
                sandi067 = ?,
                nik067 = ?,
                nm_lngkp067 = ?,
                no_hp067 = ?,
                almt_lngkp067 = ?,
                ft_ktp = ?,
                ft_sim_a = ?
                WHERE user_plg067 = ?
            ");

            $sql->bind_param(
                "sssssssss",
                $data['user_plg067'],
                $data['sandi067'],
                $data['nik067'],
                $data['nm_lngkp067'],
                $data['no_hp067'],
                $data['almt_lngkp067'],
                $data['ft_ktp'],
                $data['ft_sim_a'],
                $user_lama
            );

        } else {

            // Password kosong berarti password lama tetap digunakan
            $sql = $this->db->prepare("
                UPDATE penyewa SET
                user_plg067 = ?,
                nik067 = ?,
                nm_lngkp067 = ?,
                no_hp067 = ?,
                almt_lngkp067 = ?,
                ft_ktp = ?,
                ft_sim_a = ?
                WHERE user_plg067 = ?
            ");

            $sql->bind_param(
                "ssssssss",
                $data['user_plg067'],
                $data['nik067'],
                $data['nm_lngkp067'],
                $data['no_hp067'],
                $data['almt_lngkp067'],
                $data['ft_ktp'],
                $data['ft_sim_a'],
                $user_lama
            );
        }

        if (!$sql) {
            die("Error Prepare Update: " . $this->db->error);
        }

        if (!$sql->execute()) {
            die("Error DB Update: " . $sql->error);
        }

        return true;
    }

    // Kompatibilitas dengan controller
    public function ubahPenyewa067($data)
    {
        return $this->ubah067($data);
    }

    public function hapus067($user_plg067)
    {
        $user_plg067 = urldecode($user_plg067);

        $dtpenyewa = $this->db->prepare("
            DELETE FROM penyewa
            WHERE user_plg067 = ?
        ");

        $dtpenyewa->bind_param("s", $user_plg067);

        return $dtpenyewa->execute();
    }

    // Menghapus data dengan username kosong
    public function hapusHantu067()
    {
        $stmt = $this->db->prepare("
            DELETE FROM penyewa
            WHERE user_plg067 = ''
            OR user_plg067 IS NULL
            OR TRIM(user_plg067) = ''
        ");

        $hasil = $stmt->execute();

        $stmt->close();

        return $hasil;
    }
}
?>
