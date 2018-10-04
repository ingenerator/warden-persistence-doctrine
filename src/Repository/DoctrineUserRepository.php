<?php
/**
 * @author    Andrew Coulton <andrew@ingenerator.com>
 * @licence   proprietary
 */

namespace Ingenerator\Warden\Persistence\Doctrine\Repository;


use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Ingenerator\Warden\Core\Config\Configuration;
use Ingenerator\Warden\Core\Entity\User;
use Ingenerator\Warden\Core\Repository\DuplicateUserException;
use Ingenerator\Warden\Core\Repository\UnknownUserException;
use Ingenerator\Warden\Core\Repository\UserRepository;

class DoctrineUserRepository implements UserRepository
{
    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $user_class;

    public function __construct(
        Configuration $config,
        EntityManager $em
    ) {
        $this->em     = $em;
        $this->config = $config;
        $this->user_class = $config->getClassName('entity', 'user');
    }

    public function findByEmail($email)
    {
        return $this->getRepo()->findOneBy(['email' => $email]);
    }

    /**
     * {@inheritdoc}
     */
    public function load($id)
    {
        if ($id AND $user = $this->getRepo()->find($id)) {
            return $user;
        }

        throw UnknownUserException::forId($id);
    }

    public function newUser()
    {
        $class = $this->config->getClassName('entity', 'user');
        return new $class;
    }

    public function save(User $user)
    {
        try {
            $this->doSave($user);
        } catch (UniqueConstraintViolationException $e) {
            throw DuplicateUserException::forEmail($user->getEmail());
        }
    }

    protected function doSave(User $user)
    {
        $this->em->persist($user);
        $this->em->flush([$user]);
    }

    public function refresh(User $user)
    {
        $this->em->refresh($user);
    }

    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    protected function getRepo()
    {
        return $this->em->getRepository($this->user_class);
    }

}
