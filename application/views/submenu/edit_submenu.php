<div class="col">
    <div class="page-pretitle">
        Halaman
    </div>
    <h2 class="page-title">
        Edit submenu
    </h2>
</div>

<div class="col-8 mt-3">
    <div class="card">
        <div class="card-body">

            <?= $this->session->flashdata('msg'); ?>


            <form id="form_edit_submenu" class="m-3">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash(); ?>">

                <input type="hidden" value="<?= set_value('id_sub_menu', $submenu['id_sub_menu']) ?>" name="id_sub_menu">
                <div class="mb-3">
                    <label class="form-label">Menu</label>
                    <select name="id_menu" class="form-control">
                        <option value="">Pilih menu</option>
                        <?php foreach ($menu as $m): ?>
                            <option value="<?= $m['id_menu'] ?>" <?= set_select('id_menu', $m['id_menu'], $m['id_menu'] == $submenu['id_menu']) ?>>
                                <?= $m['menu'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-danger"  id="id_menu"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title"
                        value="<?= set_value('title', $submenu['title']) ?>">
                    <small class="text-danger" id="title"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Url</label>
                    <input type="text" class="form-control" name="url" value="<?= set_value('url', $submenu['url']) ?>">
                    <small class="text-danger" id="url"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="text" class="form-control" name="icon"
                        value="<?= set_value('icon', $submenu['icon']) ?>">
                    <small class="text-danger" id="icon"></small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Is active</label>
                    <select name="is_active" class="form-control">
                        <option value="1" <?= $submenu == 1 ? 'selected' : '' ?>>Aktif</option>
                        <option value="0" <?= $submenu == 0 ? 'selected' : '' ?>>Nonaktif</option>
                    </select> <small class="text-danger" id="is_active"></small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= site_url('menu/submenu') ?>" class="btn btn-warning">Kembali</a>
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
        update_data();

        function update_data() {
            $('#form_edit_submenu').on('submit', function(e){
                e.preventDefault();
                $('.text-danger').text('');
                $.ajax({
                    url: '<?= site_url('menu/update_submenu')?>',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(res){
                        if(res.status === 'error'){
                            $('#id_menu').text(res.error_msg.id_menu);
                            $('#title').text(res.error_msg.title);
                            $('#url').text(res.error_msg.url);
                            $('#icon').text(res.error_msg.icon);
                            $('#is_active').text(res.error_msg.is_active);
                        } else if (res.status === 'success'){
                            console.log(res.redirect);
                            window.location.href = res.redirect;
                        }
                    },
                    error: function(xhr, status, error){
                        console.error('Error :',error );
                        alert('Gagal mengirim data');
                    }
                });
            });
        }
    });
</script>