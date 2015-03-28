<?php

namespace Steppie\Bundle\AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Steppie\Bundle\AppBundle\Entity\Matter;
use Steppie\Bundle\AppBundle\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

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

        return [
            'projects' => $projects,
        ];
    }

    /**
     * @Route("/{project}", name="steppie_app_project_main")
     * @Template()
     *
     * @ParamConverter("project", class="SteppieAppBundle:Project")
     *
     * todo: want to refactor
     */
    public function mainAction(Project $project, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $steps = $em->getRepository('SteppieAppBundle:Step')->findBy([
            'project' => $project,
        ], ['sequence' => 'asc']);

        $matters = $em->getRepository('SteppieAppBundle:Matter')->findBy([
            'project' => $project,
            'state' => Matter::STATE_OPEN,
        ]);

        if ($selectedOwners = $request->get('owners')) {
            $selectedMatters = [];
            foreach ($matters as $matter) {
                foreach ($selectedOwners as $owner) {
                    if (in_array($owner, $matter->getOwners())) {
                        $selectedMatters[] = $matter;
                        break;
                    }
                }
            }
        } else {
            $selectedMatters = $matters;
        }

        $contents = $em->getRepository('SteppieAppBundle:Content')->findByProject($project);

        $owners = [];
        foreach ($matters as $matter) {
            $owners = array_merge($owners, $matter->getOwners());
        }
        $owners = array_unique($owners);
        sort($owners);

        return [
            'project' => $project,
            'steps' => $steps,
            'matters' => $selectedMatters,
            'contents' => $contents,
            'owners' => [
                'all' => $owners,
                'selected' => $selectedOwners,
            ],
        ];
    }
}
