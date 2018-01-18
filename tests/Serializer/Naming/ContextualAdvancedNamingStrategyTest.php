<?php

/*
 * Copyright 2016 Johannes M. Schmitt <schmittjoh@gmail.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace JMS\Serializer\Tests\Serializer\Naming;

use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;

class ContextualAdvancedNamingStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function providePropertyNames()
    {
        return array(
            array('createdAt'),
            array('my_field'),
            array('identical')
        );
    }

    /**
     * @param $propertyName
     */
    public function testSerialization($propertyName)
    {
        $mockProperty = $this->getMockBuilder('JMS\Serializer\Metadata\PropertyMetadata')->disableOriginalConstructor()->getMock();
        $mockProperty->name = $propertyName;
        $context = SerializationContext::create();

        $strategy = new ContextualNamingStrategy();
        static::assertEquals(strtoupper($propertyName), $strategy->getPropertyName($mockProperty, $context));
    }

    /**
     * @dataProvider providePropertyNames
     */
    public function testDeserialization($propertyName)
    {
        $mockProperty = $this->getMockBuilder('JMS\Serializer\Metadata\PropertyMetadata')->disableOriginalConstructor()->getMock();
        $mockProperty->name = $propertyName;
        $context = DeserializationContext::create();

        $strategy = new ContextualNamingStrategy();
        static::assertEquals(strtolower($propertyName), $strategy->getPropertyName($mockProperty, $context));
    }
}
