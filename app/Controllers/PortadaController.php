<?php

namespace App\Controllers;

use App\Models\Portada;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class PortadaController extends Controller {

     public function Registrar($request, $response, $args) {
        $carpeta = "uploads/portada/";
        $nombre = basename($_FILES["foto"]["name"]);
        $fecha_actual = date('Y-m-d-H-i-s');
        $src = $carpeta . $fecha_actual . '_' . $nombre;
        $tipo = basename($_FILES["foto"]["type"]);
        $size = basename($_FILES["foto"]["size"]);
        $moveee = $_FILES["foto"]["tmp_name"];
        
        $codigo = $request->getParam('codigo');
           if ($codigo) {
            if ($nombre) {
                if ($tipo != 'png' and
                        $tipo != 'jpg' and
                        $tipo != 'jpeg') {
                    $mensaje['response'] = 'error';
                    $mensaje['message'] = 'Solo se permiten archivos JPG, JPEG o PNG.';
                } elseif ($size >= 262144000) {
                    $mensaje['response'] = 'error';
                    $mensaje['message'] = 'Solo se permiten subir imágenes de menos de 25 Megabytes.';
                } elseif (move_uploaded_file($moveee, $src)) {
                        Portada::where('codigo', '=', $codigo)->update([
                        'nombre' => $request->getParam('nombre'),
                        'link' => $request->getParam('link'),
                        'inicio' => $request->getParam('inicio'),
                        'fin' => $request->getParam('fin'),
                        'estado' => $request->getParam('estado'),
                        'foto' => $src,
                    ]);
                    $mensaje['response'] = 'success';
                    $mensaje['message'] = 'Registro guardado';
                }
            } else {
                    Portada::where('codigo', '=', $codigo)->update([
                        'nombre' => $request->getParam('nombre'),
                        'link' => $request->getParam('link'),
                        'inicio' => $request->getParam('inicio'),
                        'fin' => $request->getParam('fin'),
                        'estado' => $request->getParam('estado'),
                    ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro guardado';
            }
        } else {

            if ($tipo != 'png' and
                    $tipo != 'jpg' and
                    $tipo != 'jpeg') {
                $mensaje['response'] = 'error';
                $mensaje['message'] = 'Solo se permiten archivos JPG, JPEG o PNG.';
            } elseif ($size >= 262144000) {
                $mensaje['response'] = 'error';
                $mensaje['message'] = 'Solo se permiten subir imágenes de menos de 25 Megabytes.';
            } elseif (move_uploaded_file($moveee, $src)) {
                Portada::create([
                        'nombre' => $request->getParam('nombre'),
                        'link' => $request->getParam('link'),
                        'inicio' => $request->getParam('inicio'),
                        'fin' => $request->getParam('fin'),
                        'estado' => $request->getParam('estado'),
                        'foto' => $src,
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro guardado';
            }
        }
        echo json_encode($mensaje);
        
    }

    public function Listar($request, $response, $args) {
        try {
            $data = Portada::where('estado', '!=', 3)
                    ->orderBy('created_at', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

    public function getPortada($request, $response, $args) {
        try {
            $codigo = $request->getParam('codigo');
            $data = Portada::where('codigo', '=', $codigo)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }

    public function getPortadasHabilitadas()
    {
        return Portada::where('estado', 1)->get();
    }
    


}
