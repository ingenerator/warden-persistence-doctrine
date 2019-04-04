<?php
/**
 * @author    Andrew Coulton <andrew@ingenerator.com>
 * @licence   proprietary
 */

namespace test\unit\Ingenerator\Warden\Persistence\Doctrine\Mapping;


use Doctrine\Common\Persistence\Mapping\Driver\MappingDriver;
use Ingenerator\Warden\Persistence\Doctrine\Mapping\WardenDoctrineMapping;

class WardenDoctrineMappingTest extends \PHPUnit\Framework\TestCase
{
    public function test_it_is_initialisable_doctrine_mapping_driver()
    {
        $subject = $this->newSubject();
        $this->assertInstanceOf(WardenDoctrineMapping::class, $subject);
        $this->assertInstanceOf(MappingDriver::class, $subject);
    }

    public function test_it_maps_entities_based_on_configured_entity_class()
    {
        $this->markTestIncomplete(
            'Warden doctrine mapping does not yet support extending / replacing the user interface implementation'
        );
    }

    public function test_its_mapping_can_be_extended_and_customised_by_consuming_applications()
    {
        $this->markTestIncomplete(
            'Warden doctrine mapping does not yet support extending / replacing the user interface implementation'
        );
    }

    protected function newSubject()
    {
        return new WardenDoctrineMapping();
    }

}
