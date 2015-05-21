<?php

namespace ItechSup\ItechSisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ItechSup\ItechSisBundle\Entity\formation;
use ItechSup\ItechSisBundle\Form\formationType;

/**
 * formation controller.
 *
 * @Route("/formation")
 */
class formationController extends Controller
{

    /**
     * Lists all formation entities.
     *
     * @Route("/", name="formation")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ItechSupItechSisBundle:formation')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new formation entity.
     *
     * @Route("/", name="formation_create")
     * @Method("POST")
     * @Template("ItechSupItechSisBundle:formation:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new formation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('formation_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a formation entity.
     *
     * @param formation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(formation $entity)
    {
        $form = $this->createForm(new formationType(), $entity, array(
            'action' => $this->generateUrl('formation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new formation entity.
     *
     * @Route("/new", name="formation_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new formation();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a formation entity.
     *
     * @Route("/{id}", name="formation_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:formation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find formation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing formation entity.
     *
     * @Route("/{id}/edit", name="formation_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:formation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find formation entity.');
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
    * Creates a form to edit a formation entity.
    *
    * @param formation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(formation $entity)
    {
        $form = $this->createForm(new formationType(), $entity, array(
            'action' => $this->generateUrl('formation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing formation entity.
     *
     * @Route("/{id}", name="formation_update")
     * @Method("PUT")
     * @Template("ItechSupItechSisBundle:formation:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ItechSupItechSisBundle:formation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find formation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('formation_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a formation entity.
     *
     * @Route("/{id}", name="formation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ItechSupItechSisBundle:formation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find formation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('formation'));
    }

    /**
     * Creates a form to delete a formation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('formation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
