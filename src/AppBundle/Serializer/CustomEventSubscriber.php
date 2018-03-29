<?php
/**
 * Created by PhpStorm.
 * User: guigui
 * Date: 29/03/2018
 * Time: 12:14
 */

namespace AppBundle\Serializer;


use AppBundle\Model\PreferenceCollection;
use AppBundle\Model\User;
use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\EventDispatcher\PreSerializeEvent;
use JMS\Serializer\JsonSerializationVisitor;

class CustomEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            [
                'event' => 'serializer.pre_serialize',
                'class' => User::class,
                'method' => 'onPreSerialize',
            ],
            [
                'event' => 'serializer.post_serialize',
                //'class' => User::class, //this is not mandatory : this will be executed for all kind of objects serialized
                'method' => 'onPostSerialize',
            ],
        ];
    }

    public function onPreSerialize(PreSerializeEvent $preSerializeEvent)
    {
        //at this moment, we can change some values before the serialization.
        //this is only executed for User types
        $preSerializeEvent->getObject()->setFirstName('before_serialization');
    }

    public function onPostSerialize(ObjectEvent $event)
    {
        if ($event->getVisitor() instanceof JsonSerializationVisitor) {
            $event->getVisitor()->setData('_links', [
                    'self' => 'http://example.com/' . rand(),
                ]
            );
        }
    }

}