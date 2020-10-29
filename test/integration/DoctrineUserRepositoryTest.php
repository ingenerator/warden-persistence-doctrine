<?php
/**
 * @author    Andrew Coulton <andrew@ingenerator.com>
 * @licence   proprietary
 */

namespace test\integration\Ingenerator\Warden\Persistence\Doctrine\Repository;


use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Ingenerator\Warden\Persistence\Doctrine\Mapping\WardenDoctrineMapping;
use Ingenerator\Warden\Persistence\Doctrine\Repository\DoctrineUserRepository;
use test\integration\Ingenerator\Warden\Core\Repository\UserRepositoryTest;

class DoctrineUserRepositoryTest extends UserRepositoryTest
{
    /**
     * @var EntityManager
     */
    protected $em;

    protected $db_name;

    public function test_it_can_save_and_load_alternate_user_implementation_when_configured()
    {
        $this->markTestIncomplete(
            'Warden doctrine mapping does not yet support extending / replacing the user interface implementation'
        );
    }

    public function setUp(): void
    {
        parent::setUp();
        $config = new Configuration();
        $driver = new WardenDoctrineMapping;
        $config->setMetadataDriverImpl($driver);
        $config->setMetadataCacheImpl(new ArrayCache);
        $config->setAutoGenerateProxyClasses(FALSE);
        $config->setProxyNamespace('\\Warden\\Proxy');
        $config->setProxyDir(\sys_get_temp_dir());

        $this->db_name = \uniqid('warden_test');

        $this->em = EntityManager::create(
            [
                'driver'   => 'pdo_mysql',
                'host'     => '127.0.0.1',
                'user'     => 'root',
                'password' => '',
                'charset'  => 'utf8',
            ],
            $config
        );

        $this->em->getConnection()->exec('CREATE SCHEMA `'.$this->db_name.'`');
        $this->em->getConnection()->exec('USE `'.$this->db_name.'`');

        $tool = new SchemaTool($this->em);
        $tool->createSchema($this->em->getMetadataFactory()->getAllMetadata());
    }

    public function tearDown(): void
    {
        $this->em->getConnection()->exec('DROP SCHEMA IF EXISTS '.$this->db_name);
    }

    protected function newSubject()
    {
        return new DoctrineUserRepository(
            $this->config,
            $this->em
        );
    }

}
