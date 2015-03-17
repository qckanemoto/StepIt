<?php

namespace Stepit\Bundle\AppBundle\Controller\Rest;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Stepit\Bundle\AppBundle\Entity\Content;
use Stepit\Bundle\AppBundle\Form\Type\ContentType;
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
        $form = $this->get('form.factory')->createNamed('', new ContentType(), $content = new Content(), [
            'csrf_protection' => false,
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($content);
            $em->flush();

            return $content;
        }

        return $form;
    }
}
