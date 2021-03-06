<?php

namespace ItechSup\ItechSisBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Event controller.
 *
 * @Route("/api/calendar")
 */
class CalendarController extends Controller
{

    /**
     * Get work day in a nice json output
     *
     * @Route("/", name="api_calendar")
     * @Method("GET")
     */
    public function holidayAction()
    {
        $data = [];
        $calendar = $this->get('calendar');

        $now = new \DateTimeImmutable();
        $start = $now->modify('midnight first day of this month');
        $stop = $now->modify('midnight first day of next month');
        $interval = new \DateInterval('P1D');

        $daterange = new \DatePeriod($start, $interval, $stop);
        foreach ($daterange as $date) {
            if ($calendar->isHolyday($date)) {
                $data[] = [
                    'title'           => 'Férié',
                    'start'           => $date->format(\DateTime::RFC3339),
                    'end'             => $date->modify('+1 day')->format(\DateTime::RFC3339),
                    'backgroundColor' => 'red',
                    'rendering'       => 'background'
                ];

            }
        }

        $em = $this->getDoctrine()->getManager();
        $closingDays = $em->getRepository('ItechSupItechSisBundle:ClosingDay')->findAll();
        foreach ($closingDays as $closingDay) {
            $data[] = [
                'title'           => $closingDay->getReason(),
                'start'           => $closingDay->getClosingDate()->format(\DateTime::RFC3339),
                'end'             => $closingDay->getClosingDate()->modify('+1 day')->format(\DateTime::RFC3339),
                'backgroundColor' => 'yellow',
                'rendering'       => 'background'
            ];
        }

        return new Response(json_encode($data));
    }

    /**
     * Get work day in a nice json output
     *
     * @Route("/school/{id}", name="api_calendar_school")
     * @Method("GET")
     */
    public function schoolAction($id)
    {
        $data = [];
        $calendar = $this->get('calendar');

        $now = new \DateTimeImmutable();
        $start = $now->modify('midnight first day of previous month');
        $stop = $now->modify('midnight first day of next month');
        $interval = new \DateInterval('P1D');

        $daterange = new \DatePeriod($start, $interval, $stop);
        foreach ($daterange as $date) {
            if ($calendar->isHolyday($date)) {
                $data[] = [
                    'title'           => 'Férié',
                    'start'           => $date->format(\DateTime::RFC3339),
                    'end'             => $date->modify('+1 day')->format(\DateTime::RFC3339),
                    'backgroundColor' => 'red',
                    'rendering'       => 'background'
                ];

            }

        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:School')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find School entity.');
        }

        //Just kidding. Closing days are the same in every school

        $closingDays = $em->getRepository('ItechSupItechSisBundle:ClosingDay')->findAll();
        foreach ($closingDays as $closingDay) {
            $data[] = [
                'title'           => $closingDay->getReason(),
                'start'           => $closingDay->getClosingDate()->format(\DateTime::RFC3339),
                'end'             => $closingDay->getClosingDate()->modify('+1 day')->format(\DateTime::RFC3339),
                'backgroundColor' => 'yellow',
                'rendering'       => 'background'
            ];
        }

