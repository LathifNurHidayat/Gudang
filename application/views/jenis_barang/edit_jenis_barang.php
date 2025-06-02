<div class="col">
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Edit jenis barang
    </h2>
</div>

<div class="col-8 mt-3">
    <div class="card">
        <div class="card-body">

            <?= $this->session->flashdata('msg'); ?>


            <form id="form_edit_jenis">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash()?>">
                <input type="hidden" name="id_jenis_barang" value="<?= $jenis_barang->id_jenis_barang ?>">
                <div class="mb-3">
                    <label class="form-label">Nama jenis barang</label>
                    <input type="text" class="form-control" name="nama_jenis_barang"
                        value="<?= set_value('nama_jenis_barang', $jenis_barang->nama_jenis_barang) ?>">
                    <small class="text-danger" id="error_nama_jenis"></small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= base_url('barang/jenis_barang') ?>" class="btn btn-warning">Kembali</a>
                    <button type="submit" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <line x1="10" y1="14" x2="21" y2="3" />
                            <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5" />
                        </svg>
                        Kirim
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
        update_jenis_barang();

        function update_jenis_barang() {
            $('#form_edit_jenis').on('submit', function (e) {
                e.preventDefault();
                $('.text-danger').text('');
                $.ajax({
                    url: '<?= site_url('barang/update_jenis_barang') ?>',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (res) {
                        if (res.status === 'error') {
                            $('#error_nama_jenis').text(res.error_msg.error_jenis);
                        } else if (res.status === 'success') {
                            window.location.href = res.redirect;
                        }
                    },
                    error: function (error) {
                        console.error('Error : ', error);
                    }
                });
            })
        }
    });
</script>