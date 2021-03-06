<?php

namespace ItechSup\ItechSisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ItechSup\ItechSisBundle\Entity\School;
use ItechSup\ItechSisBundle\Form\Type\SchoolType;

/**
 * School controller.
 *
 * @Route("/param/school")
 */
class SchoolController extends Controller
{

    /**
     * Lists all School entities.
     *
     * @Route("/", name="school")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ItechSupItechSisBundle:School')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new School entity.
     *
     * @Route("/", name="school_create")
     * @Method("POST")
     * @Template("ItechSupItechSisBundle:School:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new School();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('school_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a School entity.
     *
     * @param School $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(School $entity)
    {
        $form = $this->createForm(new SchoolType(), $entity, array(
            'action' => $this->generateUrl('school_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new School entity.
     *
     * @Route("/new", name="school_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new School();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a School entity.
     *
     * @Route("/{id}", name="school_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:School')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find School entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing School entity.
     *
     * @Route("/{id}/edit", name="school_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:School')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find School entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a School entity.
    *
    * @param School $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(School $entity)
    {
        $form = $this->createForm(new SchoolType(), $entity, array(
            'action' => $this->generateUrl('school_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing School entity.
     *
     * @Route("/{id}", name="school_update")
     * @Method("PUT")
     * @Template("ItechSupItechSisBundle:School:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:School')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find School entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('school_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a School entity.
     *
     * @Route("/{id}", name="school_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ItechSupItechSisBundle:School')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find School entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('school'));
    }

    /**
     * Creates a form to delete a School entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('school_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Adds a new ClosingDay to a School entityh.
     *
     * @Route("/{id}/closing-day/add", name="school_closing_day_add")
     * @Method("GET")
     * @Template("ItechSupItechSisBundle:School:addClosingDay.html.twig")
     */
    public function functionAddClosingDay()
    {
        return [];
    }
}
