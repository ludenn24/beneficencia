<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

//Administador
$app->get('/noticias/listar', 'NoticiaController:ListarFront');
$app->get('/noticias/home', 'NoticiaController:ListarHome');
$app->get('/alquiler/listar', 'AlquilerController:ListarFront');
$app->get('/eventos/listar', 'EventoController:ListarFront');
$app->get('/alquiler/distritos', 'AlquilerController:ListarDistritos');
$app->get('/evento/editar', 'EventoController:getEvento');
$app->get('/noticias/detalle/{cod}', 'NoticiaController:getViewDetalleNoticia')->setName('noticia.detalle');

$app->group('', function () {
    $this->get('/admin/auth', 'AdminController:getViewDashSignIn')->setName('admin.signin');
    $this->post('/admin/auth', 'AdminController:postSignIn');
})->add(new GuestMiddleware($container));

$app->group('/admin', function () {
    $this->get('/listamenu', 'MenuCategoriaController:getMenuCategory');
    $this->get('/dash', 'AdminController:getViewDash')->setName('admin.dash');
    $this->get('/listaitem', 'MenuItemController:getMenuItem');
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');
    $this->get('/noticias', 'AdminController:getNoticias')->setName('admin.noticias');
    $this->get('/listaentrada', 'NoticiaController:Listar');
    $this->get('/listarformulario', 'FormularioController:Listar');
    $this->get('/donaciones', 'AdminController:getViewDonaciones')->setName('admin.donaciones');
    $this->get('/voluntariado', 'AdminController:getViewvoluntariado')->setName('admin.voluntariado');
    $this->get('/consultas', 'AdminController:getViewconsultas')->setName('admin.consultas');
    $this->get('/mensajes', 'AdminController:getViewmensajes')->setName('admin.mensajes');
    $this->get('/listardonaciones', 'FormularioController:ListarDonaciones');
    $this->get('/listarvoluntariado', 'FormularioController:ListarVoluntariado');
    $this->get('/listarconsultas', 'FormularioController:ListarConsultas');
    $this->get('/listarmensajes', 'FormularioController:ListarMensajes');
    $this->post('/registrarnoticia', 'NoticiaController:Registrar');
    $this->post('/formulario/atender', 'FormularioController:Atender');
    $this->get('/noticia/editar', 'NoticiaController:getNoticia');
    $this->post('/noticia/guardaredicion', 'NoticiaController:Actualizar');
    $this->get('/popup', 'AdminController:getPopup')->setName('admin.popup');
    $this->post('/popup/registrar', 'PopupController:Registrar');
    $this->get('/popup/editar', 'PopupController:getPopUp');
    $this->get('/popup/listar', 'PopupController:Listar');
    $this->get('/eventos', 'AdminController:getEventos')->setName('admin.eventos');
    $this->post('/evento/registrar', 'EventoController:Registrar');
    $this->get('/evento/listar', 'EventoController:Listar');
    $this->get('/evento/editar', 'EventoController:getEvento');
    $this->post('/evento/actualizar', 'EventoController:Actualizar');
    $this->get('/alquileres', 'AdminController:getAlquileres')->setName('admin.alquileres');
    $this->get('/alquiler/listar', 'AlquilerController:Listar');
    $this->post('/alquiler/registrar', 'AlquilerController:Registrar');
    $this->get('/alquiler/editar', 'AlquilerController:getAlquiler');
    $this->post('/alquiler/actualizar', 'AlquilerController:Actualizar');
    $this->get('/bandeja', 'AdminController:getMesa')->setName('admin.mesa');
    $this->get('/listarmesa', 'MesaController:ListarMesa');
    //Noticias//
    $this->get('/paginas', 'PaginasController:getViewPaginas')->setName('admin.paginas');
    $this->get('/paginas/listar', 'PaginasController:ListPagina');
    $this->post('/paginas/registrar', 'PaginasController:PostPagina');
    $this->get('/paginas/editar', 'PaginasController:GetPagina');
    $this->post('/paginas/actualizar', 'PaginasController:UptPagina');
    //Secciones//
    $this->get('/secciones', 'SeccionesController:getView')->setName('admin.secciones');
    $this->get('/secciones/listar', 'SeccionesController:List');
    $this->post('/secciones/registrar', 'SeccionesController:Post');
    $this->get('/secciones/editar', 'SeccionesController:Get');
    $this->post('/secciones/actualizar', 'SeccionesController:Updt');
    //SubSecciones//
    $this->get('/subsecciones/editar', 'SeccionesController:GetSubSeccion');
    $this->post('/subsecciones/registrar', 'SeccionesController:PostSubSeccion');
    
})->add(new AuthMiddleware($container));

