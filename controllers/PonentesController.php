<?php

namespace Controllers;

use Classes\Paginacion;
use Model\Ponente;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {
    public static function index (Router $router){
        if(!is_admin()){
            header('Location: /login');
        }

        //Página actual la coge por URL
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        //Validamos que la página actual sea un entero y que sea mayor que uno
        if(!$pagina_actual || $pagina_actual<1){
            header('Location: /admin/ponentes?page=1');
        }
        
        //El número de registros por página lo ponemos nosotros
        $registros_por_pagina = 10;

        //Los registros totales los cogemos haciendo una consulta a la BBDD 
        $registros_totales = Ponente::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $registros_totales);

        if($paginacion->total_paginas() < $pagina_actual){
            header('Location: /admin/ponentes?page=1');
        }

        $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());

        if(!is_admin()){
            header('Location: /login');
        }

        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Conferenciantes',
            'ponentes' => $ponentes,
            'paginacion' => $paginacion->paginacion()
        ] );
    }

    public static function crear (Router $router){
        if(!is_admin()){
            header('Location: /login');
        }

        $alertas=[];
        $ponente= new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header('Location: /login');
            }

            //Leer imagen
            if(!empty($_FILES['imagen']['tmp_name'])){
                //generamos una carpeta para las imágenes
                $carpeta_imagenes = '../public/img/ponentes';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true); //ese número son los permisos. Si no sube imágenes, se puede elevar el permiso
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true)); //Genera un nombre aleatorio para todas las versiones de la imagen

                $_POST['imagen'] = $nombre_imagen; //Pasamos la validación
            } 

            $_POST ['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);

            //Sincronizamos
            $ponente->sincronizar($_POST);

            //Validamos
            $alertas=$ponente->validar();

            //Guardamos la imagen en la carpeta y en la BBDD
            if(empty($alertas)){
                //Guardar las imágenes
                $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");

                //Guardar en la BBDD
                $resultado = $ponente -> guardar();

                if($resultado){
                    header('Location: /admin/ponentes');
                }
            }
        }
        
        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ] );
    }

    public static function editar (Router $router){
        if(!is_admin()){
            header('Location: /login');
        }
        $alertas = [];

        //Validar ID
        $id=$_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id){
            header('Location: /admin/ponentes');
        }

        //Obtener el ponente a editar
        $ponente = Ponente::find($id);

        if(!$ponente){
            header('Location: /admin/ponentes');
        };

        $ponente->imagen_actual = $ponente->imagen;

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header('Location: /login');
            }
            //Revisamos si hay una nueva imagen
            if(!empty($_FILES['imagen']['tmp_name'])){
                //generamos una carpeta para las imágenes
                $carpeta_imagenes = '../public/img/ponentes';

                //Crear la carpeta si no existe
                if(!is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes, 0777, true); //ese número son los permisos. Si no sube imágenes, se puede elevar el permiso
                }

                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                $nombre_imagen = md5(uniqid(rand(), true)); //Genera un nombre aleatorio para todas las versiones de la imagen

                $_POST['imagen'] = $nombre_imagen; //Pasamos la validación
            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            $_POST ['redes'] = json_encode($_POST['redes'], JSON_UNESCAPED_SLASHES);
            $ponente->sincronizar($_POST);

            $alertas = $ponente->validar();

            if(empty($alertas)){
                if(isset($nombre_imagen)){
                    $imagen_png->save($carpeta_imagenes . '/' . $nombre_imagen . ".png");
                    $imagen_webp->save($carpeta_imagenes . '/' . $nombre_imagen . ".webp");
                }

                $resultado = $ponente->guardar();

                if($resultado){
                    header('Location: /admin/ponentes');
                }
            }

        }

        $router->render('admin/ponentes/editar', [
            'titulo' => 'Actualizar ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => json_decode($ponente->redes)
        ] );
    }

    public static function eliminar (){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!is_admin()){
                header('Location: /login');
            }
            $id = $_POST['id'];
            $ponente = Ponente::find($id);

            if(!isset($ponente)){
                header('Location: /admin/ponentes');
            }

            $resultado = $ponente->eliminar();

            if($resultado){
                header('Location: /admin/ponentes');
            }
        }
    }
}