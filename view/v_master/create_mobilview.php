
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6"><h1 class="m-0"><?= isset($mobil) ? 'Edit Data Mobil' : 'Entri Data Mobil' ?></h1></div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Master Data</a></li>
            <li class="breadcrumb-item active"><?= isset($mobil) ? 'Edit Data Mobil' : 'Entri Data Mobil' ?></li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-car"></i> Form Entri Data Mobil</h3>
        </div>

        <form action="<?= base_url('?url=c_master/Mobil_C/' . (isset($mobil) ? 'ubah' : 'simpan')) ?>" method="post" enctype="multipart/form-data">

          <?php if (isset($mobil)) { ?>
            <input type="hidden" name="no_plat_lama" value="<?= htmlspecialchars($mobil['no_plat']) ?>">
          <?php } ?>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>No. Plat</label>
                  <input type="text" name="no_plat" class="form-control" placeholder="Contoh: BN 1234 AB" value="<?= isset($mobil) ? htmlspecialchars($mobil['no_plat']) : '' ?>" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Mobil</label>
                  <input type="text" name="nm_mobil" class="form-control" placeholder="Contoh: Toyota Avanza" value="<?= isset($mobil) ? htmlspecialchars($mobil['nm_mobil']) : '' ?>" required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Jumlah Kursi</label>
                  <input type="number" name="nkursi" class="form-control" value="<?= isset($mobil) ? htmlspecialchars($mobil['nkursi']) : '' ?>" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Jumlah Bagasi</label>
                  <input type="number" name="nbagasi" class="form-control" value="<?= isset($mobil) ? htmlspecialchars($mobil['nbagasi']) : '' ?>" required>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Jenis Mobil</label>
                  <select name="jns_mobil" class="form-control" required>
                    <option value="">-- Pilih Jenis --</option>
                    <?php
                    $jenis = ['Kijang', 'Sedan', 'SUV', 'Avanza', 'Xenia'];
                    foreach ($jenis as $j) {
                        $selected = (isset($mobil) && $mobil['jns_mobil'] == $j) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($j) . '" ' . $selected . '>' . htmlspecialchars($j) . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Transmisi</label>
                  <select name="transmisi" class="form-control" required>
                    <option value="">-- Pilih Transmisi --</option>
                    <?php
                    $transmisi = ['Manual', 'Automatic'];
                    foreach ($transmisi as $t) {
                        $selected = (isset($mobil) && $mobil['transmisi'] == $t) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($t) . '" ' . $selected . '>' . htmlspecialchars($t) . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Tahun Pembuatan</label>
                  <input type="number" name="thn_buat" class="form-control" placeholder="Contoh: 2024" value="<?= isset($mobil) ? htmlspecialchars($mobil['thn_buat']) : '' ?>" required>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Biaya Per Hari</label>
                  <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">Rp</span></div>
                    <input type="number" name="hrg_hari" class="form-control" placeholder="Contoh: 350000" value="<?= isset($mobil) ? htmlspecialchars($mobil['hrg_hari']) : '' ?>" required>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label>Status Unit</label>
                  <select name="status_unit" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <?php
                    $status = ['Aktif', 'Tidak Aktif', 'Disewa'];
                    foreach ($status as $s) {
                        $selected = (isset($mobil) && $mobil['status_unit'] == $s) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($s) . '" ' . $selected . '>' . htmlspecialchars($s) . '</option>';
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12"><label><i class="fas fa-camera"></i> Foto Mobil</label></div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Foto Depan</label>
                  <input type="file" name="ft_depan" id="ft_depan" class="form-control" accept="image/*">
                  <small>Format JPG, JPEG atau PNG</small>

                  <?php if (isset($mobil) && !empty($mobil['ft_depan'])) { ?>
                    <input type="hidden" name="foto_depan_lama" value="<?= htmlspecialchars($mobil['ft_depan']) ?>">
                    <img id="preview_depan" src="<?= base_url('img/' . $mobil['ft_depan']) ?>" width="100%" style="margin-top:10px; display:block; border-radius:8px; border:1px solid #ddd;">
                  <?php } else { ?>
                    <img id="preview_depan" src="" width="100%" style="margin-top:10px; display:none; border-radius:8px; border:1px solid #ddd;">
                  <?php } ?>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Foto Belakang</label>
                  <input type="file" name="ft_blkg" id="ft_blkg" class="form-control" accept="image/*">
                  <small>Format JPG, JPEG atau PNG</small>

                  <?php if (isset($mobil) && !empty($mobil['ft_blkg'])) { ?>
                    <input type="hidden" name="foto_blkg_lama" value="<?= htmlspecialchars($mobil['ft_blkg']) ?>">
                    <img id="preview_blkg" src="<?= base_url('img/' . $mobil['ft_blkg']) ?>" width="100%" style="margin-top:10px; display:block; border-radius:8px; border:1px solid #ddd;">
                  <?php } else { ?>
                    <img id="preview_blkg" src="" width="100%" style="margin-top:10px; display:none; border-radius:8px; border:1px solid #ddd;">
                  <?php } ?>
                </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                  <label>Foto Interior</label>
                  <input type="file" name="ft_interior" id="ft_interior" class="form-control" accept="image/*">
                  <small>Format JPG, JPEG atau PNG</small>

                  <?php if (isset($mobil) && !empty($mobil['ft_interior'])) { ?>
                    <input type="hidden" name="foto_interior_lama" value="<?= htmlspecialchars($mobil['ft_interior']) ?>">
                    <img id="preview_interior" src="<?= base_url('img/' . $mobil['ft_interior']) ?>" width="100%" style="margin-top:10px; display:block; border-radius:8px; border:1px solid #ddd;">
                  <?php } else { ?>
                    <img id="preview_interior" src="" width="100%" style="margin-top:10px; display:none; border-radius:8px; border:1px solid #ddd;">
                  <?php } ?>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Catatan Unit</label>
              <textarea name="cttn_unit" class="form-control" rows="3" placeholder="Masukkan catatan mengenai kendaraan"><?= isset($mobil) ? htmlspecialchars($mobil['cttn_unit']) : '-' ?></textarea>
            </div>
          </div>

          <div class="card-footer">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save"></i> <?= isset($mobil) ? 'Simpan Perubahan' : 'Simpan' ?>
            </button>
            <a href="<?= base_url('?url=c_master/Mobil_C/index') ?>" class="btn btn-secondary">
              <i class="fas fa-arrow-left"></i> Kembali
            </a>
          </div>
        </form>
      </div>
    </div>
  </section>
</div>

<!-- SCRIPT TAMBAHAN BIAR FOTO MUNCUL PAS PILIH FILE -->
<script>
  function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById(previewId).src = e.target.result;
        document.getElementById(previewId).style.display = 'block';
      }
      reader.readAsDataURL(input.files[0]);
    }
  }

  document.getElementById('ft_depan').addEventListener('change', function() {
    previewImage(this, 'preview_depan');
  });

  document.getElementById('ft_blkg').addEventListener('change', function() {
    previewImage(this, 'preview_blkg');
  });

  document.getElementById('ft_interior').addEventListener('change', function() {
    previewImage(this, 'preview_interior');
  });
</script>
