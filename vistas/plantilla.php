<?php 
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inventario 1.0</title>
  <link rel="icon" href="vistas/img/plantilla/favicon.png">
  <!-- VALORES DEL CONENT PATA HACERLO RESPOSIVE -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!--================================================== *
 * ==========  PLUGINS DE CSS  ========== *
 * ================================================== -->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="vistas/plugins/iCheck/all.css">
 
  <!--================================================== *
 * ==========  PLUGINS DE JAVASCRIPT  ========== *
 * ================================================== -->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
  <!-- DataTables -->
  <script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
<!-- iCheck 1.0.1 -->
<script src="vistas/plugins/iCheck/icheck.min.js"></script>
</head>
<!--================================================== *
 * ==========  CUERPO DOCUMENTO  ========== *
 * ================================================== -->

<body class="hold-transition skin-blue sidebar-mini login-page">
  <?php 
  if (isset($_SESSION["sesion_iniciada"]) && $_SESSION["sesion_iniciada"] == "SI") {

      //  CABECERA

    echo '<div class="wrapper">';
    include('modulos/cabecera.php');

    // MENU

    include('modulos/menu.php');
 
    // CONTENIDO 
    if (isset($_GET['ruta'])) {
      if ($_GET['ruta'] == 'inicio' ||
        $_GET['ruta'] == 'usuarios' ||
        $_GET['ruta'] == 'categorias' ||
        $_GET['ruta'] == 'productos' ||
        $_GET['ruta'] == 'clientes' ||
        $_GET['ruta'] == 'nueva-venta' ||
        $_GET['ruta'] == 'gestion-ventas' ||
        $_GET['ruta'] == 'informes-ventas' ||
        $_GET['ruta'] == 'salir') {
        include('modulos/' . $_GET['ruta'] . '.php');
      } else {
        include('modulos/404.php');
      }
    } else {
      include('modulos/inicio.php');
    }

    
  // FOOTER 

    include('modulos/footer.php');
    echo "</div>";
  } else {
    include('modulos/login.php');
  }

  ?>
  <!-- Menu sidebar -->
  <script src="vistas/js/plantilla.js"></script>
  <!-- Usuario -->
  <script src="vistas/js/usuario.js"></script>
  <!-- Categoria -->
  <script src="vistas/js/categorias.js"></script>
  <!-- Categoria -->
  <script src="vistas/js/clientes.js"></script>
  <!-- Productos -->
  <script src="vistas/js/productos.js"></script>
</body>

</html>