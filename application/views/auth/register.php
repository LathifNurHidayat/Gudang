<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login | Gudang</title>


    <link href="<?= base_url() ?>assets/dist/css/tabler.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/dist/css/tabler-flags.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/dist/css/tabler-payments.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/dist/css/tabler-vendors.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/dist/css/demo.min.css" rel="stylesheet" />
    <style>
        body {
            display: none;
        }
    </style>
</head>

<body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex flex-column justify-content-center py-4">
        <div class="container-tight py-6">
            <?= form_open("auth/cek_register", ["class" => "card card-md"]); ?>
            <div class="card-body">
                <div class="text-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" height="50" width="50" viewBox="0 0 448 512">
                        <path
                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z" />
                    </svg>
                </div>
                <div class="mb-2">
                    <?= $this->session->flashdata('msg'); ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama lengkap</label>
                    <input type="text" class="form-control" name="fullname" placeholder="Masukan nama lengkap"
                        autocomplete="off" >
                    <small class="text-danger"><i><?= form_error('fullname') ?></i></small>

                </div>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Masukan username"
                        autocomplete="off" >
                    <small class="text-danger"><i><?= form_error('username') ?></i></small>

                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Password
                    </label>
                    <input type="password" class="form-control" name="password" placeholder="Masukan password"
                        autocomplete="off" >
                    <small class="text-danger"><i><?= form_error('password') ?></i></small>

                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
            </div>
            <?= form_close() ?>
            <div class="text-center text-muted mt">
                Sudah punya akun? <a href="<?= site_url('auth/form_login') ?>" tabindex="-1">Login</a>
            </div>

        </div>
    </div>
    <script src="<?= base_url() ?>assets/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>assets/dist/js/tabler.min.js"></script>
    <script>
        document.body.style.display = "block"
    </script>

</body>

</html>