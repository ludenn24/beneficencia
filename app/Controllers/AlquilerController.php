<?php

namespace App\Controllers;

use App\Models\Alquiler;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class AlquilerController extends Controller {

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
            
            Alquiler::create([
                'condicion' => $request->getParam('condicion'),
                'distrito' => $request->getParam('distrito'),
                'area' => $request->getParam('area'),
                'tipo_uso' => $request->getParam('tipo_uso'),
                'modalidad' => $request->getParam('modalidad'),
                'numero' => $request->getParam('numero'),
                'nombre' => $request->getParam('nombre'),
                'precio' => $request->getParam('precio'),
                'moneda' => $request->getParam('moneda'),
                'latitud' => $request->getParam('latitud'),
                'longitud' => $request->getParam('longitud'),
                'foto' => $src,
            ]);
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Registro guardado';
        }
        echo json_encode($mensaje);
    }

    public function Listar($request, $response, $args) {
        try {
            $data = Alquiler::select(DB::raw('DATE_FORMAT(created_at, "%d-%b-%Y") as formated'), 'tb_inmobiliaria.*')
                    ->orderBy('codigo', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    

    public function getAlquiler($request, $response, $args) {
        try {
            $codigo = $request->getParam('codigo');
            $data = Alquiler::where('codigo', '=', $codigo)->get();
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
           $nombrerec1 = basename($_FILES["fotoedit"]["name"]);
           
            if ($nombrerec1) {
                
            $srcec1 = $carpeta . $fecha_actual . '_' . $nombrerec1;
            $tiporec1 = basename($_FILES["fotoedit"]["type"]);
            $sizerec1 = basename($_FILES["fotoedit"]["size"]);
            $moveeerec1 = $_FILES["fotoedit"]["tmp_name"];
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
                Alquiler::where('codigo', '=', $codigo)->update([
                'condicion' => $request->getParam('condicionedit'),
                'distrito' => $request->getParam('distritoedit'),
                'area' => $request->getParam('areaedit'),
                'tipo_uso' => $request->getParam('tipo_usoedit'),
                'modalidad' => $request->getParam('modalidadedit'),
                'numero' => $request->getParam('numeroedit'),
                'nombre' => $request->getParam('nombreedit'),
                'precio' => $request->getParam('precioedit'),
                'moneda' => $request->getParam('monedaedit'),
                'latitud' => $request->getParam('latitudedit'),
                'longitud' => $request->getParam('longitudedit'),
                'foto' => $srcec1,
                 ]);
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Noticia actualizada';
            }
            
        }else{
            
               $codigo=$request->getParam('codigo');
                Alquiler::where('codigo', '=', $codigo)->update([
                'condicion' => $request->getParam('condicionedit'),
                'distrito' => $request->getParam('distritoedit'),
                'area' => $request->getParam('areaedit'),
                'tipo_uso' => $request->getParam('tipo_usoedit'),
                'modalidad' => $request->getParam('modalidadedit'),
                'numero' => $request->getParam('numeroedit'),
                'nombre' => $request->getParam('nombreedit'),
                 'precio' => $request->getParam('precioedit'),
                'moneda' => $request->getParam('monedaedit'),
                'latitud' => $request->getParam('latitudedit'),
                'longitud' => $request->getParam('longitudedit'),
            ]);
           
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Noticia actualizada';
        }
        
       echo json_encode($mensaje);
    }

        
    public function ListarFront($request, $response, $args) {
        
        $tipo = $request->getParam('tipo');
        $distrito = $request->getParam('distrito');
        
        try {
            $data = Alquiler::
                    where('estado','1')->
                    where('condicion','1')
                    ->where(function ($q) use($tipo) {
                                if ($tipo) {
                                    $q->where('tipo_uso',$tipo);
                                }
                    })->where(function ($q) use($distrito) {
                                if ($distrito) {
                                    $q->where('distrito', $distrito);
                                }
                    })->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
            
    public function ListarDistritos($request, $response, $args) {
        
        try {
              $data = Alquiler::
                    where('estado','1')->
                    where('condicion','1')->groupBy('distrito')->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
}
