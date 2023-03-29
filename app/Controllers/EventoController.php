<?php

namespace App\Controllers;

use App\Models\Evento;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class EventoController extends Controller {

    public function Registrar($request, $response, $args) {
        $carpeta = "uploads/";
        $nombre = basename($_FILES["foto"]["name"]);
        $fecha_actual = date('Y-m-d-H-i-s');
        $src = $carpeta . $fecha_actual . '_' . $nombre;
        $tipo = basename($_FILES["foto"]["type"]);
        $size = basename($_FILES["foto"]["size"]);
        $moveee = $_FILES["foto"]["tmp_name"];

        if ($tipo != 'png' and
                $tipo != 'jpg' and
                $tipo != 'jpeg') {
            $mensaje['response'] = 'error';
            $mensaje['message'] = 'Solo se permiten archivos JPG, JPEG o PNG.';
        } elseif ($size >= 262144000) {
            $mensaje['response'] = 'error';
            $mensaje['message'] = 'Solo se permiten subir imágenes de menos de 25 Megabytes.';
        } elseif (move_uploaded_file($moveee, $src)) {
            
            $portada = $request->getParam('principal');
            if ($portada) {
                $portada = 1;
            } else {
                $portada = 0;
            }
            Evento::create([
                'categoria' => $request->getParam('categoria'),
                'nombre' => $request->getParam('nombre'),
                'descripcion' => $request->getParam('descripcion'),
                'fecha' => $request->getParam('fecha'),
                'hora' => $request->getParam('hora'),
                'lugar' => $request->getParam('lugar'),
                'detalle' => $request->getParam('detalle'),
                'foto' => $src,
            ]);
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Registro guardado';
        }
        echo json_encode($mensaje);
    }

    public function Listar($request, $response, $args) {
        try {
            $data = Evento::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formated'), 'tb_eventos.*')
                    ->orderBy('codigo', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
    public function ListarFront($request, $response, $args) {
        
        $origen = $request->getParam('origen');
        
        try {
            $data = Evento::select(DB::raw('DATE_FORMAT(fecha, "%d") as dia, DATE_FORMAT(fecha, "%b") as mes'), 'tb_eventos.*')
                    ->where('estado','1')
                    ->where(function ($q) use($origen) {
                                if ($origen) {
                                    $q->where('categoria', 'like', '%' . $origen . '%');
                                }
                    })->take(6)->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    


    public function getEvento($request, $response, $args) {
        try {
            $codigo = $request->getParam('codigo');
            $data = Evento::where('codigo', '=', $codigo)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }
    
    public function Actualizar($request, $response, $args)
    {

           $carpeta = "uploads/";
           $fecha_actual = date('Y-m-d-H-i-s');
           $nombrerec1 = basename($_FILES["fotoeditar"]["name"]);
           
            if ($nombrerec1) {
                
            $srcec1 = $carpeta . $fecha_actual . '_' . $nombrerec1;
            $tiporec1 = basename($_FILES["fotoeditar"]["type"]);
            $sizerec1 = basename($_FILES["fotoeditar"]["size"]);
            $moveeerec1 = $_FILES["fotoeditar"]["tmp_name"];
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
                Evento::where('codigo', '=', $codigo)->update([
                 'categoria' => $request->getParam('categoriaeditar'),
                'nombre' => $request->getParam('nombreeditar'),
                'descripcion' => $request->getParam('descripcioneditar'),
                'fecha' => $request->getParam('fechaeditar'),
                'hora' => $request->getParam('horaeditar'),
                'lugar' => $request->getParam('lugareditar'),
                'detalle' => $request->getParam('detalleeditar'),
                'estado' => $request->getParam('estadoedi'),
                'foto' => $srcec1,
                 ]);
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Noticia actualizada';
            }
            
        }else{
            
               $codigo=$request->getParam('codigo');
                Evento::where('codigo', '=', $codigo)->update([
                'categoria' => $request->getParam('categoriaeditar'),
                'nombre' => $request->getParam('nombreeditar'),
                'descripcion' => $request->getParam('descripcioneditar'),
                'fecha' => $request->getParam('fechaeditar'),
                'hora' => $request->getParam('horaeditar'),
                'lugar' => $request->getParam('lugareditar'),
                'detalle' => $request->getParam('detalleeditar'),
                'estado' => $request->getParam('estadoedi'),
            ]);
           
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Noticia actualizada';
        }
        
       echo json_encode($mensaje);
    }

}
