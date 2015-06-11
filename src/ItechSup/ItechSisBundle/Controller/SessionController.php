<?php

namespace ItechSup\ItechSisBundle\Controller;

use ItechSup\ItechSisBundle\Form\Type\EventType;
use ItechSup\ItechSisBundle\Entity\Student;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ItechSup\ItechSisBundle\Entity\Session;
use ItechSup\ItechSisBundle\Entity\Event;
use ItechSup\ItechSisBundle\Form\Type\SessionType;
use ItechSup\ItechSisBundle\Form\Type\StudentType;


/**
 * Session controller.
 *
 * @Route("/session")
 */
class SessionController extends Controller
{

    /**
     * Lists all Session entities.
     *
     * @Route("/", name="session")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ItechSupItechSisBundle:Session')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Session entity.
     *
     * @Route("/", name="session_create")
     * @Method("POST")
     * @Template("ItechSupItechSisBundle:Session:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Session();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('session_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Session entity.
     *
     * @param Session $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Session $entity)
    {
        $form = $this->createForm(new SessionType(), $entity, array(
            'action' => $this->generateUrl('session_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Session entity.
     *
     * @Route("/new", name="session_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Session();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Session entity.
     *
     * @Route("/{id}", name="session_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Session entity.
     *
     * @Route("/{id}/edit", name="session_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Session entity.
     *
     * @param Session $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Session $entity)
    {
        $form = $this->createForm(new SessionType(), $entity, array(
            'action' => $this->generateUrl('session_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Session entity.
     *
     * @Route("/{id}", name="session_update")
     * @Method("PUT")
     * @Template("ItechSupItechSisBundle:Session:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('session'));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Session entity.
     *
     * @Route("/{id}", name="session_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ItechSupItechSisBundle:Session')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Session entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('session'));
    }

    /**
     * Creates a form to delete a Session entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('session_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

    /**
    * Enlist students in a session.
    *
    * @Route("/{id}/enlist", name="session_enlist")
    * @Method("GET")
    * @Template()
    */
    public function enlistAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:Session')->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }

        $students = $em->getRepository('ItechSupItechSisBundle:Student')->findUnlistedStudent();

        return array(
            'entity' => $entity,
            'students' => $students,
        );
    }

    /**
     *
<<<<<<< HEAD
     * @Route("/{id}/event",name="session_event")
     * @Method("GET")
     * @Template()
     */
    public function eventEditAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ItechSupItechSisBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }
        $event = new Event();
        $event->setSession($entity);
        $form = $this->createForm(new EventType(), $event, array(
            'action' => $this->generateUrl('session_event_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }
    
    /**
     *
     * @Route("/{id}/event",name="session_event_update")
     * @Method("PUT")
     * @Template("ItechSupItechSisBundle:Session:eventEdit.html.twig")
     */
    public function eventUpdateAction(Request $request, $id)
    {
        $em= $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ItechSupItechSisBundle:Session')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }
        $event = new Event();
        $event->setSession($entity);
        $form = $this->createForm(new EventType(), $event, array(
            'action' => $this->generateUrl('session_event_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Update'));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('session_event', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * @Route("/{id}/enlist",name="session_enlist_update")
     * @Method("PUT")
     * @Template("ItechSupItechSisBundle:Session:enlist.html.twig")
     */
    public function enlistUpdateAction(Request $request, $id)
    {
        $em= $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ItechSupItechSisBundle:Session')->find($id);
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Session entity.');
        }
        dump($request);

        return array(
            'entity' => $entity,
        );
    }
}