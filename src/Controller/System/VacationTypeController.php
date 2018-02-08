<?php

namespace App\Controller\System;

use App\Entity\Company;
use App\Entity\VacationType;
use App\Form\System\VacationTypeForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VacationTypeController extends ExtendController
{
    public function list($company, Request $request)
    {
        /** @var Company $company */
        $company = $request->get('company');
        $types = $this->getDoctrine()
            ->getRepository(VacationType::class)
            ->findBy(['company' => $company]);

        return $this->render('system/partial/vacation-types-list.html.php', [
            'icon' => 'fa fa-fw fa-users',
            'title' => 'Vacation/Leave types list',
            'company' => $company,
            'types' => $types,
        ]);
    }

    /**
     * @Route("/system/company/{id}/vacation/type/add", name="system_vacation_type_add")
     */
    public function addAction($id, Request $request)
    {
        $type = new VacationType();
        if(($company = $this->getDoctrine()->getRepository(Company::class)->find($id))){
            $type->setCompany($company);
        }

        /** @var VacationTypeForm $form */
        $form = $this->createForm(VacationTypeForm::class, $type, [
            'action' => $this->generateUrl('system_vacation_type_add', ['id' => $company ? $company->getId() : 0]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->persist($form->getData());
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Your changes were saved!'
                );

                return $this->redirectToRoute('system_vacation_type_edit', ['id' => $type->getId()]);
            } catch (\Exception $e) {
                var_dump($e);
            }
        }

        return $this->render('system/vacation-type.html.php', [
            'company' => $company,
            'type' => $type,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/system/vacation/type/{id}/edit", name="system_vacation_type_edit", requirements={"id"="\d+"})
     */
    public function editAction($id, Request $request)
    {
        /** @var VacationType $employee */
        if(!($type = $this->getDoctrine()->getRepository(VacationType::class)->find($id))){
            return $this->redirectToRoute('system');
        }

        /** @var VacationTypeForm $form */
        $form = $this->createForm(VacationTypeForm::class, $type, [
            'action' => $this->generateUrl('system_vacation_type_edit', ['id' => $type->getId()]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em = $this->getDoctrine()->getManager();
                $em->merge($form->getData());
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Your changes were saved!'
                );

                return $this->redirectToRoute('system_vacation_type_edit', ['id' => $type->getId()]);
            } catch (\Exception $e) {
                var_dump($e);
            }
        }

        return $this->render('system/vacation-type.html.php', [
            'type' => $type,
            'company' => $type->getCompany(),
            'form' => $form->createView(),
        ]);
    }
}