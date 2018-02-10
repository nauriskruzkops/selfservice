<?php

namespace App\Controller;

use App\Service\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authUtils)
    {
        if (($error = $authUtils->getLastAuthenticationError())){
            $this->addFlash('error', $error->getMessage());
        }

        $lastUsername = $authUtils->getLastUsername();

        return $this->render('layout/login.html.php', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request, AuthenticationUtils $authUtils) {}

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder, SecurityService $securityService)
    {
        if ($request->isMethod('POST') && $request->get('_useremail', false)) {

            try {
                if(!($user = $securityService->registerUser($request, $encoder))) {
                    $this->addFlash('error', 'User was not created!');
                } else {
                    $this->addFlash('info', 'User created');
                }

            } catch (\Exception $e) {
                $this->addFlash('error', $e->getMessage());
            }

            return $this->redirect('login');
        }

        return $this->render('layout/register.html.php', []);
    }

    /**
     * @Route("/password-recovery", name="password_recovery")
     */
    public function passwordRecovery(Request $request)
    {
        return $this->render('layout/password_recovery.html.php', []);
    }

}