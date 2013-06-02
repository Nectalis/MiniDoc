<?php

namespace Nectalis\MiniDocBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nectalis\MiniDocBundle\Entity\TimeSlot;
use Nectalis\MiniDocBundle\Form\TimeSlotType;

/**
 * TimeSlot controller.
 *
 * @Route("/timeslot")
 */
class TimeSlotController extends Controller
{
    /**
     * Lists all TimeSlot entities.
     *
     * @Route("/", name="timeslot")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('NectalisMiniDocBundle:TimeSlot')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new TimeSlot entity.
     *
     * @Route("/", name="timeslot_create")
     * @Method("POST")
     * @Template("NectalisMiniDocBundle:TimeSlot:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new TimeSlot();
        $form = $this->createForm(new TimeSlotType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('timeslot_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new TimeSlot entity.
     *
     * @Route("/new", name="timeslot_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TimeSlot();
        $form   = $this->createForm(new TimeSlotType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TimeSlot entity.
     *
     * @Route("/{id}", name="timeslot_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NectalisMiniDocBundle:TimeSlot')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeSlot entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TimeSlot entity.
     *
     * @Route("/{id}/edit", name="timeslot_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NectalisMiniDocBundle:TimeSlot')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeSlot entity.');
        }

        $editForm = $this->createForm(new TimeSlotType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing TimeSlot entity.
     *
     * @Route("/{id}", name="timeslot_update")
     * @Method("PUT")
     * @Template("NectalisMiniDocBundle:TimeSlot:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('NectalisMiniDocBundle:TimeSlot')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TimeSlot entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new TimeSlotType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('timeslot_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a TimeSlot entity.
     *
     * @Route("/{id}", name="timeslot_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('NectalisMiniDocBundle:TimeSlot')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TimeSlot entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('timeslot'));
    }

    /**
     * Creates a form to delete a TimeSlot entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
