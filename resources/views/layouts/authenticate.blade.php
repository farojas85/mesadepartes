<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="adminlte/dist/css/adminlte.min.css">

  <style>
    body {
        /* Ubicación de la imagen */
        background-image: url('images/tramite.jpg');
        /* Para dejar la imagen de fondo centrada, vertical y
        horizontalmente */
        background-position: center center;
        /* Para que la imagen de fondo no se repita */
        background-repeat: no-repeat;
        /* La imagen se fija en la ventana de visualización para que la altura de la imagen no supere a la del contenido */
        background-attachment: fixed;
        /* La imagen de fondo se reescala automáticamente con el cambio del ancho de ventana del navegador */
        background-size: cover;
        /* Se muestra un color de fondo mientras se está cargando la imagen
        de fondo o si hay problemas para cargarla */
        background-color: #66999;
    }
    body:before {
        content:'';
        position: absolute;
            top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: rgba(0,0,0,0.6);
    }
  </style>
</head>
<body class="hold-transition login-page">
@yield('contenido')
<!-- /.login-box -->

<!-- jQuery -->
<script src="adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="adminlte/dist/js/adminlte.min.js"></script>
</body>
</html>
