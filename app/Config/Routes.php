<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/dosen', 'Dosen::display');
$routes->get('/dosen/display', 'Dosen::display');
$routes->get('/mahasiswa/display','Mahasiswa::display');
$routes->get('/berita', 'Berita::index');
$routes->get('/data','Data::index');

// Auth
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attempt');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::store');
$routes->get('logout', 'Auth::logout');