<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Data submenu
    </h2>
</div>

<div class="col-12 mt-3">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <a href="<?= site_url('menu/add_submenu') ?>" class="btn btn-primary ">
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
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter text-nowrap" id="table_submenu">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>MENU</th>
                            <th>TITLE</th>
                            <th>URL</th>
                            <th>ICON</th>
                            <th>IS ACTIVE</th>
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
        tampil_data();

        function tampil_data() {
            $.ajax({
                url: '<?= site_url('menu/get_submenu') ?>',
                method: 'GET',
                dataType: 'json',
                success: function (data){
                    let baris = '';
                    if (data.length == 0) {
                        baris += `
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data submenu</td>
                        </tr> `;
                    } else {
                        data.forEach(function (item, index) {
                            baris += `
                            <tr>
                                <td>${index + 1}</td>    
                                <td>${item.menu}</td>    
                                <td>${item.title}</td>    
                                <td>${item.url}</td>    
                                <td>${item.icon}</td>    
                                <td>${item.is_active == 1 ? 'Active' : 'Non Active'}</td>    
                                <td colspan="2">
                                    <a href="<?= site_url('menu/edit_submenu/') ?>${item.id_sub_menu}" class="btn btn-sm btn-warning" >Edit</a>
                                </td>    
                            </td>`;
                        });
                    };
                    $('#table_submenu tbody').html(baris);
                },
                error: function (xhr, status, error){
                    console.error('Error fetching submenu : ', error);
                    $('#table_submenu tbody').html(
                        `<tr>
                            <td colspan="7" class="text-center">Gagal memuat data submenu</td>
                        </tr>`
                    );
                }
            })
        }
    });
</script>