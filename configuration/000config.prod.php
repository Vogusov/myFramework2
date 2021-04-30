<?php
$config['db_user'] = 'o95220zp_fw2';
$config['db_password'] = 'Test0000';
$config['db_base'] = 'o95220zp_fw2';
$config['db_host'] = 'localhost';
$config['db_charset'] = 'UTF-8';

$config['path_root'] = $_SERVER['DOCUMENT_ROOT'];
$config['path_public'] = $config['path_root'] . '/../public_html';
$config['path_model'] = $config['path_root'] . '/../model';
$config['path_controller'] = $config['path_root'] . '/../controller';
$config['path_cache'] = $config['path_root'] . '/../cache';
$config['path_data'] = $config['path_root'] . '/data';
$config['path_fixtures'] = $config['path_data'] . '/fixtures';
$config['path_migrations'] = $config['path_data'] . '/../migrate';
$config['path_commands'] = $config['path_root'] . '/../lib/commands';
$config['path_libs'] = $config['path_root'] . '/../lib';
$config['path_templates'] = $config['path_root'] . '/../view';

$config['path_logs'] = $config['path_root'] . '/../logs';

$config['sitename'] = 'Интернет-магазин';


// namespace
$config['namespace_controller'] = 'Fw2\Controller\\';