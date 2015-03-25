<?php

namespace Steppie\Bundle\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Steppie\Bundle\AppBundle\Entity\Matter;
use Steppie\Bundle\AppBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @Route("/project")
 */
class ProjectController extends Controller
{
    /**
     * @Route("/", name="steppie_app_project_index")
     * @Template()
     */
    public function indexAction()
    {
        $projects = $this->getDoctrine()->getRepository('SteppieAppBundle:Project')->findAll();

        return compact('projects');
    }

    /**
     * @Route("/{project}", name="steppie_app_project_main")
     * @Template()
     *
     * @ParamConverter("project", class="SteppieAppBundle:Project")
     */
    public function mainAction(Project $project)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $steps = $em->getRepository('SteppieAppBundle:Step')->findBy([
            'project' => $project,
        ], ['sequence' => 'asc']);

        $matters = $em->getRepository('SteppieAppBundle:Matter')->findBy([
            'project' => $project,
            'state' => Matter::STATE_OPEN,
        ]);

        $contents = $em->getRepository('SteppieAppBundle:Content')->findByProject($project);

        return compact('project', 'steps', 'matters', 'contents');
    }
}
