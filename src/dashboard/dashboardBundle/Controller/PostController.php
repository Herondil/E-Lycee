<?php


namespace dashboard\dashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request as Request;
use Symfony\Component\Security\Core\Security;

use Elycee\ElyceeBundle\Entity\Posts;
use Elycee\ElyceeBundle\Form\PostsType;
use Doctrine\Common\Util\Debug as Debug;
use FOS\RestBundle\Controller\FOSRestController;


class PostController extends Controller
{


    /**
     * @Route(
     *      "/posts/new",
     *      name="public.contact.form",
     * )
     * @Template("dashboarddashboardBundle:dashboard:form.html.twig")
     * @Method({"POST","GET"})
     */

    public function PostsgetAction(Request $request)
    {


        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $entity = new Posts();
        $type = new PostsType();
        $form = $this->createForm($type, $entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            //$data = $form->getData();

            $em->flush();
            // message en session
            $request->getSession()->getFlashBag()->set('notice', 'l article a été enregistre');

            // on redirige l'utilisateur
            $url = $this->generateUrl('dashboard.default.user');
            return $this->redirect($url);


            $message = "L'article a été ajouté";

            echo '<pre>';
            Debug::dump($entity);
            echo '</pre>';
            exit();


        }

        return array(
            'form' => $form->createView()
        );


    }

    /**
     * @Route(
     *      "/posts/update/{id}",
     *      name="dashboard.posts.update",
     * )
     * @Template("dashboarddashboardBundle:dashboard:postsedit.html.twig")
     * @Method({"POST","GET"})
     */
    public function editAction(Request $request, $id)
    {

        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        if (!$id) {
            $message = "Le contact a été ajouté";
        } else {


            $repository = $doctrine->getRepository('ElyceeElyceeBundle:Posts');
            $entity = $repository->find($id);
            $message = "Le contact a été mis à jour";
        }


            $entity = new Posts();
            $type = new PostsType();
            $form = $this->createForm($type, $entity);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                //$data = $form->getData();
                $em->flush();
                // message en session
                $request->getSession()->getFlashBag()->set('notice', $message);

                // on redirige l'utilisateur
                $url = $this->generateUrl('dashboard.default.user');
                return $this->redirect($url);


                $message = "L'article a été ajouté";


            }
            return array(
                'form' => $form->createView()
            );





    }

}

