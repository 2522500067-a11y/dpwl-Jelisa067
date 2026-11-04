<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Penyewa - Jellisa 067</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Master Data</li>
                        <li class="breadcrumb-item active">Data Penyewa 067</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <a href="<?= base_url('?url=c_master/Penyewa_C067/tambah') ?>"
                       class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Data Penyewa 067
                    </a>
                </div>

                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username 067</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>No. HP</th>
                                <th>Alamat Lengkap</th>
                                <th>Foto KTP</th>
                                <th>Foto SIM A</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php 
                            // Biar gak error kalau Controller ngirimnya $penyewa, bukan $dtpenyewa
                            $data_tampil = $dtpenyewa ?? $penyewa ?? [];
                            if (!empty($data_tampil)) { ?>

                                <?php foreach ($data_tampil as $p) {
                                    $p = array_change_key_case($p, CASE_LOWER);

                                    if (empty($p['user_plg067'])) {
                                        continue;
                                    }
                                ?>

                                <tr>
                                    <td><?= htmlspecialchars($p['user_plg067']) ?></td>
                                    <td><?= htmlspecialchars($p['nik067']) ?></td>
                                    <td><?= htmlspecialchars($p['nm_lngkp067']) ?></td>
                                    <td><?= htmlspecialchars($p['no_hp067']) ?></td>
                                    <td><?= htmlspecialchars($p['almt_lngkp067']) ?></td>

                                    <td>
                                        <?php if (!empty($p['ft_ktp'])) { ?>
                                            <img src="<?= base_url('assets/foto_penyewa/' . rawurlencode($p['ft_ktp'])) ?>"
                                                 width="100"
                                                 style="border-radius:5px">
                                        <?php } else { ?>
                                            -
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <?php if (!empty($p['ft_sim_a'])) { ?>
                                            <img src="<?= base_url('assets/foto_penyewa/' . rawurlencode($p['ft_sim_a'])) ?>"
                                                 width="100"
                                                 style="border-radius:5px">
                                        <?php } else { ?>
                                            -
                                        <?php } ?>
                                    </td>

                                    <td>
                                        <a href="<?= base_url('?url=c_master/Penyewa_C067/edit/' . urlencode($p['user_plg067'])) ?>"
                                           class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <a href="<?= base_url('?url=c_master/Penyewa_C067/hapus/' . urlencode($p['user_plg067'])) ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Hapus data <?= htmlspecialchars($p['user_plg067'], ENT_QUOTES) ?>?')">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="8" class="text-center">
                                        Belum ada data penyewa 067 - Klik Tambah Data
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>