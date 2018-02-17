<?php

namespace App\Controller\System;

use App\Entity\Employee;
use App\Entity\User;
use App\Form\System\UserForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends ExtendController
{
    /**
     * @param Employee $employee
     * @return \Symfony\Component\HttpFoundation\Response
     * @method({"POST"})
     */
    public function editForm(Employee $employee, Request $request)
    {
        if (!($user = $employee->getUser())) {
            $user = new User();
        }

        $company = null;
        if ($employee->getCompanyRelation()) {
            $company = $employee->getCompanyRelation()->last()->getCompany();
        }

        /** @var UserForm $form */
        $form = $this->createForm(UserForm::class, $user, [
            'action' => $this->generateUrl('system_employee_access_edit', ['id' => $employee->getId()]),
            'method' => 'POST',
        ]);

        return $this->render('system/partial/user-menage-form.html.php', [
            'employee' => $employee,
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Employee $employee
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/system/employee/{id}/access/edit", name="system_employee_access_edit", requirements={"id"="\d+"})
     */
    public function editAction($id, Request $request, UserPasswordEncoderInterface $encoder)
    {
        /** @var Employee $employee */
        if(!($employee = $this->getDoctrine()->getRepository(Employee::class)->find($id))){
            return $this->redirectToRoute('system');
        }

        if (!($user = $employee->getUser())) {
            $user = new User();
        }

        $company = null;
        if ($employee->getCompanyRelation()) {
            $company = $employee->getCompanyRelation()->last()->getCompany();
        }

        /** @var UserForm $form */
        $form = $this->createForm(UserForm::class, $user, [
            'action' => $this->generateUrl('system_employee_access_edit', ['id' => $employee->getId()]),
            'method' => 'POST',
        ]);

        $oldPassword = $user->getPassword();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /** @var User $user */
                $user = $form->getData();
                $user->setPassword($oldPassword);
                $rawData = $request->get('user_form');
                $newPassword = $rawData['password'] ?? null;
                if ($newPassword) {
                    if (strlen($newPassword) > 3) {
                        $user->setPassword($encoder->encodePassword($user, $newPassword));
                    }
                }

                $em = $this->getDoctrine()->getManager();
                $em->merge($user);
                $em->flush();

                $this->addFlash(
                    'notice',
                    'Your changes were saved!'
                );
            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }

            return $this->redirectToRoute('system_employee_edit', ['id' => $employee->getId()]);
        }
    }
}