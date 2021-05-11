<?php
$config['db_user'] = 'root';
$config['db_password'] = 'root';
$config['db_base'] = 'fw2';
$config['db_host'] = 'localhost';
$config['db_charset'] = 'UTF-8';

$config['path_root'] = __DIR__;
$config['path_public'] = $config['path_root'] . '/../public';
$config['path_model'] = $config['path_root'] . '/../model';
$config['path_controller'] = $config['path_root'] . '/../controller';
$config['path_cache'] = $config['path_root'] . '/../cache';
$config['path_data'] = $config['path_root'] . '/data';
$config['path_fixtures'] = $config['path_data'] . '/fixtures';
$config['path_migrations'] = $config['path_data'] . '/../migrate';
$config['path_commands'] = $config['path_root'] . '/../lib/commands';
$config['path_libs'] = $config['path_root'] . '/../lib';
$config['path_templates'] = $config['path_root'] . '/../view';
$config['catalog_images'] = '/images/catalog/';
$config['catalog_images_sm'] = '/images/catalog_sm/';

$config['path_logs'] = $config['path_root'] . '/../logs';

// размер маленькой картинки для каталога
$config['catalog_sm_img_size'] = 100;

// название сайта
$config['sitename'] = 'Интернет-магазин';

// роль админа в БД
$config['admin_role'] = '1';

// namespace
$config['namespace_controller'] = 'Fw2\Controller\\';