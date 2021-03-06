<?php

class ControladorProductos
{
// MOSTRA PRODUCTOS

    public function ctrMostrarProductos($campo, $valor)
    {
        $tabla = "productos";
        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $campo, $valor);
        return $respuesta;
    }
    
// ALTA PRODUCTO
    public function ctrCrearProductos()
    {
        if (isset($_POST["nuevaDescripcion"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])) {

                $ruta = "vistas/img/productos/default/anonymous.png";

                if (isset($_FILES["nuevaImagen"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

                    $nuevoAncho = 350;
                    $nuevoAlto = 350;
                     // CREAMOS EL DIRECTORIO
                    $directorio = "vistas/img/productos/" . $_POST["nuevoCodigo"];
                    mkdir($directorio, 0755);

                     // APLICAMOS FUNCIONES SEGUN EL FORMATO
                    if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {
                        $ruta = "vistas/img/productos/" . $_POST["nuevoCodigo"] . "/" . $_POST["nuevoCodigo"] . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["nuevaImagen"]["type"] == "image/png") {
                        $ruta = "vistas/img/productos/" . $_POST["nuevoCodigo"] . "/" . $_POST["nuevoCodigo"] . ".png";
                        $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "productos";
                $datos = array(
                    "id_categoria" => $_POST["nuevaCategoria"],
                    "codigo" => $_POST["nuevoCodigo"],
                    "descripcion" => $_POST["nuevaDescripcion"],
                    "stock" => $_POST["nuevoStock"],
                    "precio_compra" => $_POST["nuevoPrecioCompra"],
                    "precio_venta" => $_POST["nuevoPrecioVenta"],
                    "imagen" => $ruta
                );

                $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

                if ($respuesta == "SI") {
                    echo
                        '<script>
                swal({
                    type: "success",
                    title: "¡El producto ha sido guardado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                }).then((result)=>{
                    if(result.value){
                        window.location = "productos";
                    }
                });
            </script>';
                }

            } else {
                echo
                    '<script>
                swal({
                    type: "error",
                    title: "¡El producto no puede tener campos vacio o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                })
            </script>';
            }
        }
    }

   // EDITAR PRODUCTO
    public function ctrEditarProductos()
    {
        if (isset($_POST["editarDescripcion"])) {
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarDescripcion"]) &&
                preg_match('/^[0-9]+$/', $_POST["editarStock"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
                preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])) {

                $ruta = "vistas/img/productos/default/anonymous.png";

                if (isset($_FILES["editarImagen"]["tmp_name"])) {
                    list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

                    $nuevoAncho = 350;
                    $nuevoAlto = 350;
                     // CREAMOS EL DIRECTORIO
                    $directorio = "vistas/img/productos/" . $_POST["editarCodigo"];

                    if (!empty($_POST["imagenActual"] && $_POST["imagenActual"]) != "vistas/img/productos/default/anonymous.png") {
                        unlink($_POST["imagenActual"]);
                    } else {
                        mkdir($directorio, 0755);
                    }

                     // APLICAMOS FUNCIONES SEGUN EL FORMATO
                    if ($_FILES["editarImagen"]["type"] == "image/jpeg") {
                        $ruta = "vistas/img/productos/" . $_POST["editarCodigo"] . "/" . $_POST["editarCodigo"] . ".jpg";
                        $origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }

                    if ($_FILES["editarImagen"]["type"] == "image/png") {
                        $ruta = "vistas/img/productos/" . $_POST["editarCodigo"] . "/" . $_POST["editarCodigo"] . ".png";
                        $origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }
                }

                $tabla = "productos";
                $datos = array(
                    "id_categoria" => $_POST["editarCategoria"],
                    "codigo" => $_POST["editarCodigo"],
                    "descripcion" => $_POST["editarDescripcion"],
                    "stock" => $_POST["editarStock"],
                    "precio_compra" => $_POST["editarPrecioCompra"],
                    "precio_venta" => $_POST["editarPrecioVenta"],
                    "imagen" => $ruta
                );

                $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

                if ($respuesta == "SI") {
                    echo
                        '<script>
                swal({
                    type: "success",
                    title: "¡El producto ha sido editado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                }).then((result)=>{
                    if(result.value){
                        window.location = "productos";
                    }
                });
            </script>';
                }

            } else {
                echo
                    '<script>
                swal({
                    type: "error",
                    title: "¡El producto no puede tener campos vacio o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                })
            </script>';
            }
        }
    }
    // BORRAR USUARIO
    public function ctrBorrarProducto()
    {
        if (isset($_GET["idProducto"])) {
            $tabla = "productos";
            $datos = $_GET["idProducto"];

            if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png") {
                unlink($_GET["imagen"]);
                rmdir('vistas/productos/' . $_GET["codigo"]);
            }

            $respuesta = ModeloProductos::mdlBorrarProducto($tabla, $datos);

            if ($respuesta == "SI") {
                echo
                    '<script>
                swal({
                    type: "success",
                    title: "¡El producto ha sido borrado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false,
                    position: "bottom-right"
                }).then((result)=>{
                    if(result.value){
                        window.location = "productos";
                    }
                });
            </script>';
            }
        }
    }
}