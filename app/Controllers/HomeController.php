<?php

namespace App\Controllers;
use App\Models\Popup;
use Slim\Views\Twig as View;

Class HomeController extends Controller {

    public function index($request, $response) {
        
        $popup = Popup::where('estado', 1)->first();
        return $this->view->render($response, 'home.twig',[
            'popup' => $popup,
        ]);
    }

    public function PortalTransparencia($request, $response) {
        return $this->view->render($response, 'templates/portaltransparencia.twig');
    }
    
    public function mesa($request, $response) {
        return $this->view->render($response, 'templates/mesa.twig');
    }
    public function construccion($request, $response) {        return $this->view->render($response, 'templates/construccion.twig');    }
    public function beneficencia($request, $response) {
        return $this->view->render($response, 'templates/beneficencia.twig');
    }

    public function planbicentenario($request, $response) {
        return $this->view->render($response, 'templates/plan-bicentenario.twig');
    }

    public function bnosotros($request, $response) {
        return $this->view->render($response, 'templates/beneficencia/nosotros.twig');
    }

    public function bdirectorio($request, $response) {
        return $this->view->render($response, 'templates/beneficencia/directorio.twig');
    }

    public function bpatronato($request, $response) {
        return $this->view->render($response, 'templates/beneficencia/patronato.twig');
    }

    public function bhistoria($request, $response) {
        return $this->view->render($response, 'templates/beneficencia/historia.twig');
    }

    public function puericultorio($request, $response) {
        return $this->view->render($response, 'templates/prosociales/puericultorio.twig');
    }

    public function puericultorioinicio($request, $response) {
        return $this->view->render($response, 'templates/prosociales/puericultorioinicio.twig');
    }

    public function puericultoriohistoria($request, $response) {
        return $this->view->render($response, 'templates/prosociales/puericultoriohistoria.twig');
    }

    public function puericultoriomodingreso($request, $response) {
        return $this->view->render($response, 'templates/prosociales/puericultoriomodingreso.twig');
    }

    public function puericultoriocontactanos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/puericultoriocontactanos.twig');
    }

    public function hogarcanevaro($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarcanevaro.twig');
    }

    public function hogarcanevaroinicio($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarcanevaroinicio.twig');
    }

    public function hogarcanevarotestimonios($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarcanevarotestimonios.twig');
    }

    public function hogarcanevarohistoria($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarcanevarohistoria.twig');
    }

    public function hogarcanevaromodingreso($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarcanevaromodingreso.twig');
    }

    public function hogarcanevarocontactanos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarcanevarocontactanos.twig');
    }

    public function spv($request, $response) {
        return $this->view->render($response, 'templates/prosociales/spv.twig');
    }

    public function spvinicio($request, $response) {
        return $this->view->render($response, 'templates/prosociales/spvinicio.twig');
    }

    public function spvhistoria($request, $response) {
        return $this->view->render($response, 'templates/prosociales/spvhistoria.twig');
    }

    public function spvmodingreso($request, $response) {
        return $this->view->render($response, 'templates/prosociales/spvmodingreso.twig');
    }

    public function spvcontactanos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/spvcontactanos.twig');
    }

    public function is($request, $response) {
        return $this->view->render($response, 'templates/prosociales/is.twig');
    }

    public function isinicio($request, $response) {
        return $this->view->render($response, 'templates/prosociales/isinicio.twig');
    }

    public function ishistoria($request, $response) {
        return $this->view->render($response, 'templates/prosociales/ishistoria.twig');
    }

    public function iscontactanos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/iscontactanos.twig');
    }

    public function ce($request, $response) {
        return $this->view->render($response, 'templates/prosociales/ce.twig');
    }

    public function ceinicio($request, $response) {
        return $this->view->render($response, 'templates/prosociales/ceinicio.twig');
    }

    public function cehistoria($request, $response) {
        return $this->view->render($response, 'templates/prosociales/cehistoria.twig');
    }

    public function cecontactanos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/cecontactanos.twig');
    }

    public function cemcsfsc($request, $response) {
        return $this->view->render($response, 'templates/prosociales/cemcsfsc.twig');
    }

    public function cemcsfscinicio($request, $response) {
        return $this->view->render($response, 'templates/prosociales/cemcsfscinicio.twig');
    }

    public function cemcsfscmodingreso($request, $response) {
        return $this->view->render($response, 'templates/prosociales/cemcsfscmodingreso.twig');
    }

    public function cemcsfscmodhogares($request, $response) {
        return $this->view->render($response, 'templates/prosociales/cemcsfscmodhogares.twig');
    }

    public function cemcsfscmodcontactanos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/cemcsfscmodcontactanos.twig');
    }

    public function hogarmadre($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarmadre.twig');
    }

    public function hogarmadreinicio($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarmadreinicio.twig');
    }

    public function hogarmadrehistoria($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarmadrehistoria.twig');
    }

    public function hogarmadrecontactanos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/hogarmadrecontactanos.twig');
    }

    public function casadetodos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/casadetodos.twig');
    }

    public function casadetodosinicio($request, $response) {
        return $this->view->render($response, 'templates/prosociales/casadetodosinicio.twig');
    }

    public function casadetodosvisitanos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/casadetodosvisitanos.twig');
    }

    public function casadetodoscontactanos($request, $response) {
        return $this->view->render($response, 'templates/prosociales/casadetodoscontactanos.twig');
    }

    public function presbiteromaestro($request, $response) {
        return $this->view->render($response, 'templates/presbitero.twig');
    }

    public function ca($request, $response) {
        return $this->view->render($response, 'templates/patrimonio_cultural/ca.twig');
    }

    public function cainicio($request, $response) {
        return $this->view->render($response, 'templates/patrimonio_cultural/cainicio.twig');
    }

    public function cacontactanos($request, $response) {
        return $this->view->render($response, 'templates/patrimonio_cultural/cacontactanos.twig');
    }

    public function caservicios($request, $response) {
        return $this->view->render($response, 'templates/patrimonio_cultural/caservicios.twig');
    }

    public function cahistoria($request, $response) {
        return $this->view->render($response, 'templates/patrimonio_cultural/cahistoria.twig');
    }

    public function plazaacho($request, $response) {
        return $this->view->render($response, 'templates/plazaacho.twig');
    }

    public function centrocultural($request, $response) {
        return $this->view->render($response, 'templates/centro-cultural.twig');
    }

    public function centroculturalpsi($request, $response) {
        return $this->view->render($response, 'templates/psi.twig');
    }

    public function centroculturalrcn($request, $response) {
        return $this->view->render($response, 'templates/rcn.twig');
    }

    public function centroculturalnom($request, $response) {
        return $this->view->render($response, 'templates/nom.twig');
    }

    public function inmuebles($request, $response) {
        return $this->view->render($response, 'templates/inmuebles.twig');
    }

    public function noticias($request, $response) {
        return $this->view->render($response, 'templates/noticias.twig');
    }

    public function spcconvenios($request, $response) {
        return $this->view->render($response, 'templates/separtedelcambio/spcconvenios.twig');
    }

    public function spcdonaciones($request, $response) {
        return $this->view->render($response, 'templates/separtedelcambio/spcdonaciones.twig');
    }

    public function spcvoluntariado($request, $response) {
        return $this->view->render($response, 'templates/separtedelcambio/spcvoluntariado.twig');
    }
    
    public function ComoAyudar($request, $response) {
        return $this->view->render($response, 'templates/comoayudar.twig');
    }

}