//PUBLICO 


$app->get('/menu/lista', 'SeccionesController:getMenu');
$app->get('/submenu/lista', 'SeccionesController:getSubMenu');

$app->get('/', 'HomeController:index')->setName('home');
$app->get('/portal-de-transparencia', 'HomeController:PortalTransparencia')->setName('pt');
$app->get('/mesa/', 'HomeController:mesa')->setName('mesa');
$app->get('/pagina-en-construccion/', 'HomeController:construccion')->setName('construccion');
$app->get('/beneficencia/', 'HomeController:beneficencia')->setName('beneficencia');
$app->get('/plan-bicentenario/', 'HomeController:planbicentenario')->setName('home');
$app->get('/beneficencia/nosotros/', 'HomeController:bnosotros')->setName('home');
$app->get('/beneficencia/directorio/', 'HomeController:bdirectorio')->setName('home');
$app->get('/beneficencia/patronato/', 'HomeController:bpatronato')->setName('home');
$app->get('/beneficencia/historia/', 'HomeController:bhistoria')->setName('home');

$app->get('/puericultorio-perez-aranibar/', 'HomeController:puericultorio')->setName('pp');
$app->get('/puericultorio-perez-aranibar/inicio/', 'HomeController:puericultorioinicio')->setName('home');
$app->get('/puericultorio-perez-aranibar/historia/', 'HomeController:puericultoriohistoria')->setName('home');
$app->get('/puericultorio-perez-aranibar/modalidad-de-ingreso/', 'HomeController:puericultoriomodingreso')->setName('home');
$app->get('/puericultorio-perez-aranibar/contactanos/', 'HomeController:puericultoriocontactanos')->setName('home');

$app->get('/hogar-canevaro/', 'HomeController:hogarcanevaro')->setName('hogarcanevaro');
$app->get('/hogar-canevaro/inicio/', 'HomeController:hogarcanevaroinicio')->setName('home');
$app->get('/hogar-canevaro/testimonios/', 'HomeController:hogarcanevarotestimonios')->setName('home');
$app->get('/hogar-canevaro/historia/', 'HomeController:hogarcanevarohistoria')->setName('home');
$app->get('/hogar-canevaro/modalidad-de-ingreso/', 'HomeController:hogarcanevaromodingreso')->setName('home');
$app->get('/hogar-canevaro/contactanos/', 'HomeController:hogarcanevarocontactanos')->setName('home');

$app->get('/san-vicente-de-paul/', 'HomeController:spv')->setName('spv');
$app->get('/san-vicente-de-paul/inicio/', 'HomeController:spvinicio')->setName('home');
$app->get('/san-vicente-de-paul/historia/', 'HomeController:spvhistoria')->setName('home');
$app->get('/san-vicente-de-paul/modalidad-de-ingreso/', 'HomeController:spvmodingreso')->setName('home');
$app->get('/san-vicente-de-paul/contactanos/', 'HomeController:spvcontactanos')->setName('home');

$app->get('/instituto-sevilla/', 'HomeController:is')->setName('is');
$app->get('/instituto-sevilla/inicio/', 'HomeController:isinicio')->setName('home');
$app->get('/instituto-sevilla/historia/', 'HomeController:ishistoria')->setName('home');
$app->get('/instituto-sevilla/contactanos/', 'HomeController:iscontactanos')->setName('home');

