<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LandingPage::index');
$routes->setAutoRoute(true);

//Landing Page
$routes->get('/landingpage/index', 'LandingPage::index');
$routes->get('/landingpage/pilihansesuairole', 'LandingPage::pilihansesuairole');
// Barang Masuk
$routes->get('/pages/barangmasuk/index', 'BarangMasuk::index');
$routes->get('/barangmasuk/create', 'BarangMasuk::create');
$routes->post('/barangmasuk/save', 'BarangMasuk::save');
$routes->get('/barangmasuk/edit/(:any)', 'BarangMasuk::edit/$1');
$routes->get('/barangmasuk/delete/(:any)', 'BarangMasuk::delete/$1');

// Stok In
$routes->get('/pages/stokin/index', 'StokIn::index');
$routes->get('/stokin/tambah/(:any)', 'StokIn::tambah/$1');
$routes->get('/stokin/delete/(:num)/(:num)', 'StokIn::delete/$1/$2');
$routes->get('/stokin/edit/(:any)', 'StokIn::edit/$1');
// Stok Out
$routes->get('/stokout/index', 'StokOut::index');
$routes->get('/pages/stokout/tambah', 'StokOut::tambah');
$routes->get('/stokout/proses', 'StokOut::proses');
$routes->get('/stokout/delete/(:any)', 'StokOut::delete/$1');

// Satuan
$routes->get('/pages/satuan/index', 'Satuan::index');
$routes->get('/pages/satuan/create', 'Satuan::create');
$routes->post('/satuan/save', 'Satuan::save');
$routes->get('/satuan/edit/(:any)', 'Satuan::edit/$1');
$routes->get('/satuan/delete/(:any)', 'Satuan::delete/$1');

// Pengajuan
$routes->get('/pages/pengajuan/index', 'Pengajuan::index');
$routes->get('/pengajuan/create', 'Pengajuan::create');
$routes->post('/pengajuan/save', 'Pengajuan::save');
$routes->get('/pengajuan/edit/(:any)', 'Pengajuan::edit/$1');
$routes->get('/pengajuan/delete/(:any)', 'Pengajuan::delete/$1');

// Barang
$routes->get('/pages/barang/index', 'Barang::index');
$routes->get('/pages/barang/create', 'Barang::create');
$routes->post('/barang/save', 'Barang::save');
$routes->get('/barang/edit/(:any)', 'Barang::edit/$1');
$routes->get('/barang/delete/(:any)', 'Barang::delete/$1');

// Laporan
$routes->get('/laporan/index', 'Laporan::index');
$routes->get('/laporan/cetakstokin', 'Laporan::cetakstokin');
$routes->get('/laporan/cetakstokout', 'Laporan::cetakstokout');

// Permintaan
$routes->get('/permintaan/index', 'Permintaan::index');
$routes->get('/permintaan/create', 'Permintaan::create');
$routes->post('/permintaan/save', 'Permintaan::save');
$routes->post('/permintaan/proses', 'Permintaan::proses');
$routes->get('/permintaan/edit/(:any)', 'Permintaan::edit/$1');
$routes->get('/permintaan/delete/(:any)', 'Permintaan::delete/$1');
$routes->post('/permintaan/update/(:any)', 'Permintaan::update/$1');

// Dashboard admin
$routes->get('/dashboard_admin/index', 'dashboard_admin::index');

//identitas diri
$routes->get('/identitas/index', 'IdentitasDiri::index');
$routes->get('/identitas/edit', 'IdentitasDiri::edit');

//Ajukan Barang
$routes->get('/ajukanbrg/index', 'AjukanBrg::index');
$routes->get('/ajukanbrg/create', 'AjukanBrg::create');


// Auth
$routes->get('/auth/login', 'Auth::Login');
$routes->post('/auth/login', 'Auth::processLogin');
$routes->get('/auth/logout', 'Auth::logout');
