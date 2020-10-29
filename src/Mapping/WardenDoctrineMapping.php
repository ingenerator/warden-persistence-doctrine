<?php
/**
 * @author    Andrew Coulton <andrew@ingenerator.com>
 * @licence   proprietary
 */
namespace Ingenerator\Warden\Persistence\Doctrine\Mapping;

use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Doctrine\ORM\Mapping\MappingException;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\Persistence\Mapping\Driver\MappingDriver;
use Ingenerator\Warden\Core\Entity\SimpleUser;

class WardenDoctrineMapping implements MappingDriver
{
    public function loadMetadataForClass($className, ClassMetadata $metadata)
    {
        if ($className !== SimpleUser::class) {
            throw MappingException::classIsNotAValidEntityOrMappedSuperClass($className);
        }

        /** @var ClassMetadataInfo $metadata */
        $metadata->setPrimaryTable(
            [
                'name' => 'users',
            ]
        );
        $metadata->setIdGeneratorType(ClassMetadataInfo::GENERATOR_TYPE_AUTO);
        $metadata->mapField(
            [
                'id'        => TRUE,
                'fieldName' => 'id',
                'type'      => 'integer',
            ]
        );
        $metadata->mapField(
            [
                'fieldName' => 'email',
                'nullable'  => FALSE,
                'type'      => 'string',
                'unique'    => TRUE,
                'options'   => [
                ],
            ]
        );
        $metadata->mapField(
            [
                'fieldName' => 'password_hash',
                'nullable'  => TRUE,
                'type'      => 'string',
                'options'   => [
                ],
            ]
        );
        $metadata->mapField(
            [
                'fieldName' => 'is_active',
                'type'      => 'boolean',
                'nullable'  => FALSE,
                'options'   => [
                ],
            ]
        );
    }

    public function getAllClassNames()
    {
        return [
            SimpleUser::class,
        ];
    }

    public function isTransient($className)
    {
        return $className === SimpleUser::class;
    }

}
