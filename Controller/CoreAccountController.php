<?php

namespace Erp\Bundle\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Erp\Bundle\CoreBundle\Entity\CoreAccount;
use Erp\Bundle\CoreBundle\Form\CoreAccountType;

/**
 * CoreAccount controller.
 *
 * @Route("/coreaccount")
 */
class CoreAccountController extends Controller
{
    /**
     * Lists all CoreAccount entities.
     *
     * @Route("/", name="coreaccount_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        /*
        $em = $this->getDoctrine()->getManager();

        $coreAccounts = $em->getRepository('ErpCoreBundle:CoreAccount')->findAll();
        */
        $service = $this->get('erp_core.service.core_account');
        $coreAccounts = $service->findAll();

        return $this->render('coreaccount/index.html.twig', array(
            'coreAccounts' => $coreAccounts,
        ));
    }

    /**
     * Creates a new CoreAccount entity.
     *
     * @Route("/new", name="coreaccount_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $coreAccount = new CoreAccount();
        $form = $this->createForm('Erp\Bundle\CoreBundle\Form\CoreAccountType', $coreAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*
            $em = $this->getDoctrine()->getManager();
            $em->persist($coreAccount);
            $em->flush();
            */
            $service = $this->get('erp_core.service.core_account');
            $coreAccounts = $service->save($coreAccount);

            return $this->redirectToRoute('coreaccount_show', array('id' => $coreAccount->getId()));
        }

        return $this->render('coreaccount/new.html.twig', array(
            'coreAccount' => $coreAccount,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a CoreAccount entity.
     *
     * @Route("/{id}", name="coreaccount_show")
     * @Method("GET")
     */
    public function showAction(CoreAccount $coreAccount)
    {
        $deleteForm = $this->createDeleteForm($coreAccount);

        return $this->render('coreaccount/show.html.twig', array(
            'coreAccount' => $coreAccount,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing CoreAccount entity.
     *
     * @Route("/{id}/edit", name="coreaccount_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CoreAccount $coreAccount)
    {
        $deleteForm = $this->createDeleteForm($coreAccount);
        $editForm = $this->createForm('Erp\Bundle\CoreBundle\Form\CoreAccountType', $coreAccount);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /*
            $em = $this->getDoctrine()->getManager();
            $em->persist($coreAccount);
            $em->flush();
            */
            $service = $this->get('erp_core.service.core_account');
            $service->save($coreAccount);

            return $this->redirectToRoute('coreaccount_edit', array('id' => $coreAccount->getId()));
        }

        return $this->render('coreaccount/edit.html.twig', array(
            'coreAccount' => $coreAccount,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a CoreAccount entity.
     *
     * @Route("/{id}", name="coreaccount_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CoreAccount $coreAccount)
    {
        $form = $this->createDeleteForm($coreAccount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*
            $em = $this->getDoctrine()->getManager();
            $em->remove($coreAccount);
            $em->flush();
            */
            $service = $this->get('erp_core.service.core_account');
            $service->remove($coreAccount);
        }

        return $this->redirectToRoute('coreaccount_index');
    }

    /**
     * Creates a form to delete a CoreAccount entity.
     *
     * @param CoreAccount $coreAccount The CoreAccount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CoreAccount $coreAccount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('coreaccount_delete', array('id' => $coreAccount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
