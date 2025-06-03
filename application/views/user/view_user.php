<div class="col">
    <!-- Page pre-title -->
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Data User
    </h2>
</div>

<div class="col-12 mt-3">
    <div class="card">
        <div class="container mt-2">
            <?= $this->session->flashdata('msg') ?>
        </div>
        <div class="card-body">
            <div class="form-group mb-3 col-12 col-md-6 col-lg-5">
                <label class="p-2">Search</label>
                <input type="text" class="form-control" id="keyword" placeholder="Masukan keyword">
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter text-nowrap" id="table_user">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>USERNAME</th>
                            <th>NAMA LENGKAP</th>
                            <th>IS AKTIF</th>
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
        loadData();

        function loadData() {
            let keyword = $('#keyword').val(); 
            $.ajax({
                url: '<?= site_url('user/get_user') ?>',
                method: 'POST',
                data: {keyword : keyword, <?= $this->security->get_csrf_token_name()?> : "<?= $this->security->get_csrf_hash()?>"},
                dataType: 'json',
                success: function (data) {
                    let baris = '';
                    if (data.length == 0) {
                        baris += `
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data</td> 
                        </tr>`;
                    } else {
                        data.forEach(function (item, index) {
                            const isCurrentUser = <?= $this->session->userdata('id_user') ?> == item.id_user
                            baris += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.username}</td>
                                <td>${item.fullname}</td>
                                <td>
                                    <span class="badge badge-md ${item.is_active == 'aktif' ? 'bg-green' : 'bg-red'}">
                                    ${item.is_active}
                                    </span>
                                </td>
                                <td colspan="2">
                                    ${!isCurrentUser ? `<a href="<?= site_url('user/edit_user/')?>${item.id_user}" class="btn btn-sm btn-warning">Edit</a>` : '--'}                                
                                </td>
                            </tr>
                            `;
                        })
                    }
                    $('#table_user tbody').html(baris);
                },
                error: function(error) {
                    console.error('Error : ', error);
                }
            });
        }


        $('#keyword').on('keyup', function(){
            loadData();
        })
    })
</script>