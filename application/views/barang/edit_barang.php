<div class="col">
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Edit barang
    </h2>
</div>

<div class="col-8 mt-3">
    <div class="card">
        <?= $this->session->flashdata('msg'); ?>

        <form id="form_edit_barang" class="m-3">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name()?>" value="<?= $this->security->get_csrf_hash()?>">
            <input type="hidden" name="id_barang" value="<?= $barang->id_barang ?>">

            <div class="mb-3">
                <label class="form-label">Jenis barang</label>
                <select class="form-select" name="id_jenis_barang">
                    <option value="">Pilih jenis barang</option>
                    <?php foreach ($jenis_barang as $jenis): ?>
                        <option value="<?= $jenis->id_jenis_barang ?>" <?= set_select('id_jenis_barang', $jenis->id_jenis_barang, $jenis->id_jenis_barang == $barang->id_jenis_barang) ?>>
                            <?= $jenis->nama_jenis_barang ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <small class="text-danger" id="id_jenis_barang"></small>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama barang</label>
                <input type="text" class="form-control" name="nama_barang"
                    value="<?= set_value('nama_barang', $barang->nama_barang) ?>">
                <small class="text-danger" id="nama_barang"></small>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga"
                    value="<?= set_value('harga', delete_decimal($barang->harga)) ?>">
                <small class="text-danger" id="harga"></small>
            </div>

            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number" class="form-control" name="stok" value="<?= set_value('stok', $barang->stok) ?>">
                <small class="text-danger" id="stok"></small>
            </div>

            <a href="<?= base_url('barang/index') ?>" class="btn btn-warning">Kembali</a>
            <button type="submit" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" class="icon"
                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <line x1="10" y1="14" x2="21" y2="3" />
                    <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
                </svg>
                Kirim</button>
        </form>
    </div>
</div>


<script>
    $(document).ready(function () {
        update_barang();

        function update_barang() {
            $('#form_edit_barang').on('submit', function(e){
                e.preventDefault();
                $('.text-danger').text('');
                $.ajax({
                    url: '<?= site_url('barang/update_barang')?>',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(res){
                        if (res.status === 'error'){
                            $('#id_jenis_barang').text(res.error_msg.id_jenis_barang);
                            $('#nama_barang').text(res.error_msg.nama_barang);
                            $('#harga').text(res.error_msg.harga);
                            $('#stok').text(res.error_msg.stok);
                        } else if(res.status === 'success'){
                            window.location.href = res.redirect;
                        }
                    },
                    error: function(error){
                        console.error('Error : ', error);
                    }
                });
            });
        }
    });
</script>