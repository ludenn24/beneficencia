<?php

namespace App\Controllers;

use App\Models\Seccion;
use App\Models\SubSeccion;
use App\Controllers\Controller;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class SeccionesController extends Controller {

    public function getView($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/secciones.twig');
    }

    public function getMenu($request, $response, $args)
    {
        try {
            $estado = $request->getParam('estado');
            $data = Seccion::where('estado', $estado)->get();
            $arreglo["data"] = $data;
            return json_encode($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }

    public function getSubMenu($request, $response, $args)
    {
        try {
            $codigo = $request->getParam('codigo');
            $estado = $request->getParam('estado');
            $data = SubSeccion::where('id_seccion', $codigo)
            ->where(function ($q) use($estado) {
                if ($estado) {
                     $q->where('tb_sub_secciones.estado', $estado);
                }
            })
            ->get();
            $arreglo["data"] = $data;
            return json_encode($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }


    public function List($request, $response, $args) {
        try {
            $data = Seccion::orderBy('codigo', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
    public function Post($request, $response, $args) {
   
        $codigo = $request->getParam('codigo');
        if ($codigo) {
            Seccion::where('codigo', '=', $codigo)->update([
                    'nombre' => $request->getParam('nombre'),
                    'url' =>  $request->getParam('url'),
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro actualizado';
        } else {
            Seccion::create([
                    'nombre' => $request->getParam('nombre'),
                    'url' =>  $request->getParam('url'),
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro guardado';         
        }
        echo json_encode($mensaje);
       
    }


    
    public function ListarFront($request, $response, $args) {
        try {
            $data = Seccion::where('estado','1')
                    ->orderBy('codigo', 'DESC')->get();
            return $this->response->withJson($data);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
    public function Get($request, $response, $args) {
        try {
            $codigo = $request->getParam('codigo');
            $data = Seccion::where('codigo', '=', $codigo)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }

    public function GetSubSeccion($request, $response, $args) {
        try {
            $codigo = $request->getParam('codigo');
            $data = SubSeccion::where('codigo', '=', $codigo)->get();
            return $this->response->withJson($data, 200);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 200);
        }
    }

    public function PostSubSeccion($request, $response, $args) {
        $codigo = $request->getParam('codigo_subseccion');
        if ($codigo) {
                SubSeccion::where('codigo', '=', $codigo)->update([
                    'nombre' => $request->getParam('nombre_subseccion'),
                    'url' => $request->getParam('url_subseccion'),
                    'estado' => $request->getParam('estado_subseccion'),
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro actualizado';
        } else {
                SubSeccion::create([
                    'id_seccion' => $request->getParam('codigo_seccion'),
                    'nombre' => $request->getParam('nombre_subseccion'),
                    'url' => $request->getParam('url_subseccion'),
                    'estado' => $request->getParam('estado_subseccion'),
                ]);
                $mensaje['response'] = 'success';
                $mensaje['message'] = 'Registro guardado';         
        }
        echo json_encode($mensaje);
    }
    
    public function Updt($request, $response, $args)
    {
        $codigo=$request->getParam('codigo');
        Seccion::where('codigo', '=', $codigo)->update([
        'nombre' => $request->getParam('nombreedit'),
        'url' => $request->getParam('urledit'),
        'estado' => $request->getParam('estadoedi'),
        ]);
        
        $mensaje['response'] = 'success';
        $mensaje['message'] = 'Noticia actualizada';
        echo json_encode($mensaje);
    }

}
