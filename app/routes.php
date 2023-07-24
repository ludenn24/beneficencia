<?php

use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

$app->get('/menu/lista', 'SeccionesController:getMenu');
$app->get('/submenu/lista', 'SeccionesController:getSubMenu');
$app->get('/', 'HomeController:index')->setName('home');
$app->get('/alquiler/general', 'HomeController:inmuebles');
$app->get('/noticias/listar', 'NoticiaController:ListarFront');
$app->get('/noticias/home', 'NoticiaController:ListarHome');
$app->get('/alquiler/listar', 'AlquilerController:ListarFront');
$app->get('/eventos/listar', 'EventoController:ListarFront');
$app->get('/alquiler/distritos', 'AlquilerController:ListarDistritos');
$app->get('/evento/editar', 'EventoController:getEvento');
$app->get('/noticias/general', 'HomeController:noticias');
$app->get('/noticias/detalle/{cod}', 'NoticiaController:getViewDetalleNoticia')->setName('noticia.detalle');
$app->get('/noticias/previa/{cod}', 'NoticiaController:getViewDetalleNoticia');
$app->get('/{cod}', 'PaginasController:getViewPagina')->setName('pagina.detalle');
$app->post('/formulario/registrar', 'FormularioController:Registrar');

$app->group('', function () {
    $this->get('/admin/auth', 'AdminController:getViewDashSignIn')->setName('admin.signin');
    $this->post('/admin/auth', 'AdminController:postSignIn');
})->add(new GuestMiddleware($container));

$app->group('/admin', function () {
    $this->get('/listamenu', 'MenuCategoriaController:getMenuCategory');
    $this->get('/dash', 'AdminController:getViewDash')->setName('admin.dash');
    $this->get('/listaitem', 'MenuItemController:getMenuItem');
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');


    $this->get('/listarformulario', 'FormularioController:Listar');
    $this->get('/donaciones', 'AdminController:getViewDonaciones')->setName('admin.donaciones');
    $this->get('/voluntariado', 'AdminController:getViewvoluntariado')->setName('admin.voluntariado');
    $this->get('/consultas', 'AdminController:getViewconsultas')->setName('admin.consultas');
    $this->get('/mensajes', 'AdminController:getViewmensajes')->setName('admin.mensajes');
    $this->get('/listardonaciones', 'FormularioController:ListarDonaciones');
    $this->get('/listarvoluntariado', 'FormularioController:ListarVoluntariado');
    $this->get('/listarconsultas', 'FormularioController:ListarConsultas');
    $this->get('/listarmensajes', 'FormularioController:ListarMensajes');
    $this->post('/formulario/atender', 'FormularioController:Atender');

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
    $this->get('/noticias', 'AdminController:getNoticias')->setName('admin.noticias');
    $this->get('/listaentrada', 'NoticiaController:Listar');
    $this->post('/registrarnoticia', 'NoticiaController:Registrar');
    $this->get('/noticia/editar', 'NoticiaController:getNoticia');
    $this->post('/noticia/guardaredicion', 'NoticiaController:Actualizar');
    $this->post('/noticia/previa', 'NoticiaController:ActualizarPrevia');
    $this->post('/noticia/previa-nuevo', 'NoticiaController:ActualizarPreviaNuevo');
    //Paginas//
    $this->get('/paginas', 'PaginasController:getViewPaginas')->setName('admin.paginas');
    $this->get('/paginas/listar', 'PaginasController:ListPagina');
    $this->post('/paginas/registrar', 'PaginasController:PostPagina');
    $this->get('/paginas/editar', 'PaginasController:GetPagina');
    $this->post('/paginas/actualizar', 'PaginasController:UptPagina');
    $this->post('/paginas/previa', 'PaginasController:UptPrevia');
    $this->post('/paginas/previa-nuevo', 'PaginasController:UptPreviaNuevo');
    //Secciones//
    $this->get('/secciones', 'SeccionesController:getView')->setName('admin.secciones');
    $this->get('/secciones/listar', 'SeccionesController:List');
    $this->post('/secciones/registrar', 'SeccionesController:Post');
    $this->get('/secciones/editar', 'SeccionesController:Get');
    $this->post('/secciones/actualizar', 'SeccionesController:Updt');
    //SubSecciones//
    $this->get('/subsecciones/editar', 'SeccionesController:GetSubSeccion');
    $this->post('/subsecciones/registrar', 'SeccionesController:PostSubSeccion');
    //Multimedia//
    $this->get('/multimedia', 'MultimediaController:getView')->setName('admin.multimedia');
    $this->get('/multimedia/listar', 'MultimediaController:Listar');
    $this->post('/multimedia/registrar', 'MultimediaController:Registrar');
    $this->get('/multimedia/editar', 'MultimediaController:GetMultimedia');
    $this->post('/multimedia/actualizar', 'MultimediaController:Actualizar');
    //PORTADAS//
    $this->get('/portada', 'AdminController:getPortada')->setName('admin.portada');
    $this->post('/portada/registrar', 'PortadaController:Registrar');
    $this->get('/portada/editar', 'PortadaController:getPortada');
    $this->get('/portada/listar', 'PortadaController:Listar');
    //Discursos//
    $this->get('/discursos', 'AdminController:getDiscursos')->setName('admin.discursos');
    $this->get('/discursos/listar', 'DiscursosController:Listar');
    $this->post('/discursos/registrar', 'DiscursosController:Registrar');
    $this->get('/discursos/editar', 'DiscursosController:Editar');
    $this->post('/discursos/actualizar', 'DiscursosController:Actualizar');
})->add(new AuthMiddleware($container));



