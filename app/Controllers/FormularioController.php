<?php

namespace App\Controllers;

use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;
use App\Models\Formulario;
use App\Controllers\Controller;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;

Class FormularioController extends Controller {

    //VARIANTE DE ALERTAS
    function show($type, $string) {
        $div = '';
        if ($type == 1) {
            $div = '<div class="alert alert-danger" role="alert">
                  <a href="#" class="alert-link">' . $string . '</a>
                </div>';
        }
        if ($type == 2) {
            $div = '<div id="login-status" class="warn-notice">
            <div class="content-wrapper">
                <div id="login-detail">
                    <div id="login-status-icon-container"><i class="fa fa-exclamation-triangle"></i></div>
                    <div id="login-status-message">' . $string . '</div>
                </div>
            </div>
        </div>';
        }

        if ($type == 3) {
            $div = '<div id="login-status" class="info-notice">
            <div class="content-wrapper">
                <div id="login-detail">
                    <div id="login-status-icon-container"><span class="login-status-icon"></span></div>
                    <div id="login-status-message">' . $string . '</div>
                </div>
            </div>
        </div>';
        }

        if ($type == 4) {
            $div = '<div class="alert alert-success"><i class="fa fa-check"></i> ' . $string . '</div>';
        }
        return $div;
    }

    public function Registrar($request, $response, $args) {
        $t1 = $request->getParam('tiempovoluntario');
        if ($t1) {
            $t1 = $request->getParam('tiempovoluntario');
        } else {
            $t1 = "";
        }
        Formulario::create([
            'categoria' => $request->getParam('categoria'),
            'nombres' => $request->getParam('nombres'),
            'apellidos' => $request->getParam('apellidos'),
            'dni' => $request->getParam('dni'),
            'correo' => $request->getParam('correo'),
            'telefono' => $request->getParam('telefono'),
            'direccion' => $request->getParam('direccion'),
            'motivo' => $request->getParam('motivo'),
            'mensaje' => $request->getParam('mensaje'),
            'tipodonacion' => $request->getParam('tipodonacion'),
            'tiempovoluntario' => $request->getParam('tiempovoluntario'),
        ]);
        $mensaje['response'] = 'success';
        $mensaje['message'] = 'Su mensaje fue registrado con éxito';
        echo json_encode($mensaje);
    }

    public function Listar($request, $response, $args) {
        try {
            $data = Formulario::get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

    public function Atender($request, $response, $args) {
        try {
            $codigo = $request->getParam('codigo');
            $estado = $request->getParam('estado');
            $observacion = $request->getParam('observacion');
            $existe = Formulario::where('codigo', '=', $codigo)->where('estado', '=', 2)->first();
            if ($existe) {
                $msm['response'] = 'aprobado';
                echo json_encode($msm);
            } else {
                Formulario::where('codigo', '=', $codigo)->update([
                    'observacion' => $observacion,
                    'estado' => $estado,
                ]);
                $msm['response'] = 'atendido';
                echo json_encode($msm);
            }
        } catch (ErrorException $e) {
            $data = "Ocurrió un error.";
            echo $data;
        }
    }

    public function ListarDonaciones($request, $response, $args) {

        $origen = $request->getParam('origen');

        try {
            $data = Formulario::
                            where('motivo', 'Donación')->
                            where(function ($q) use($origen) {
                                if ($origen) {
                                    $q->where('categoria', 'like', '%' . $origen . '%');
                                }
                            })
                            ->orderBy('tb_formulario.created_at', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

    public function ListarVoluntariado($request, $response, $args) {

        $origen = $request->getParam('origen');

        try {
            $data = Formulario::
                            where('motivo', 'Voluntariado')->
                            where(function ($q) use($origen) {
                                if ($origen) {
                                    $q->where('categoria', 'like', '%' . $origen . '%');
                                }
                            })
                            ->orderBy('tb_formulario.created_at', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }
    
        public function ListarMensajes($request, $response, $args) {

        $origen = $request->getParam('origen');

        try {
            $data = Formulario::select('tb_formulario.codigo as codigoform',
                     'tb_inmobiliaria.nombre as nombreinmo',
                     'tb_formulario.nombres as nombresform',
                     'tb_formulario.apellidos as apellidosform',
                     'tb_formulario.dni as dniform',
                     'tb_formulario.correo as correoform',
                     'tb_formulario.telefono as telefonoform',
                     'tb_formulario.direccion as direccionform',
                     'tb_formulario.mensaje as mensajeform',
                     'tb_formulario.estado as estadoform')->join('tb_inmobiliaria', 'tb_formulario.categoria', '=', 'tb_inmobiliaria.codigo')->
                            where('motivo', 'Inmuebles')->
                            where(function ($q) use($origen) {
                                if ($origen) {
                                    $q->where('tb_formulario.categoria', 'like', '%' . $origen . '%');
                                }
                            })
                            ->orderBy('tb_formulario.created_at', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

    public function ListarConsultas($request, $response, $args) {

        $origen = $request->getParam('origen');

        try {
            $data = Formulario::
                            where('motivo', 'Consulta')->
                            where(function ($q) use($origen) {
                                if ($origen) {
                                    $q->where('categoria', 'like', '%' . $origen . '%');
                                }
                            })
                            ->orderBy('tb_formulario.created_at', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

}
