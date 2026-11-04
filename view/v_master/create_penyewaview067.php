<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Entri Data Penyewa - Jellisa 067</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-users"></i> Form Entri Data Penyewa 067
                    </h3>
                </div>

                <!-- PERBAIKAN 1: BASEURL diganti base_url() -->
                <form action="<?= base_url('?url=c_master/Penyewa_C067/simpan') ?>"
                      method="POST"
                      enctype="multipart/form-data">

                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username (User Pelanggan) 067</label>
                                    <input type="text" name="user_plg067"
                                           class="form-control"
                                           placeholder="Contoh: Jellisa067" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kata Sandi (Password) 067</label>
                                    <input type="password" name="sandi067"
                                           class="form-control"
                                           placeholder="Masukkan kata sandi" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>NIK 067</label>
                                    <input type="text" name="nik067"
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Lengkap 067</label>
                                    <input type="text" name="nm_lngkp067"
                                           class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No. Handphone 067</label>
                                    <input type="text" name="no_hp067"
                                           class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap 067</label>
                            <textarea name="almt_lngkp067"
                                      class="form-control"
                                      rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto KTP 067</label>
                                    <!-- PERBAIKAN 2: name="ft_ktp" jadi name="ft_ktp067" biar nyambung sama Controller -->
                                    <input type="file" name="ft_ktp067"
                                           id="ft_ktp067"
                                           class="form-control"
                                           accept="image/*" required>

                                    <!-- PERBAIKAN 3: width 100% jadi 200px, biar gak nutupin tombol Simpan -->
                                    <img id="preview_ktp067" src=""
                                         width="200"
                                         style="margin-top:10px; display:none; border-radius:8px;">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto SIM A 067</label>
                                    <!-- PERBAIKAN 2: name="ft_sim_a" jadi name="ft_sim_a067" -->
                                    <input type="file" name="ft_sim_a067"
                                           id="ft_sim_a067"
                                           class="form-control"
                                           accept="image/*" required>

                                    <img id="preview_sim_a067" src=""
                                         width="200"
                                         style="margin-top:10px; display:none; border-radius:8px;">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan 067
                        </button>

                        <!-- PERBAIKAN 1: BASEURL di tombol Kembali juga diganti -->
                        <a href="<?= base_url('?url=c_master/Penyewa_C067/index') ?>"
                           class="btn btn-secondary">Kembali</a>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>

<script>
function previewImage067(input, previewId) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
            document.getElementById(previewId).style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
}

document.getElementById('ft_ktp067').addEventListener('change', function() {
    previewImage067(this, 'preview_ktp067');
});

document.getElementById('ft_sim_a067').addEventListener('change', function() {
    previewImage067(this, 'preview_sim_a067');
});
</script>