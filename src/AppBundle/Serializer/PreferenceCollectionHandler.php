<?php
/**
 * Created by PhpStorm.
 * User: guigui
 * Date: 29/03/2018
 * Time: 11:30
 */

namespace AppBundle\Serializer;

use AppBundle\Model\PreferenceCollection;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\JsonSerializationVisitor;

class PreferenceCollectionHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'method' => 'handlePreferenceCollection',
                'format' => 'json',
                'type' => PreferenceCollection::class,
            ]
        ];
    }

    public function handlePreferenceCollection(JsonSerializationVisitor $visitor, PreferenceCollection $preferences, array $type, Context $context)
    {
        $values = [];
        foreach ($preferences as $key => $preference) {
            $values[$key] = $preference;
        }
        return $values + ['version' => '1.0'];
    }
}
