<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Data Jenis Barang
    </h2>
</div>

<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <a href="<?= site_url('barang/add_jenis_barang') ?>" class="btn btn-primary ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Tambah Data
                </a>
            </div>
        </div>

        <div class="container mt-2">
            <?= $this->session->flashdata('msg') ?>
        </div>

        <div class="card-body">
            <div class="form-group">
                <label class="p-2">Search</label>
                <input type="text" name="keyword" id="keyword" class="form-control"
                    placeholder="Masukan keyword">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter text-nowrap" id="table_jenis_barang">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA JENIS BARANG</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {
        LoadData();

        function LoadData() {
            let keyword = $('#keyword').val();
            $.ajax({
                url: '<?= site_url('barang/get_jenis_barang') ?>',
                method: 'POST',
                data: {keyword : keyword, <?= $this->security->get_csrf_token_name();?> : "<?= $this->security->get_csrf_hash()?>"},
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    let baris = '';
                    if (data.length == 0) {
                        baris += `
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
                        </tr>`;
                    } else {
                        data.forEach(function (item, index) {
                            baris += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.nama_jenis_barang}</td>
                            <td colspan="2">
                                <a href="<?= site_url('barang/edit_jenis_barang/') ?>${item.id_jenis_barang}" class="btn btn-warning btn-sm">Edit</a>
                                <a class="delete-btn btn btn-danger btn-sm" data-id="${item.id_jenis_barang}">Hapus</a>
                            </td>
                        </tr>`;
                        })
                    }
                    $('#table_jenis_barang tbody').html(baris);
                },
                error: function (error) {
                    console.error('Error : ', error);
                }
            });
        }


        $(document).on('click', '.delete-btn', function () {
            let id = $(this).data('id');
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: '<?= site_url('barang/delete_jenis_barang') ?>',
                    method: 'POST',
                    data: {
                        id_jenis_barang: id,
                        <?= $this->security->get_csrf_token_name() ?>: "<?= $this->security->get_csrf_hash() ?>"
                    },
                    dataType: 'json',
                    success: function (res) {
                        if (res.status === 'success') {
                            location.reload();
                        }
                    },
                    error: function (error) {
                        console.error('Error : ', error);
                    }
                });
            }
        })


        $('#keyword').on('keyup', function () {
            LoadData();
        });
    });
</script>