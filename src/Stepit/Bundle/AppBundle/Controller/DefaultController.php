<?php

namespace Stepit\Bundle\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Stepit\Bundle\AppBundle\Entity\Matter;
use Stepit\Bundle\AppBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()->getRepository('StepitAppBundle:Project')->findAll();

        return compact('projects');
    }

    /**
     * @Route("/projects/{project}", name="stepit_project")
     * @Template()
     *
     * @ParamConverter("project", class="StepitAppBundle:Project")
     */
    public function projectAction(Project $project)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $steps = $em->getRepository('StepitAppBundle:Step')->findBy([
            'project' => $project,
        ], ['sequence' => 'asc']);

        $matters = $em->getRepository('StepitAppBundle:Matter')->findBy([
            'project' => $project,
            'state' => Matter::STATE_OPEN,
        ]);

        $contents = $em->getRepository('StepitAppBundle:Content')->findByProject($project);

        return compact('project', 'steps', 'matters', 'contents');
    }
}
