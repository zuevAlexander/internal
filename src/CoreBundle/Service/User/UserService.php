<?php

namespace CoreBundle\Service\User;

use CoreBundle\Entity\ResponseUser;
use CoreBundle\Entity\User;
use CoreBundle\Exception\User\UserNotFoundException;
use CoreBundle\Model\Request\User\UserListRequest;
use CoreBundle\Model\Request\User\UserLoginRequest;
use CoreBundle\Model\Request\User\UserRegisterRequest;
use CoreBundle\Model\Request\User\UserRestorePasswordRequest;
use CoreBundle\Model\Request\User\UserUpdatePatchRequest;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CoreBundle\Exception\User\UserAlreadyExistsException;
use CoreBundle\Exception\User\ForbiddenException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\TwigBundle\TwigEngine;

/**
 * Class UserService
 */
class UserService
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
    * @var ContainerInterface
    */
    private $container;

    /**
     * @var TwigEngine
     */
    private $templating;

    /**
     * @var string
     */
    private $senderEmail;

    /**
     * UserService constructor.
     * @param ContainerInterface $container
     * @param UserPasswordEncoderInterface $encoder
     * @param TwigEngine $templating
     * @param \Swift_Mailer $mailer
     * @param string $senderEmail
     */
    public function __construct(ContainerInterface $container, UserPasswordEncoderInterface $encoder, TwigEngine $templating, \Swift_Mailer $mailer, string $senderEmail)
    {
        $this->container = $container;
        $this->encoder = $encoder;
        $this->templating = $templating;
        $this->mailer = $mailer;
        $this->senderEmail = $senderEmail;
    }

    /**
     * @param UserRegisterRequest $request
     * @return ResponseUser
     */
    public function createUser(UserRegisterRequest $request): ResponseUser
    {
        $em = $this->container->get('neo4j.entity_manager');
        $user = $em->getRepository(User::class)->findOneBy(['email' => $request->getEmail()]);

        if ($user instanceof User) {
            throw new UserAlreadyExistsException();
        } else {
            $user = new User();
            $salt = $this->generateSalt();

            $user->setPhone($request->getPhone());
            $user->setUsername($request->getUsername());
            $user->setEmail($request->getEmail());
            $user->setPassword($this->generatePasswordHash($request->getPassword(), $salt))->setSalt($salt);
            $user->setToken(bin2hex(random_bytes(20)));

            $em->persist($user);
            $em->flush();
        }

        return new ResponseUser($user);
    }

    /**
     * @param UserLoginRequest $request
     * @return ResponseUser
     */
    public function loginUser(UserLoginRequest $request): ResponseUser
    {
        $em = $this->container->get('neo4j.entity_manager');
        $user = $em->getRepository(User::class)->findOneBy(['email' => $request->getEmail()]);

        if ($user instanceof User) {
            if (!hash_equals($user->getPassword(),
                $this->generatePasswordHash($request->getPassword(), $user->getSalt()))
            ) {
                throw new ForbiddenException();
            }
        } else {
            throw new ForbiddenException();
        }

        $user->setToken(bin2hex(random_bytes(20)));
        $em->persist($user);
        $em->flush();

        return new ResponseUser($user);
    }

    /**
     * @param UserRestorePasswordRequest $request
     * @return ResponseUser
     * @throws UserNotFoundException
     */
    public function restorePassword(UserRestorePasswordRequest $request) : ResponseUser
    {
        $em = $this->container->get('neo4j.entity_manager');
        $user = $em->getRepository(User::class)->findOneBy(['email' => $request->getEmail()]);

        if ($user instanceof User) {
            $newPassword = bin2hex(random_bytes(4));
            $salt = $this->generateSalt();
            $user->setPassword($this->generatePasswordHash($newPassword, $salt))->setSalt($salt);
            $user->setToken(bin2hex(random_bytes(20)));
            $em->persist($user);
            $em->flush();

            $messageTemplate = $this->templating->render(
                'Emails/Restore-password.html.twig',
                [
                    'userName' => $user->getUsername(),
                    'newPassword' => $newPassword
                ]
            );

            $message = \Swift_Message::newInstance()
                ->setSubject('Restore password on Artemis')
                ->setFrom($this->senderEmail)
                ->setTo($user->getEmail())
                ->setBody(
                    $messageTemplate,
                    'text/html'
                );

            $this->mailer->send($message);

            return new ResponseUser($user);
        } else {
            throw new UserNotFoundException;
        }
    }

    /**
     * @param UserUpdatePatchRequest $request
     * @return ResponseUser
     */
    public function updateUser(UserUpdatePatchRequest $request): ResponseUser
    {
        $em = $this->container->get('neo4j.entity_manager');
        $user = $em->getRepository(User::class)->findOneBy(['email' => $request->getProfile()]);

        if ($user instanceof User) {
            if ($request->getUsername()) {
                $user->setUsername($request->getUsername());
            }

            if ($request->getEmail()) {
                $user->setEmail($request->getEmail());
            }

            if ($request->getPhone()) {
                $user->setPhone($request->getPhone());
            }

            if ($request->getGender()) {
                $user->setGender($request->getGender());
            }

            if ($request->getAge()) {
                $user->setAge($request->getAge());
            }

            if ($request->getCountry()) {
                $user->setCountry($request->getCountry());
            }

            if ($request->getZipcode()) {
                $user->setZipcode($request->getZipcode());
            }

            $em->persist($user);
            $em->flush();

            return new ResponseUser($user);
        } else {
            throw new UserNotFoundException;
        }
    }

    /**
     * @param UserListRequest $request
     * @return array
     */
    public function getUsers(UserListRequest $request): array
    {
        $em = $this->container->get('neo4j.entity_manager');
        $users = $em->getRepository(User::class)->findAll();

        $ResponseUsers = [];
        foreach ($users as $user) {
            $ResponseUsers[] = new ResponseUser($user);
        }

        return $ResponseUsers;
    }

    /**
     * @return string
     */
    public function generateSalt(): string
    {
        return uniqid(mt_rand(), true);
    }

    /**
     * @param string $plainPassword
     * @param string $salt
     * @return string
     */
    public function generatePasswordHash(string $plainPassword, string $salt): string
    {
        return sha1($salt . $plainPassword);
    }
}