<?php

namespace App\Controllers;

use App\Models\Admin;
use App\Controllers\Controller;
use App\Models\Asesorias;
use App\Models\Constataciones;
use App\Models\DetalleReconocimiento;
use App\Models\Documentos;
use App\Models\Reconocimiento;
use App\Models\Resolucion;
use App\Models\Solicitudes;
use App\Models\Usuarios;
use App\Models\Verificacion;
use Illuminate\Database\Capsule\Manager as DB;
use Psr\Http\Message\ServerRequestInterface as Request;
use Respect\Validation\Validator as v;

Class AdminController extends Controller
{

    
    public function admin()
    {
        $ses_codigo = isset($_SESSION['codigo']) ? $_SESSION['codigo'] : '';
        $admin = Admin::where('codigo', $ses_codigo)->first();
        return $admin;
    }

    public function getViewDash($request, $response)
    {
        return $this->view->render($response, 'admin/dash.twig');
    }

    public function getPopup($request, $response, $args)    
    {        
        return $this->view->render($response, 'admin/auth/popup.twig');    
    }  

    public function getPortada($request, $response, $args)    
    {        
        return $this->view->render($response, 'admin/auth/portada.twig');    
    }  

    public function getNoticias($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/m-noticias.twig');
    }

    public function getEventos($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/eventos.twig');
    }
    
      public function getMesa($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/mesa.twig');
    }
    
     public function getAlquileres($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/alquileres.twig');
    }
    
    public function getViewDonaciones($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/donaciones.twig');
    }

    public function getViewvoluntariado($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/voluntariado.twig');
    }
    
    public function getViewconsultas($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/consultas.twig');
    }
    
   public function getViewmensajes($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/mensajes.twig');
    }

    public function getViewDashSignIn($request, $response)
    {
        return $this->view->render($response, 'admin/auth/signin.twig');
    }

    public function getDiscursos($request, $response, $args)
    {
        return $this->view->render($response, 'admin/auth/discursos.twig');
    }

    public function validar($login, $clave)
    {
        $admin = Admin::where('login', $login)->first();
        if (!$admin) {
            return false;
        }
        if (password_verify($clave, $admin->clave)) {
            $_SESSION['codigo'] = $admin->codigo;
            $_SESSION['dni'] = $admin->dni;
            return true;
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION['dni']);
    }

    public function getSignIn($request, $response)
    {
        return $this->view->render($response, 'auth/signin.twig');
    }

    public function getSignUp($request, $response)
    {

        return $this->view->render($response, 'auth/signup.twig');
    }

    public function postSignIn($request, $response)
    {
        $auth = $this->AdminController->validar(
            $request->getParam('login'),
            $request->getParam('clave')
        );

        if (!$auth) {
            $this->flash->addMessage('error', 'El DNI o contraseña son incorrectos');
            return $response->withRedirect($this->router->pathFor('admin.signin'));
        }
        $this->flash->addMessage('info', 'Haz iniciado sesion correctamente');
        return $response->withRedirect($this->router->pathFor('admin.dash'));

    }

}
