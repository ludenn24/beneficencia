<?php

namespace App\Controllers;

use App\Models\Pagina;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class PaginasController extends Controller {

    public function getViewPaginas($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/paginas.twig');
    }

    public function ListPagina($request, $response, $args) {
        try {
            $data = Pagina::orderBy('codigo', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
    public function PostPagina($request, $response, $args) {

        $carpeta = "uploads/paginas/";
        $nombre = basename($_FILES["portada"]["name"]);
        $ext = pathinfo($nombre, PATHINFO_EXTENSION);
        $fecha_actual = date('Y-m-d-H-i-s');
        $src = $carpeta . $fecha_actual . '.' . $ext;
        $tipo = basename($_FILES["portada"]["type"]);
        $size = basename($_FILES["portada"]["size"]);
        $moveee = $_FILES["portada"]["tmp_name"];

        if ($tipo != 'png' and
                $tipo != 'jpg' and
                $tipo != 'jpeg') {
            $mensaje['response'] = 'error';
            $mensaje['message'] = 'Solo se permiten archivos JPG, JPEG o PNG.';
        } elseif ($size >= 262144000) {
            $mensaje['response'] = 'error';
            $mensaje['message'] = 'Solo se permiten subir imágenes de menos de 25 Megabytes.';
        } elseif (move_uploaded_file($moveee, $src)) {
            Pagina::create([
                'nombre' => $request->getParam('nombre'),
                'detalle' => $request->getParam('detalle'),
                'portada' => $src,
            ]);
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Registro guardado';
        }
        echo json_encode($mensaje);
    }

    public function getViewPagina($request, $response, $args)
    {
        $codigo = $args['cod'];
        $pagina = Pagina::where('url_canonica', $codigo)->first();
        return $this->view->render($response, 'templates/detalle.twig',[
            'pagina' => $pagina,
        ]);
    }

    public function GetPagina($request, $response, $args) {
        try {
            $codigo = $request->getParam('codigo');
            $data = Pagina::where('codigo', '=', $codigo)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }
    
    public function UptPagina($request, $response, $args)
    {

           $carpeta = "uploads/paginas/";
           $fecha_actual = date('Y-m-d-H-i-s');
           $nombrerec1 = basename($_FILES["portadaeditar"]["name"]);
           $ext = pathinfo($nombrerec1, PATHINFO_EXTENSION);
            if ($nombrerec1) {
                
            $srcec1 = $carpeta . $fecha_actual . '.' . $ext;
            $tiporec1 = basename($_FILES["portadaeditar"]["type"]);
            $sizerec1 = basename($_FILES["portadaeditar"]["size"]);
            $moveeerec1 = $_FILES["portadaeditar"]["tmp_name"];
            if ($tiporec1 != 'png' and
                    $tiporec1 != 'jpg' and
                    $tiporec1 != 'jpeg') {
                $mensaje['response'] = 'error';
                $mensaje['message'] = $this->show('1', 'Solo se permiten archivos JPG, JPEG O PNG');
            } elseif ($sizerec1 >= 262144000) {
                $mensaje['response'] = 'error';
                $mensaje['message'] = $this->show('1', 'Solo se permiten subir archivos de menos de 25 Megabytes.');
            } elseif (move_uploaded_file($moveeerec1, $srcec1)){
                
                 $codigo=$request->getParam('codigo');
                Pagina::where('codigo', '=', $codigo)->update([
                'nombre' => $request->getParam('nombreedit'),
                'estado' => $request->getParam('estadoedi'),
                'detalle' => $request->getParam('detalleeditar'),
                'title' => $request->getParam('title_edit'),
                'url_canonica' => $request->getParam('url_canonica_edit'),
                'descripcion' => $request->getParam('descripcion_edit'),
                'keywords' => $request->getParam('keywords_edit'),
                'portada' => $srcec1,
                 ]);
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Noticia actualizada';
            }
            
        }else{
               $codigo=$request->getParam('codigo');
               Pagina::where('codigo', '=', $codigo)->update([
                'nombre' => $request->getParam('nombreedit'),
                'estado' => $request->getParam('estadoedi'),
                'detalle' => $request->getParam('detalleeditar'),
                'title' => $request->getParam('title_edit'),
                'url_canonica' => $request->getParam('url_canonica_edit'),
                'descripcion' => $request->getParam('descripcion_edit'),
                'keywords' => $request->getParam('keywords_edit'),
            ]);
           
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Noticia actualizada';
        }
        
       echo json_encode($mensaje);
    }

}
