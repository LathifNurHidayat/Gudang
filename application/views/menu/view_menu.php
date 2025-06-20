<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Data Menu
    </h2>
</div>

<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <a href="<?= site_url('menu/add_menu') ?>" class="btn btn-primary ">
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
            <div class="form-group mb-3 cool-12 col-md-6 col-lg-5">
                <label class="p-2">Search</label>
                <input type="text" class="form-control" name="keyword" id="keyword" placeholder="Masukan keyword">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter text-nowrap" id="table_menu">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>MENU</th>
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
    $(document).ready(function() {
        load_data();

        function load_data() {
            let keyword = $('#keyword').val();
            $.ajax({
                url: '<?= site_url('menu/get_menu') ?>',
                method: 'POST',
                data: {keyword : keyword, <?= $this->security->get_csrf_token_name();?> : "<?= $this->security->get_csrf_hash();?>"},
                dataType: 'json',
                success: function (data) {
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
                            <td>${item.menu}</td>
                            <td><a href="<?= site_url('menu/edit_menu/') ?>${item.id_menu}" class="btn btn-sm btn-warning">Edit</a></td>
                        </tr>
                        `;
                        });
                    }
                    $('#table_menu tbody').html(baris);
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching menu : ', error);
                    $('#table_menu tbody').html(
                        `<tr>
                        <td colspan="3">Gagal menggambil data menu</td>
                    </tr>`
                    )
                }
            });
        }


        $('#keyword').on('keyup', function(){
            load_data();
        });
    })
</script>