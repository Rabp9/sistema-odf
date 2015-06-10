<?php
class DATABASE_CONFIG {

	public $default = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => '127.0.0.1',
		'login' => 'root',
		'password' => '',
		'database' => 'sistema-odf',
		'prefix' => '',
		'encoding' => 'utf8'
	);

	public $test = array(
		'datasource' => 'Database/Mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'user',
		'password' => '',
		'database' => 'database_name',
		'prefix' => '',
		'encoding' => 'utf8'
	);
}
