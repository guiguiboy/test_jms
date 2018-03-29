<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Model\Basket;
use AppBundle\Model\PreferenceCollection;
use AppBundle\Model\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/user/{userLogin}", name="get_user_by_login")
     *
     * @param Request $request
     */
    public function getUserAction(Request $request, string $userLogin)
    {
        $contextFactory = $this->getContextFactory();
        $serializationContext = $contextFactory->createSerializationContext();

        $user = new User();
        $user->setLogin($userLogin);
        $user->setFirstName('guigui');
        $user->setLastName('boy');

        $preferences = new PreferenceCollection();
        $preferences->set('background', 'dark');

        $user->setPreferences($preferences);

        $basket = new Basket();
        $basket->setId(12);
        $basket->setCreatedAt(new \DateTime('2016-02-03'));

        $user->addBasket($basket);

        $content = $this->container->get('jms_serializer')->serialize($user, 'json', $serializationContext);
        return new JsonResponse($content, 200, [], true);
    }

    /**
     * @Route("/user", name="post_user_by_login", methods="POST")
     *
     * @param Request $request
     */
    public function postUserAction(Request $request)
    {
        $contextFactory = $this->getContextFactory();
        $deserializationContext = $contextFactory->createDeserializationContext();

        $input = $request->getContent();

        $this->container->get('jms_serializer')->deserialize($input, User::class, 'json', $deserializationContext);

        return new JsonResponse(['status' => 'OK']);
    }

    protected function getContextFactory()
    {
        $contextFactory       = $this->get('jms_serializer.serialization_context_factory');
        $contextFactory->setVersion('1.6');
        return $contextFactory;
    }
}
