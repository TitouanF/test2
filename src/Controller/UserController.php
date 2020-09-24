<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;

use MongoDB\BSON\UTCDateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints\DateTimeValidator;

class UserController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request  $request,EntityManagerInterface $em,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $user->setUsername("test");
        $user->setDateCreated( new \DateTime());
        $registerForm = $this->createForm(RegisterType::class,$user);
        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid())
        {
            $hashed = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($hashed);
            $em->persist($user);
            $em->flush();
        }
        return $this->render('user/register.html.twig',["registerForm" => $registerForm->createView()]);
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(Request  $request,EntityManagerInterface $em,UserPasswordEncoderInterface $encoder )
    {
        return $this->render('user/login.html.twig',[]);
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {}
}
