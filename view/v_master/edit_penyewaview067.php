<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"></div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('?url=c_master/Penyewa_C067/index') ?>">Master Penyewa 067</a>
                        </li>
                        <li class="breadcrumb-item active">Update Penyewa 067</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-user-edit"></i>
                        Form Update Data Penyewa 067 - <?= $p['nik067'] ?? $penyewa['Nik059'] ?? $penyewa['nik067'] ?? '' ?>
                    </h3>
                </div>

                <form action="<?= base_url('?url=c_master/Penyewa_C067/ubah') ?>" method="post" enctype="multipart/form-data">
                    <!-- WAJIB: buat where update -->
                    <input type="hidden" name="user_lama067" value="<?= $p['user_plg067'] ?? $penyewa['user_plg059'] ?? '' ?>">
                    <input type="hidden" name="ft_ktp_asli" value="<?= $p['ft_ktp'] ?? $penyewa['ft_ktp'] ?? '' ?>">
                    <input type="hidden" name="ft_sim_a_asli" value="<?= $p['ft_sim_a'] ?? $penyewa['ft_sim_a'] ?? '' ?>">

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Username 067</label>
                                    <input type="text" name="username067" class="form-control"
                                        value="<?= $p['user_plg067'] ?? $penyewa['user_plg059'] ?? '' ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Password 067 (Kosongkan jika tidak ganti)</label>
                                    <input type="text" name="password067" class="form-control"
                                        value="" placeholder="Isi hanya jika mau ganti password">
                                </div>

                                <div class="form-group">
                                    <label>NIK 067</label>
                                    <input type="text" name="nik067" class="form-control"
                                        value="<?= $p['nik067'] ?? $penyewa['Nik059'] ?? '' ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Nama Lengkap 067</label>
                                    <input type="text" name="nama_lengkap067" class="form-control"
                                        value="<?= $p['nm_lngkp067'] ?? $penyewa['nm_lngkp059'] ?? '' ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>No. HP 067</label>
                                    <input type="text" name="no_handphone067" class="form-control"
                                        value="<?= $p['no_hp067'] ?? $penyewa['no_hp059'] ?? '' ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Foto KTP 067</label><br>
                                    <?php $ktp = $p['ft_ktp'] ?? $penyewa['ft_ktp'] ?? ''; ?>
                                    <?php if(!empty($ktp)): ?>
                                    <img src="<?= base_url('img/'.$ktp) ?>"
                                        width="100" style="border-radius:5px; margin-bottom:5px;"><br>
                                    <?php endif; ?>
                                    <input type="file" name="ft_ktp067" class="form-control" accept="image/*">
                                    <small class="form-text text-muted">Format JPG, JPEG atau PNG - Kosongkan jika tidak ganti</small>
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Alamat Lengkap 067</label>
                                    <textarea name="alamat_lengkap067" class="form-control" rows="3" required><?= $p['almt_lngkp067'] ?? $penyewa['almt_lngkp059'] ?? '' ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Foto SIM A 067</label><br>
                                    <?php $sim = $p['ft_sim_a'] ?? $penyewa['ft_sim_a'] ?? ''; ?>
                                    <?php if(!empty($sim)): ?>
                                    <img src="<?= base_url('img/'.$sim) ?>"
                                        width="100" style="border-radius:5px; margin-bottom:5px;"><br>
                                    <?php endif; ?>
                                    <input type="file" name="ft_sim_a067" class="form-control" accept="image/*">
                                    <small class="form-text text-muted">Format JPG, JPEG atau PNG - Kosongkan jika tidak ganti</small>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update 067</button>
                        <a href="<?= base_url('?url=c_master/Penyewa_C067/index') ?>"
                            class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>