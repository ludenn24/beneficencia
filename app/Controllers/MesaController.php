<?php

namespace App\Controllers;

use App\Helper\JsonRequest;
use App\Helper\JsonRenderer;
use App\Models\Mesa;
use App\Controllers\Controller;
use Illuminate\Database\Capsule\Manager as DB;
use Respect\Validation\Validator as v;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

Class MesaController extends Controller {

    public function Registrar($request, $response, $args) {
        date_default_timezone_set('America/Lima');        
        $hoy = getdate();
        if ($hoy['weekday']=='Monday' or $hoy['weekday']=='Tuesday' or $hoy['weekday']=='Wednesday' or $hoy['weekday']=='Thursday' or $hoy['weekday']=='Friday'){
        $ahora = date("H:i:s");
        $horacomienzo = '08:30:00';
        $horafin = '19:30:00';
        $ahora_time = strtotime($ahora);
        $horacomienzo_time = strtotime($horacomienzo);
        $horafin_time = strtotime($horafin);

        if($ahora_time >= $horacomienzo_time && $ahora_time <= $horafin_time){
        $carpeta = "uploads/mesa/";
        $tipo_persona = $request->getParam('txt_representacion');
        $natural_tipo_doc = $request->getParam('natural_tipo_doc');
        $natural_dni = $request->getParam('natural_dni');
        $natural_nombres = $request->getParam('natural_nombres');
        $natural_apellidos = $request->getParam('natural_apellidos');
        $natural_departamento = $request->getParam('natural_departamento');
        $natural_provincia = $request->getParam('natural_provincia');
        $natural_distrito = $request->getParam('natural_distrito');
        $natural_direccion = $request->getParam('natural_direccion');

        $juridico_ruc = $request->getParam('juridico_ruc');
        $juridico_nombre_empresa = $request->getParam('juridico_nombre_empresa');
        $juridico_departamento = $request->getParam('juridico_departamento');
        $juridico_provincia = $request->getParam('juridico_provincia');
        $juridico_distrito = $request->getParam('juridico_distrito');
        $juridico_direccion = $request->getParam('juridico_direccion');
        $juridico_tipo_doc_rep = $request->getParam('juridico_tipo_doc_rep');
        $juridico_dni_rep = $request->getParam('juridico_dni_rep');
        $juridico_nombre_rep = $request->getParam('juridico_nombre_rep');
        $juridico_ape_rep = $request->getParam('juridico_ape_rep');

        $correo = $request->getParam('correo');
        $telefono = $request->getParam('telefono');
        $asunto = $request->getParam('motivo');
        $contenido = $request->getParam('mensaje');
        $doc_extra = $request->getParam('doc_extra');
        $nombredoc = basename($_FILES["documento"]["name"]);
        $fecha_actual = date('Y-m-d-H-i-s');
        $src = $carpeta . $fecha_actual . '_' . $nombredoc;
        if ($nombredoc) {
            $tipo = basename($_FILES["documento"]["type"]);
            $size = basename($_FILES["documento"]["size"]);
            $moveee = $_FILES["documento"]["tmp_name"];
            if ($tipo != 'png' and
                $tipo != 'jpg' and
                $tipo != 'msword' and
                $tipo != 'vnd.openxmlformats-officedocument.wordprocessingml.document' and
                $tipo != 'pdf' and
                $tipo != 'jpeg') {
                $mensaje['response'] = 'error';
                $mensaje['message'] = 'Solo se permiten archivos WORD, PDF, JPG, JPEG o PNG.';
            } elseif ($size >= 262144000) {
                $mensaje['response'] = 'error';
                $mensaje['message'] = 'Solo se permiten subir imágenes de menos de 25 Megabytes.';
            } elseif (move_uploaded_file($moveee, $src)) {

                if ($tipo_persona=='Persona Natural'){

                    $codigomesa =  Mesa::create([
                        'categoria' => "mesa",
                        'tipo_persona' => $tipo_persona,
                        'natural_tipo_doc' => $request->getParam('natural_tipo_doc'),
                        'natural_dni' => $request->getParam('natural_dni'),
                        'natural_nombres' => $request->getParam('natural_nombres'),
                        'natural_apellidos' => $request->getParam('natural_apellidos'),
                        'natural_departamento' => $request->getParam('natural_departamento'),
                        'natural_provincia' => $request->getParam('natural_provincia'),
                        'natural_distrito' => $request->getParam('natural_distrito'),
                        'natural_direccion' => $request->getParam('natural_direccion'),
                        'correo' => $request->getParam('correo'),
                        'telefono' => $request->getParam('telefono'),
                        'motivo' => $request->getParam('motivo'),
                        'mensaje' => $request->getParam('mensaje'),
                        'archivo' => $src,
                    ])->id;

                    $message = "<p>Estimado(a) Administrador,</p>";
                    $message .= "<p>Es un gusto comunicarnos con usted, mediante este medio le enviamos información de un <b>nuevo trámite</b> registrado.</p>";
                    $message .= "<p>SOLICITUD 000$codigomesa</p>";
                    $message .= "<p><b>Tipo de persona:</b> $tipo_persona<br>";
                    $message .= "<b>Tipo de documento:</b> $natural_tipo_doc<br>";
                    $message .= "<b>Número de documento:</b> $natural_dni<br>";
                    $message .= "<b>Nombres:</b> $natural_nombres<br>";
                    $message .= "<b>Apellidos:</b> $natural_apellidos<br>";
                    $message .= "<b>Departamento:</b> $natural_departamento<br>";
                    $message .= "<b>Provincia:</b> $natural_provincia<br>";
                    $message .= "<b>Distrito:</b> $natural_distrito<br>";
                    $message .= "<b>Dirección:</b> $natural_direccion<br>";
                    $message .= "<b>Correo electrónico de contacto:</b> $correo<br>";
                    $message .= "<b>Teléfono o celular de contacto:</b> $telefono<br>";
                    $message .= "<b>Asunto:</b> $asunto<br>";
                    $message .= "<b>Mensaje:</b> $contenido<p>";
                    $message .= "<p><b>Documento adjunto:</b></p>";
                    $message .= "<a style='text-decoration: underline;' href='https://beneficenciadelima.org/public/$src'>";
                    $message .= "Ver documento adjunto";
                    $message .= "</a>";
                    $message .= "<p><b>Documento adicional:</b></p>";
                    $message .= "<a style='text-decoration: underline;' href='$doc_extra'>";
                    $message .= "Ver documento adicional";
                    $message .= "</a>";
                    $message .= "<p>Beneficencia de Lima</p>";

                    $mail = new PHPMailer;
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host = "localhost";
                    $mail->Port = 25;
                    $mail->SMTPAuth = false;
                    $mail->Username = "smpv.sblm@beneficenciadelima.org";
                    $mail->Password = "M3s@d3p@rt3s";
                    $mail->IsSendmail();
                    $mail->addAddress("mesadepartesvirtual@beneficenciadelima.org", $natural_nombres);
                    $mail->addAddress($correo, $natural_nombres);
                    $mail->Subject = "Solicitud - Mesa de Partes";
                    $mail->isHTML();
                    $mail->Body = $message;
                    $mail->From = "smpv.sblm@beneficenciadelima.org";
                    $mail->FromName = "Beneficencia de Lima";
                    if ($mail->send()) {
                        $mensaje['response'] = 'success';
                        $mensaje['message'] = 'Solicitud registrada con éxito<br>Su código de solicitud es: 000'. $codigomesa;
                    } else {
                        $mensaje['response'] = 'error';
                        $mensaje['message'] = 'No se pudo enviar su solicitud';
                    }

                }else{

                    $codigomesa =  Mesa::create([
                        'categoria' => "mesa",
                        'tipo_persona' => $tipo_persona,
                        'juridico_ruc' => $request->getParam('juridico_ruc'),
                        'juridico_nombre_empresa' => $request->getParam('juridico_nombre_empresa'),
                        'juridico_departamento' => $request->getParam('juridico_departamento'),
                        'juridico_provincia' => $request->getParam('juridico_provincia'),
                        'juridico_distrito' => $request->getParam('juridico_distrito'),
                        'juridico_direccion' => $request->getParam('juridico_direccion'),
                        'juridico_tipo_doc_rep' => $request->getParam('juridico_tipo_doc_rep'),
                        'juridico_dni_rep' => $request->getParam('juridico_dni_rep'),
                        'juridico_nombre_rep' => $request->getParam('juridico_nombre_rep'),
                        'juridico_ape_rep' => $request->getParam('juridico_ape_rep'),
                        'correo' => $request->getParam('correo'),
                        'telefono' => $request->getParam('telefono'),
                        'motivo' => $request->getParam('motivo'),
                        'mensaje' => $request->getParam('mensaje'),
                        'archivo' => $src,
                    ])->id;

                    $message = "<p>Estimado(a) Administrador,</p>";
                    $message .= "<p>Es un gusto comunicarnos con usted, mediante este medio le enviamos información de un <b>nuevo trámite</b> registrado.</p>";
                    $message .= "<p>SOLICITUD 000$codigomesa</p>";
                    $message .= "<p><b>Tipo de persona:</b> $tipo_persona<br>";
                    $message .= "<b>Número de RUC:</b> $juridico_ruc<br>";
                    $message .= "<b>Nombre de la Empresa:</b> $juridico_nombre_empresa<br>";
                    $message .= "<b>Departamento:</b> $juridico_departamento<br>";
                    $message .= "<b>Provincia:</b> $juridico_provincia<br>";
                    $message .= "<b>Dirección:</b> $juridico_direccion<br>";
                    $message .= "<b>Tipo de documento de identidad de representante:</b> $juridico_tipo_doc_rep<br>";
                    $message .= "<b>Número de documento de identidad de representante:</b> $juridico_dni_rep<br>";
                    $message .= "<b>Nombres de representante:</b> $juridico_nombre_rep<br>";
                    $message .= "<b>Apellidos de representante:</b> $juridico_ape_rep<br>";
                    $message .= "<b>Correo electrónico de contacto:</b> $correo<br>";
                    $message .= "<b>Teléfono o celular de contacto:</b> $telefono<br>";
                    $message .= "<b>Asunto:</b> $asunto<br>";
                    $message .= "<b>Mensaje:</b> $contenido<p>";
                    $message .= "<p><b>Documento adjunto:</b></p>";
                    $message .= "<a style='text-decoration: underline;' href='https://beneficenciadelima.org/public/$src'>";
                    $message .= "Ver documento adjunto";
                    $message .= "</a>";
                    $message .= "<p><b>Documento adicional:</b></p>";
                    $message .= "<a style='text-decoration: underline;' href='$doc_extra'>";
                    $message .= "Ver documento adicional";
                    $message .= "</a>";
                    $message .= "<p>Beneficencia de Lima</p>";

                    $mail = new PHPMailer;
                    $mail->CharSet = 'UTF-8';
                    $mail->isSMTP();
                    $mail->Host = "localhost";
                    $mail->Port = 25;
                    $mail->SMTPAuth = false;
                    $mail->Username = "smpv.sblm@beneficenciadelima.org";
                    $mail->Password = "M3s@d3p@rt3s";
                    $mail->IsSendmail();
                    $mail->addAddress("mesadepartesvirtual@beneficenciadelima.org", $juridico_nombre_rep);
                    $mail->addAddress($correo, $juridico_nombre_rep);
                    $mail->Subject = "Solicitud - Mesa de Partes";
                    $mail->isHTML();
                    $mail->Body = $message;
                    $mail->From = "smpv.sblm@beneficenciadelima.org";
                    $mail->FromName = "Beneficencia de Lima";
                    if ($mail->send()) {
                        $mensaje['response'] = 'success';
                        $mensaje['message'] = 'Solicitud registrada con éxito<br>Su código de solicitud es: 000'. $codigomesa;
                    } else {
                        $mensaje['response'] = 'error';
                        $mensaje['message'] = 'No se pudo enviar su solicitud';
                    }

                }
            }
        } else {

            if ($tipo_persona=='Persona Natural'){

                $codigomesa =  Mesa::create([
                    'categoria' => "mesa",
                    'tipo_persona' => $tipo_persona,
                    'natural_tipo_doc' => $request->getParam('natural_tipo_doc'),
                    'natural_dni' => $request->getParam('natural_dni'),
                    'natural_nombres' => $request->getParam('natural_nombres'),
                    'natural_apellidos' => $request->getParam('natural_apellidos'),
                    'natural_departamento' => $request->getParam('natural_departamento'),
                    'natural_provincia' => $request->getParam('natural_provincia'),
                    'natural_distrito' => $request->getParam('natural_distrito'),
                    'natural_direccion' => $request->getParam('natural_direccion'),
                    'correo' => $request->getParam('correo'),
                    'telefono' => $request->getParam('telefono'),
                    'motivo' => $request->getParam('motivo'),
                    'mensaje' => $request->getParam('mensaje'),
                ])->id;

                $message = "<p>Estimado(a) Administrador,</p>";
                $message .= "<p>Es un gusto comunicarnos con usted, mediante este medio le enviamos información de un <b>nuevo trámite</b> registrado.</p>";
                $message .= "<p>SOLICITUD 000$codigomesa</p>";
                $message .= "<p><b>Tipo de persona:</b> $tipo_persona<br>";
                $message .= "<b>Tipo de documento:</b> $natural_tipo_doc<br>";
                $message .= "<b>Número de documento:</b> $natural_dni<br>";
                $message .= "<b>Nombres:</b> $natural_nombres<br>";
                $message .= "<b>Apellidos:</b> $natural_apellidos<br>";
                $message .= "<b>Departamento:</b> $natural_departamento<br>";
                $message .= "<b>Provincia:</b> $natural_provincia<br>";
                $message .= "<b>Distrito:</b> $natural_distrito<br>";
                $message .= "<b>Dirección:</b> $natural_direccion<br>";
                $message .= "<b>Correo electrónico de contacto:</b> $correo<br>";
                $message .= "<b>Teléfono o celular de contacto:</b> $telefono<br>";
                $message .= "<b>Asunto:</b> $asunto<br>";
                $message .= "<b>Mensaje:</b> $contenido<p>";
                $message .= "<p>*No se adjuntó ningún documento</p>";
                $message .= "<p><b>Documento adicional:</b></p>";
                $message .= "<a style='text-decoration: underline;' href='$doc_extra'>";
                $message .= "Ver documento adicional";
                $message .= "</a>";
                $message .= "<p>Beneficencia de Lima</p>";

                $mail = new PHPMailer;
                $mail->CharSet = 'UTF-8';
                $mail->isSMTP();
                $mail->Host = "localhost";
                $mail->Port = 25;
                $mail->SMTPAuth = false;
                $mail->Username = "smpv.sblm@beneficenciadelima.org";
                $mail->Password = "M3s@d3p@rt3s";
                $mail->IsSendmail();
                $mail->addAddress("mesadepartesvirtual@beneficenciadelima.org", $natural_nombres);
                $mail->addAddress($correo, $natural_nombres);
                $mail->Subject = "Solicitud - Mesa de Partes";
                $mail->isHTML();
                $mail->Body = $message;
                $mail->From = "smpv.sblm@beneficenciadelima.org";
                $mail->FromName = "Beneficencia de Lima";
                if ($mail->send()) {
                    $mensaje['response'] = 'success';
                    $mensaje['message'] = 'Solicitud registrada con éxito<br>Su código de solicitud es: 000'. $codigomesa;
                } else {
                    $mensaje['response'] = 'error';
                    $mensaje['message'] = 'No se pudo enviar su solicitud';
                }

            }else{

                $codigomesa =  Mesa::create([
                    'categoria' => "mesa",
                    'tipo_persona' => $tipo_persona,
                    'juridico_ruc' => $request->getParam('juridico_ruc'),
                    'juridico_nombre_empresa' => $request->getParam('juridico_nombre_empresa'),
                    'juridico_departamento' => $request->getParam('juridico_departamento'),
                    'juridico_provincia' => $request->getParam('juridico_provincia'),
                    'juridico_distrito' => $request->getParam('juridico_distrito'),
                    'juridico_direccion' => $request->getParam('juridico_direccion'),
                    'juridico_tipo_doc_rep' => $request->getParam('juridico_tipo_doc_rep'),
                    'juridico_dni_rep' => $request->getParam('juridico_dni_rep'),
                    'juridico_nombre_rep' => $request->getParam('juridico_nombre_rep'),
                    'juridico_ape_rep' => $request->getParam('juridico_ape_rep'),
                    'correo' => $request->getParam('correo'),
                    'telefono' => $request->getParam('telefono'),
                    'motivo' => $request->getParam('motivo'),
                    'mensaje' => $request->getParam('mensaje'),
                ])->id;

                $message = "<p>Estimado(a) Administrador,</p>";
                $message .= "<p>Es un gusto comunicarnos con usted, mediante este medio le enviamos información de un <b>nuevo trámite</b> registrado.</p>";
                $message .= "<p>SOLICITUD 000$codigomesa</p>";
                $message .= "<p><b>Tipo de persona:</b> $tipo_persona<br>";
                $message .= "<b>Número de RUC:</b> $juridico_ruc<br>";
                $message .= "<b>Nombre de la Empresa:</b> $juridico_nombre_empresa<br>";
                $message .= "<b>Departamento:</b> $juridico_departamento<br>";
                $message .= "<b>Provincia:</b> $juridico_provincia<br>";
                $message .= "<b>Dirección:</b> $juridico_direccion<br>";
                $message .= "<b>Tipo de documento de identidad de representante:</b> $juridico_tipo_doc_rep<br>";
                $message .= "<b>Número de documento de identidad de representante:</b> $juridico_dni_rep<br>";
                $message .= "<b>Nombres de representante:</b> $juridico_nombre_rep<br>";
                $message .= "<b>Apellidos de representante:</b> $juridico_ape_rep<br>";
                $message .= "<b>Correo electrónico de contacto:</b> $correo<br>";
                $message .= "<b>Teléfono o celular de contacto:</b> $telefono<br>";
                $message .= "<b>Asunto:</b> $asunto<br>";
                $message .= "<b>Mensaje:</b> $contenido<p>";
                $message .= "<p>*No se adjuntó ningún documento</p>";
                $message .= "<p><b>Documento adicional:</b></p>";
                $message .= "<a style='text-decoration: underline;' href='$doc_extra'>";
                $message .= "Ver documento adicional";
                $message .= "</a>";
                $message .= "<p>Beneficencia de Lima</p>";

                $mail = new PHPMailer;
                $mail->CharSet = 'UTF-8';
                $mail->isSMTP();
                $mail->Host = "localhost";
                $mail->Port = 25;
                $mail->SMTPAuth = false;
                $mail->Username = "smpv.sblm@beneficenciadelima.org";
                $mail->Password = "M3s@d3p@rt3s";
                $mail->IsSendmail();
                $mail->addAddress("mesadepartesvirtual@beneficenciadelima.org", $juridico_nombre_rep);
                $mail->addAddress($correo, $juridico_nombre_rep);
                $mail->Subject = "Solicitud - Mesa de Partes";
                $mail->isHTML();
                $mail->Body = $message;
                $mail->From = "smpv.sblm@beneficenciadelima.org";
                $mail->FromName = "Beneficencia de Lima";
                if ($mail->send()) {
                    $mensaje['response'] = 'success';
                    $mensaje['message'] = 'Solicitud registrada con éxito<br>Su código de solicitud es: 000'. $codigomesa;
                } else {
                    $mensaje['response'] = 'error';
                    $mensaje['message'] = 'No se pudo enviar su solicitud';
                }

            }
        }

        }else {
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Horario fuera de lo permitido';
        }

        }else {
            $mensaje['response'] = 'success';
            $mensaje['message'] = 'Horario fuera de lo permitido';
        }

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

    public function ListarMesa($request, $response, $args) {
        try {
            $data = Mesa::orderBy('tb_mesa.created_at', 'DESC')->get();
            $arreglo["data"] = $data;
            return $this->response->withJson($arreglo);
        } catch (ErrorException $e) {
            $data = "Hubo un error al listar los datos.";
            return $this->response->withJson($data, 500);
        }
    }

}