$app->get('/centros-esperanza/', 'HomeController:ce')->setName('ce');
$app->get('/centros-esperanza/inicio/', 'HomeController:ceinicio')->setName('home');
$app->get('/centros-esperanza/historia/', 'HomeController:cehistoria')->setName('home');
$app->get('/centros-esperanza/contactanos/', 'HomeController:cecontactanos')->setName('home');

$app->get('/centros-esperanza-maria-castano-sagrada-familia-y-sagrado-corazon/', 'HomeController:cemcsfsc')->setName('cemcsfsc');
$app->get('/centros-esperanza-maria-castano-sagrada-familia-y-sagrado-corazon/inicio/', 'HomeController:cemcsfscinicio')->setName('home');
$app->get('/centros-esperanza-maria-castano-sagrada-familia-y-sagrado-corazon/modalidad-de-ingreso/', 'HomeController:cemcsfscmodingreso')->setName('home');
$app->get('/centros-esperanza-maria-castano-sagrada-familia-y-sagrado-corazon/hogares/', 'HomeController:cemcsfscmodhogares')->setName('home');
$app->get('/centros-esperanza-maria-castano-sagrada-familia-y-sagrado-corazon/contactanos/', 'HomeController:cemcsfscmodcontactanos')->setName('home');

$app->get('/hogar-de-la-madre/', 'HomeController:hogarmadre')->setName('hogarmadre');
$app->get('/hogar-de-la-madre/inicio/', 'HomeController:hogarmadreinicio')->setName('home');
$app->get('/hogar-de-la-madre/historia/', 'HomeController:hogarmadrehistoria')->setName('home');
$app->get('/hogar-de-la-madre/contactanos/', 'HomeController:hogarmadrecontactanos')->setName('home');
       
$app->get('/casadetodos/', 'HomeController:casadetodos')->setName('casadetodos');
$app->get('/casadetodos/inicio/', 'HomeController:casadetodosinicio')->setName('home');
$app->get('/casadetodos/visitanos/', 'HomeController:casadetodosvisitanos')->setName('home');
$app->get('/casadetodos/contactanos/', 'HomeController:casadetodoscontactanos')->setName('home');

$app->get('/presbitero-maestro/', 'HomeController:presbiteromaestro')->setName('home');

$app->get('/cementerio-angel/', 'HomeController:ca')->setName('home');
$app->get('/cementerio-angel/contactanos/', 'HomeController:cacontactanos')->setName('home');
$app->get('/cementerio-angel/nuestros-servicios/', 'HomeController:caservicios')->setName('home');
$app->get('/cementerio-angel/historia/', 'HomeController:cahistoria')->setName('home');

$app->get('/plaza-acho/', 'HomeController:plazaacho')->setName('home');

$app->get('/centro-cultural/', 'HomeController:centrocultural')->setName('home');
$app->get('/centro-cultural/psi', 'HomeController:centroculturalpsi')->setName('psi');
$app->get('/centro-cultural/rcn', 'HomeController:centroculturalrcn')->setName('rcn');
$app->get('/centro-cultural/nom', 'HomeController:centroculturalnom')->setName('nom');

$app->get('/inmuebles/', 'HomeController:index');

$app->get('/noticias/', 'HomeController:noticias')->setName('noticias');

$app->get('/se-parte-del-cambio/convenios/', 'HomeController:spcconvenios')->setName('home');
$app->get('/se-parte-del-cambio/donaciones/', 'HomeController:spcdonaciones')->setName('home');
$app->get('/se-parte-del-cambio/voluntariado/', 'HomeController:spcvoluntariado')->setName('home');

$app->post('/mesa/registrar', 'MesaController:Registrar');
$app->post('/registrar', 'FormularioController:Registrar');$app->get('/como-ayudar/', 'HomeController:ComoAyudar')->setName('comoayudar');