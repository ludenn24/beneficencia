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