        return new Response(json_encode($data));
    }

    /**
     * Get work day in a nice json output
     *
     * @Route("/formation/{id}", name="api_calendar_formation")
     * @Method("GET")
     */
    public function formationAction($id)
    {
        $data = [];
        $calendar = $this->get('calendar');

        $now = new \DateTimeImmutable();
        $start = $now->modify('midnight first day of previous month');
        $stop = $now->modify('midnight last day of next month');
        $interval = new \DateInterval('P1D');

        $daterange = new \DatePeriod($start, $interval, $stop);
        foreach ($daterange as $date) {
            if ($calendar->isHolyday($date)) {
                $data[] = [
                    'title' => 'Férié',
                    'start' => $date->format(\DateTime::RFC3339),
                    'end' => $date->modify('+1 day')->format(\DateTime::RFC3339),
                    'backgroundColor' => 'red',
                    'rendering' => 'background'
                ];
            }
        }

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:Formation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Formation entity.');
        }

        //Just kidding. Closing days are the same in every school
        $closingDays = $em->getRepository('ItechSupItechSisBundle:ClosingDay')->findAll();
        foreach ($closingDays as $closingDay) {
            $data[] = [
                'title' => $closingDay->getReason(),
                'start' => $closingDay->getClosingDate()->format(\DateTime::RFC3339),
                'end' => $closingDay->getClosingDate()->modify('+1 day')->format(\DateTime::RFC3339),
                'backgroundColor' => 'yellow',
                'rendering' => 'background'
            ];
        }


        // Now we try and get actual courses
        $courses = $entity->getTimeSlots();
        foreach ($courses as $course) {
            //punctual or periodic ?
            if ($course->isPunctual()) {
                $data[] = [
                    'title' => 'Cours',
                    'start' => $course->getStartDateTime()->format(\DateTime::RFC3339),
                    'end' => $course->getEndDateTime()->format(\DateTime::RFC3339),
                    'backgroundColor' => 'teal',
                ];
            } else {
                foreach ($daterange as $date) {
//                    die($date->format('N').' === '.$course->getDayOfWeek());
                    if ($date->format('N') == $course->getDayOfWeek()) {
                        $data[] = [
                            'title' => 'Cours',
                            'start' => $course->getStartDateTime($date)->format(\DateTime::RFC3339),
                            'end' => $course->getEndDateTime($date)->format(\DateTime::RFC3339),
                            'backgroundColor' => 'blue',
                        ];
                    }
                }
            }
        }

        return new Response(json_encode($data));


    }

    // /**
    //  * Creates a new Event entity.
    //  *
    //  * @Route("/", name="event_create")
    //  * @Method("POST")
    //  * @Template("ItechSupItechSisBundle:Event:new.html.twig")
    //  */
    // public function createAction(Request $request)
    // {
    //     $entity = new Event();
    //     $form = $this->createCreateForm($entity);
    //     $form->handleRequest($request);

    //     if ($form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $em->persist($entity);
    //         $em->flush();

    //         return $this->redirect($this->generateUrl('event_show', array('id' => $entity->getId())));
    //     }

    //     return array(
    //         'entity' => $entity,
    //         'form'   => $form->createView(),
    //     );
    // }

    // /**
    //  * Creates a form to create a Event entity.
    //  *
    //  * @param Event $entity The entity
    //  *
    //  * @return \Symfony\Component\Form\Form The form
    //  */
    // private function createCreateForm(Event $entity)
    // {
    //     $form = $this->createForm(new EventType(), $entity, array(
    //         'action' => $this->generateUrl('event_create'),
    //         'method' => 'POST',
    //     ));

    //     $form->add('submit', 'submit', array('label' => 'Créer'));

    //     return $form;
    // }

    // /**
    //  * Displays a form to create a new Event entity.
    //  *
    //  * @Route("/new", name="event_new")
    //  * @Method("GET")
    //  * @Template()
    //  */
    // public function newAction()
    // {
    //     $entity = new Event();
    //     $form   = $this->createCreateForm($entity);

    //     return array(
    //         'entity' => $entity,
    //         'form'   => $form->createView(),
    //     );
    // }

    // /**
    //  * Finds and displays a Event entity.
    //  *
    //  * @Route("/{id}", name="event_show")
    //  * @Method("GET")
    //  * @Template()
    //  */
    // public function showAction($id)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $entity = $em->getRepository('ItechSupItechSisBundle:Event')->find($id);

    //     if (!$entity) {
    //         throw $this->createNotFoundException('Unable to find Event entity.');
    //     }

    //     $deleteForm = $this->createDeleteForm($id);

    //     return array(
    //         'entity'      => $entity,
    //         'delete_form' => $deleteForm->createView(),
    //     );
    // }

    // /**
    //  * Displays a form to edit an existing Event entity.
    //  *
    //  * @Route("/{id}/edit", name="event_edit")
    //  * @Method("GET")
    //  * @Template()
    //  */
    // public function editAction($id)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $entity = $em->getRepository('ItechSupItechSisBundle:Event')->find($id);

    //     if (!$entity) {
    //         throw $this->createNotFoundException('Unable to find Event entity.');
    //     }

    //     $editForm = $this->createEditForm($entity);
    //     $deleteForm = $this->createDeleteForm($id);

    //     return array(
    //         'entity'      => $entity,
    //         'edit_form'   => $editForm->createView(),
    //         'delete_form' => $deleteForm->createView(),
    //     );
    // }

    // /**
    // * Creates a form to edit a Event entity.
    // *
    // * @param Event $entity The entity
    // *
    // * @return \Symfony\Component\Form\Form The form
    // */
    // private function createEditForm(Event $entity)
    // {
    //     $form = $this->createForm(new EventType(), $entity, array(
    //         'action' => $this->generateUrl('event_update', array('id' => $entity->getId())),
    //         'method' => 'PUT',
    //     ));

    //     return $form;
    // }
    // /**
    //  * Edits an existing Event entity.
    //  *
    //  * @Route("/{id}", name="event_update")
    //  * @Method("PUT")
    //  * @Template("ItechSupItechSisBundle:Event:edit.html.twig")
    //  */
    // public function updateAction(Request $request, $id)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $entity = $em->getRepository('ItechSupItechSisBundle:Event')->find($id);

    //     if (!$entity) {
    //         throw $this->createNotFoundException('Unable to find Event entity.');
    //     }

    //     $deleteForm = $this->createDeleteForm($id);
    //     $editForm = $this->createEditForm($entity);
    //     $editForm->handleRequest($request);

    //     if ($editForm->isValid()) {
    //         $em->flush();

    //         return $this->redirect($this->generateUrl('event_edit', array('id' => $id)));
    //     }

    //     return array(
    //         'entity'      => $entity,
    //         'edit_form'   => $editForm->createView(),
    //         'delete_form' => $deleteForm->createView(),
    //     );
    // }
    // /**
    //  * Deletes a Event entity.
    //  *
    //  * @Route("/{id}", name="event_delete")
    //  * @Method("DELETE")
    //  */
    // public function deleteAction(Request $request, $id)
    // {
    //     $form = $this->createDeleteForm($id);
    //     $form->handleRequest($request);

    //     if ($form->isValid()) {
    //         $em = $this->getDoctrine()->getManager();
    //         $entity = $em->getRepository('ItechSupItechSisBundle:Event')->find($id);

    //         if (!$entity) {
    //             throw $this->createNotFoundException('Unable to find Event entity.');
    //         }

    //         $em->remove($entity);
    //         $em->flush();
    //     }

    //     return $this->redirect($this->generateUrl('event'));
    // }

    // /**
    //  * Creates a form to delete a Event entity by id.
    //  *
    //  * @param mixed $id The entity id
    //  *
    //  * @return \Symfony\Component\Form\Form The form
    //  */
    // private function createDeleteForm($id)
    // {
    //     return $this->createFormBuilder()
    //         ->setAction($this->generateUrl('event_delete', array('id' => $id)))
    //         ->setMethod('DELETE')
    //         ->add('submit', 'submit', array('label' => 'Supprimer'))
    //         ->getForm()
    //     ;
    // }
}
