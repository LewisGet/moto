<?php

namespace Aedes\MotoBundle\Controller;

use Aedes\MotoBundle\Filter\MotoFilter;
use Aedes\MotoBundle\Form\MotoFilterType;
use Aedes\MotoBundle\Helper\Filter;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Acl\Domain\ObjectIdentity;
use Symfony\Component\Security\Acl\Domain\UserSecurityIdentity;
use Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Aedes\MotoBundle\Entity\Moto;
use Aedes\MotoBundle\Form\MotoType;

/**
 * Moto controller.
 *
 * @Route("/")
 */
class MotoController extends Controller
{

    /**
     * Lists all Moto entities.
     *
     * @Route("/", name="moto")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        return $this->motoList(function($q){
            return $q;
        });
    }

    /**
     * user moto Lists entities.
     *
     * @Route("/my", name="my_moto")
     * @Method("GET")
     * @Template("AedesMotoBundle:Moto:index.html.twig")
     */
    public function ownAction()
    {
        $user = $this->getUser();

        return $this->motoList(
            function($q) use ($user)
            {
                return $q->andWhere("o.createBy = :user")
                    ->setParameter("user", $user);
            }
        );
    }

    /**
     * motoList
     *
     * @param callback
     *
     * @return  array
     */
    public function motoList($parQuery)
    {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $paginator  = $this->get('knp_paginator');

        $repository = $em->getRepository('AedesMotoBundle:Moto');

        $query = Filter::find($repository, $request, "o",
            MotoFilter::listFilter()
        );

        $query = $parQuery($query);

        $pagination = $paginator->paginate(
            $query->getQuery(),
            $request->query->get('page', 1),
            10
        );

        $filterForm = $this->createFilterForm("moto");
        $filterForm->handleRequest($request);

        return array(
            'pagination' => $pagination,
            'filter' => $filterForm->createView()
        );
    }

    /**
     * Creates a new Moto entity.
     *
     * @Route("/", name="moto_create")
     * @Method("POST")
     * @Template("AedesMotoBundle:Moto:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Moto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setCreateBy($this->getUser());

            $em->persist($entity);
            $em->flush();

            // creating the ACL
            $aclProvider = $this->get('security.acl.provider');
            $objectIdentity = ObjectIdentity::fromDomainObject($entity);
            $acl = $aclProvider->createAcl($objectIdentity);

            // retrieving the security identity of the currently logged-in user
            $securityContext = $this->get('security.context');
            $user = $securityContext->getToken()->getUser();
            $securityIdentity = UserSecurityIdentity::fromAccount($user);

            // grant owner access
            $acl->insertObjectAce($securityIdentity, MaskBuilder::MASK_OWNER);
            $aclProvider->updateAcl($acl);

            return $this->redirect($this->generateUrl('moto_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Moto entity.
     *
     * @param Moto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Moto $entity)
    {
        $motoType = new MotoType();

        $motoType->user = $this->getUser();

        $form = $this->createForm($motoType, $entity, array(
            'action' => $this->generateUrl('moto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    private function createFilterForm($actionRouteName)
    {
        $motoType = new MotoFilterType(MotoFilter::listFilter());

        $form = $this->createForm($motoType, null, array(
                'action' => $this->generateUrl($actionRouteName),
                'method' => 'GET',
            ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Moto entity.
     *
     * @Route("/new", name="moto_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Moto();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Moto entity.
     *
     * @Route("/detail/{id}", name="moto_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AedesMotoBundle:Moto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Moto entity.
     *
     * @Route("/edit/{id}", name="moto_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AedesMotoBundle:Moto')->find($id);

        $securityContext = $this->get('security.context');

        if (false === $securityContext->isGranted('EDIT', $entity)) {
            throw new AccessDeniedException();
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moto entity.');
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
    * Creates a form to edit a Moto entity.
    *
    * @param Moto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Moto $entity)
    {
        $motoType = new MotoType();

        $motoType->user = $this->getUser();

        $form = $this->createForm($motoType, $entity, array(
            'action' => $this->generateUrl('moto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Moto entity.
     *
     * @Route("/update/{id}", name="moto_update")
     * @Method("PUT")
     * @Template("AedesMotoBundle:Moto:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AedesMotoBundle:Moto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Moto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('moto_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Moto entity.
     *
     * @Route("/delete/{id}", name="moto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AedesMotoBundle:Moto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Moto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('moto'));
    }

    /**
     * Creates a form to delete a Moto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('moto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
