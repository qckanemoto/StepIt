<?php

namespace Steppie\Bundle\AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Steppie\Bundle\AppBundle\Entity\Content;
use Steppie\Bundle\AppBundle\Form\Type\ContentType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Rest\RouteResource("Content")
 */
class ContentController extends FOSRestController
{
    /**
     * @Rest\View()
     */
    public function postAction(Request $request)
    {
        $form = $this->createNamelessForm($content = new Content);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();

            return $content;
        }

        return $form;
    }

    /**
     * @Rest\View()
     *
     * @ParamConverter("content")
     */
    public function putAction(Content $content, Request $request)
    {
        $form = $this->createNamelessForm($content, 'PUT');

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();

            return $content;
        }

        return $form;
    }

    /**
     * @Rest\View()
     *
     * @ParamConverter("content")
     */
    public function deleteAction(Content $content)
    {
        $response = [
            'matter' => $content->getMatter(),
            'step' => $content->getStep(),
        ];

        $em = $this->getDoctrine()->getManager();
        $em->remove($content);
        $em->flush();

        return $response;
    }

    /**
     * @param Content $content
     * @param string $method
     * @return \Symfony\Component\Form\Form|\Symfony\Component\Form\FormInterface
     */
    private function createNamelessForm(Content $content, $method = 'POST')
    {
        return $this->get('form.factory')->createNamed('', new ContentType, $content, [
            'method' => $method,
            'csrf_protection' => false,
        ]);
    }
}
