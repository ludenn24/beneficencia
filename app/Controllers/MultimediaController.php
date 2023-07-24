<?php

namespace App\Controllers;

use App\Models\Multimedia;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class MultimediaController extends Controller {

    public function getView($request, $response, $args){
        return $this->view->render($response, 'admin/auth/multimedia.twig');
    }

    public function Registrar($request, $response, $args) {
        $carpeta = "images/";
        $nombre = $request->getParam('url');
        $tipo = basename($_FILES["archivo"]["type"]);
        $size = basename($_FILES["archivo"]["size"]);
        $src = $carpeta . $nombre . "." . $tipo;
        $moveee = $_FILES["archivo"]["tmp_name"];
        if ($tipo != 'png' and
                $tipo != 'jpg' and
                $tipo != 'jpeg') {
            $mensaje['response'] = 'error';
            $mensaje['message'] = 'Solo se permiten archivos JPG, JPEG o PNG.';
        } elseif ($size >= 262144000) {
            $mensaje['response'] = 'error';
            $mensaje['message'] = 'Solo se permiten subir imágenes de menos de 25 Megabytes.';
        } elseif (move_uploaded_file($moveee, $src)) {
            Multimedia::create([
                'url' => $request->getParam('url'),
                'archivo' => $src,
            ]);
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Registro guardado';
        }
        echo json_encode($mensaje);
    }

    public function Listar($request, $response, $args) {
        try {
            $data = Multimedia::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formated'), 'tb_multimedia.*')
                    ->orderBy('codigo', 'DESC')
                    ->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
    public function ListarFront($request, $response, $args) {
        
        $origen = $request->getParam('origen');
        $texto = $request->getParam('texto');
        
        try {
            $data = Noticia::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formated'), 'tb_noticias.*')
                    ->where('estado','1')
                    ->where(function ($q) use($origen) {
                                if ($origen) {
                                    $q->where('categoria', 'like', '%' . $origen . '%');
                                }
                    })->where(function ($q) use($texto) {
                                if ($texto) {
                                    $q->where('titular', 'like', '%' . $texto . '%');
                                }
                    })->orderBy('codigo', 'DESC')->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
      public function ListarHome($request, $response, $args) {
        
        $origen = $request->getParam('origen');
        $texto = $request->getParam('texto');
        
        try {
            $data = Noticia::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formated'), 'tb_noticias.*')
                    ->where('estado','1')
                    ->where(function ($q) use($origen) {
                                if ($origen) {
                                    $q->where('categoria', 'like', '%' . $origen . '%');
                                }
                    })->where(function ($q) use($texto) {
                                if ($texto) {
                                    $q->where('titular', 'like', '%' . $texto . '%');
                                }
                    })->take(6)->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
      public function getViewDetalleNoticia($request, $response, $args){
        $codigo = $args['cod'];
        $noticia = Noticia::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formated'), 'tb_noticias.*')
            ->where('codigo', $codigo)
            ->first();
         $totalnoticia = Noticia::where('codigo', '!=', $codigo)
                 ->where('estado', 1)->get();

        return $this->view->render($response, 'templates/noticiadetalle.twig',[
            'noticia' => $noticia,
            'total' => $totalnoticia,
        ]);
    }

    public function GetMultimedia($request, $response, $args) {
        try {
            $codigo = $request->getParam('codigo');
            $data = Multimedia::where('codigo', '=', $codigo)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }
    
    public function Actualizar($request, $response, $args){

           $carpeta = "images/";
           $nombrerec1 = $request->getParam('urledit');
           $tiporec1 = basename($_FILES["archivoeditar"]["type"]);
           $sizerec1 = basename($_FILES["archivoeditar"]["size"]);

            if ($nombrerec1) {
            $srcec1 = $carpeta . $nombrerec1 . "." . $tiporec1;
            $moveeerec1 = $_FILES["archivoeditar"]["tmp_name"];
            if ($tiporec1 != 'png' and
                    $tiporec1 != 'jpg' and
                    $tiporec1 != 'jpeg') {
                $mensaje['response'] = 'error';
                $mensaje['message'] = 'Solo se permiten archivos JPG, JPEG O PNG';
            } elseif ($sizerec1 >= 262144000) {
                $mensaje['response'] = 'error';
                $mensaje['message'] = 'Solo se permiten subir archivos de menos de 25 Megabytes.';
            } elseif (move_uploaded_file($moveeerec1, $srcec1)){
                 $codigo=$request->getParam('codigo');
                 Multimedia::where('codigo', '=', $codigo)->update([
                 'url' => $request->getParam('urledit'),
                 'archivo' => $srcec1,  
                 ]);
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Archivo actualizada';
            }   
            }else{
                $codigo=$request->getParam('codigo');
                Multimedia::where('codigo', '=', $codigo)->update([
                'url' => $request->getParam('urledit'),
            ]);
           
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Archivo actualizada';
        }
        
       echo json_encode($mensaje);
    }

}
