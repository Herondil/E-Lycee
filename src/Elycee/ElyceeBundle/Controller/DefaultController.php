<?php

namespace Elycee\ElyceeBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use FOS\UserBundle\Controller\SecurityController as BaseController;

class DefaultController extends BaseController
{

    /**
     * @Route("/home", name="ElyceeBundle.default.index")
     * @Template("ElyceeElyceeBundle:Default:index.html.twig")
     */
    public function indexAction(Request $request)
    {

        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $fb = $this->get('session')->getFlashBag();
        $fb->set('login', "vous êtes bien connectés");
        $session = $request->getSession();
        return array();

        if (class_exists('\Symfony\Component\Security\Core\Security')) {
            $authErrorKey = Security::AUTHENTICATION_ERROR;
            $lastUsernameKey = Security::LAST_USERNAME;
        } else {
            // BC for SF < 2.6
            $authErrorKey = SecurityContextInterface::AUTHENTICATION_ERROR;
            $lastUsernameKey = SecurityContextInterface::LAST_USERNAME;
        }

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);

            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        if ($this->has('security.csrf.token_manager')) {
            $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
        } else {
            // BC for SF < 2.4
            $csrfToken = $this->has('form.csrf_provider')
                ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
                : null;
        }

        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));

    }



    /**
     * @Route("/actu", name="ElyceeBundle.default.actu")
     * @Template("ElyceeElyceeBundle:Default:actu.html.twig")
     */
    public function actuAction()
    {
        return array();
    }


    /**
     * @Route("/lelycee", name="ElyceeBundle.default.lelycee")
     * @Template("ElyceeElyceeBundle:Default:lelycee.html.twig")
     */
    public function lelyceeAction()
    {
        return array();
    }

    /**
     * @Route("/contact", name="ElyceeBundle.default.contact")
     * @Template("ElyceeElyceeBundle:Default:contact.html.twig")
     */
    public function contactAction()
    {
        return array();
    }



    /**
     * @Route("/mentions_legales", name="ElyceeBundle.default.ml")
     * @Template("ElyceeElyceeBundle:Default:ml.html.twig")
     */
    public function mlAction()
    {
        return array();
    }











}
