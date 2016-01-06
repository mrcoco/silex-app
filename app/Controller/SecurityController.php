<?php

namespace App\Controller;

use Silex\Application;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class SecurityController
 * @package App\Controller
 */

class SecurityController {

    /**
     * @param Request $request
     * @param Application $app
     * @return mixed
     */
	public function loginAction(Application $app)
    {
		return $app['twig']->render('public/login.html.twig', [
            'message' => '',
            'username' => ''
        ]);
	}

    /**
     * @param Request $request
     * @param Application $app
     * @return RedirectResponse
     */
	public function loginProcessAction(Request $request, Application $app)
    {
        $userRepository = new UserRepository($app['pdo']);

        $user = $userRepository->getByUsername($request->get('username'));

        if(!empty($user)) {
            if(password_verify($request->get('password'), $user->getPassword()))
            {
                $app['session']->set('logged', true);
                $app['session']->set('user_id', $user->getId());
                return new RedirectResponse('/admin');
            }
        }

        return $app['twig']->render('public/login.html.twig', [
            'message' => 'Invalid email or password',
            'username' => $request->get('username')
        ]);
	}

    /**
     * @param Application $app
     * @return RedirectResponse
     */
	public function logoutAction(Application $app)
    {
        $app['session']->set('logged', false);
		return new RedirectResponse('/');
	}

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function passwordAction(Request $request)
    {
        $password = password_hash($request->get('string'), PASSWORD_BCRYPT);
        return new JsonResponse(['string' => $password], 200);
    }

}