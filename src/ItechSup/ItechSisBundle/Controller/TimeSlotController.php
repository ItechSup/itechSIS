<?php

namespace ItechSup\ItechSisBundle\Controller;

use ItechSup\ItechSisBundle\Entity\PeriodicTimeSlot;
use ItechSup\ItechSisBundle\Entity\PunctualTimeSlot;
use ItechSup\ItechSisBundle\Form\Type\PeriodicTimeSlotType;
use ItechSup\ItechSisBundle\Form\Type\PunctualTimeSlotType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * TimeSlot controller.
 *
 * @Route("/param/formation")
 */
class TimeSlotController extends Controller
{

    /**
     * Displays a Form to create a new PunctualTimeSlot entity
     * for an existing Formation entity
     *
     * @Route("/{id}/course/add/", name="punctualtimeslot_new")
     * @Method("GET")
     * @Template("ItechSupItechSisBundle:PunctualTimeSlot:new.html.twig")
     */
    public function newPunctualTimeSlotAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository('ItechSupItechSisBundle:Formation')->find($id);

        if (!$formation) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        $entity = new PunctualTimeSlot();
        $entity->setFormation($formation);

        $form = $this->createCreatePunctualTimeSlotForm($entity);
        return array(
            'formation' => $formation,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PunctualTimeSlot entity.
     *
     * @param PunctualTimeSlot $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreatePunctualTimeSlotForm(PunctualTimeSlot $entity)
    {
        $form = $this->createForm(new PunctualTimeSlotType(), $entity, array(
            'action' => $this->generateUrl(
                'punctualtimeslot_create',
                ['id' => $entity->getFormation()->getId()]
            ),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a Form to create a new PunctualTimeSlot entity
     * for an existing Formation entity
     *
     * @Route("/{id}/course/add/", name="punctualtimeslot_create")
     * @Method("POST")
     * @Template("ItechSupItechSisBundle:PunctualTimeSlot:new.html.twig")
     */
    public function createPunctualTimeSlotAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository('ItechSupItechSisBundle:Formation')->find($id);

        if (!$formation) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        $entity = new PunctualTimeSlot();
        $entity->setFormation($formation);

        $form = $this->createCreatePunctualTimeSlotForm($entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formation_show', array('id' => $formation->getId())));
        }
        return array(
            'formation' => $formation,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Displays a Form to create a new PunctualTimeSlot entity
     * for an existing Formation entity
     *
     * @Route("/{id}/course/set/", name="periodictimeslot_new")
     * @Method("GET")
     * @Template("ItechSupItechSisBundle:PeriodicTimeSlot:new.html.twig")
     */
    public function newPeriodicTimeSlotAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository('ItechSupItechSisBundle:Formation')->find($id);

        if (!$formation) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        $entity = new PeriodicTimeSlot();
        $entity->setFormation($formation);

        $form = $this->createCreatePeriodicTimeSlotForm($entity);
        return array(
            'formation' => $formation,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a PunctualTimeSlot entity.
     *
     * @param PunctualTimeSlot $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreatePeriodicTimeSlotForm(PeriodicTimeSlot $entity)
    {
        $form = $this->createForm(new PeriodicTimeSlotType(), $entity, array(
            'action' => $this->generateUrl(
                'periodictimeslot_create',
                ['id' => $entity->getFormation()->getId()]
            ),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a Form to create a new PunctualTimeSlot entity
     * for an existing Formation entity
     *
     * @Route("/{id}/course/set/", name="periodictimeslot_create")
     * @Method("POST")
     * @Template("ItechSupItechSisBundle:PeriodicTimeSlot:new.html.twig")
     */
    public function createPeriodicTimeSlotAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $formation = $em->getRepository('ItechSupItechSisBundle:Formation')->find($id);

        if (!$formation) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        $entity = new PeriodicTimeSlot();
        $entity->setFormation($formation);

        $form = $this->createCreatePeriodicTimeSlotForm($entity);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formation_show', array('id' => $formation->getId())));
        }
        return array(
            'formation' => $formation,
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }
}
