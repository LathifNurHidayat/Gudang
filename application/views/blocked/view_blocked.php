
<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-alpha.14
* @link https://tabler.io
* Copyright 2018-2020 The Tabler Authors
* Copyright 2018-2020 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Blocked</title>
    <!-- CSS files -->
    <link href="<?= base_url()?>assets/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="<?= base_url()?>assets/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="<?= base_url()?>assets/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="<?= base_url()?>assets/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="<?= base_url()?>assets/dist/css/demo.min.css" rel="stylesheet"/>
    <style>
      body {
      	display: none;
      }
    </style>
  </head>
  <body class="antialiased border-top-wide border-primary d-flex flex-column">
    <div class="flex-fill d-flex align-items-center justify-content-center">
      <div class="container-tight py-6">
        <div class="empty">
          <div class="empty-header">Blocked</div>
          <p class="empty-title">Oops… Mainmu kejauhan</p>
          <p class="empty-subtitle text-muted">
            Kamu ga punya akses ke sini bro
          </p>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <script src="<?= base_url()?>assets/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tabler Core -->
    <script src="<?= base_url()?>assets/dist/js/tabler.min.js"></script>
    <script>
      document.body.style.display = "block"
    </script>
  </body>
</html>