<div class="col">
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Tambah data role
    </h2>
</div>

<div class="col-8 mt-3">
    <div class="card">
        <div class="card-body">

            <?= $this->session->flashdata('msg'); ?>

            <form class="m-3" id="form_role">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>">

                <div class="mb-3">
                    <label class="form-label">Nama role</label>
                    <input type="text" class="form-control" name="role" value="<?= set_value('role') ?>">
                    <small class="error text-danger" id="error_role"></small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= site_url('menu/role') ?>" class="btn btn-warning">Kembali</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-send"></i>
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>

    $(document).ready(function () {
        add_role();

        function add_role() {
            $('#form_role').on('submit', function (e) {
                e.preventDefault();
                $('.error').text('');
                $.ajax({
                    url: '<?= site_url('menu/insert_role') ?>',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (res) {
                        if (res.status === 'error') {
                            $('#error_role').text(res.error_role)
                            alert(res.error_role);
                        }
                        else if (res.status === 'success') {
                            window.location.href = res.redirect;
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat mengirim data.');
                    }
                });
            });
        };
    });
</script>