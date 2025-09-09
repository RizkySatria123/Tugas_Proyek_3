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