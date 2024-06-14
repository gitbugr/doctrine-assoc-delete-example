<?php

    require_once 'vendor/autoload.php';

    use Doctrine\DBAL\DriverManager;
    use Doctrine\ORM\EntityManager;
    use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
    use Doctrine\ORM\ORMSetup;

    /**
     * @throws MissingMappingDriverImplementation
     * @throws \Doctrine\DBAL\Exception
     */
    function getEntityManager(): EntityManager
    {
        $connectionOpts = [
            'dbname' => 'testdb',
            'host' => '127.0.0.1',
            'port' => 3306,
            'user' => 'testuser',
            'password' => 'password',
            'driver' => 'pdo_mysql',
            'charset' => 'utf8mb4',
        ];

        $paths = [__DIR__ . 'src/Entity'];
        $config = ORMSetup::createAttributeMetadataConfiguration($paths);

        return new EntityManager(DriverManager::getConnection($connectionOpts, $config), $config);
    }

