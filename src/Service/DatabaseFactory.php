<?php

namespace App\Service;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class DatabaseFactory {

/**
* Create Doctrine Entity Manager
* @return EntityManager
*
*/
	public static function create(){
		$isDevMode = True;
		$metadata = Setup::createAnnotationMetadataConfiguration(
			[__DIR__ . '/../Entity'], $isDevMode);
		
		$dbParams = [
			'driver' => 'pdo_mysql',
			'host' => 'localhost',
			'user' => 'sander',
			'password' => 'qwerty',
			'dbname' => 'doctrineorm',
			'charset' => 'utf8'
		];
	
		return EntityManager::create($dbParams, $metadata);
	}	
}