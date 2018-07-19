<?php

namespace CoreBundle\Service\User;

use CoreBundle\Entity\User;
use CoreBundle\Model\Request\User\UserLoginRequest;
use CoreBundle\Model\Request\User\UserRegisterRequest;
use Symfony\Component\DependencyInjection\ContainerInterface;
use CoreBundle\Exception\User\UserAlreadyExistsException;
use CoreBundle\Exception\User\ForbiddenException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class TestService
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
    protected $container;

    /**
     * UserService constructor.
     * @param ContainerInterface $container
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(ContainerInterface $container, UserPasswordEncoderInterface $encoder)
    {
        $this->container = $container;
        $this->encoder = $encoder;
    }

    /**
     * @return User
     */
    public function createUser(UserRegisterRequest $request) {

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

        return $user;
    }

    /**
     * @param UserLoginRequest $request
     * @return mixed
     */
    public function loginUser(UserLoginRequest $request) {

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

        return $user;
    }

    /**
     * @return array
     */
    public function getSomeThing() {
//        $client = $this->container->get('neo4j.client');
//        $results = $client->run('MATCH (n:Movie) RETURN n LIMIT 5');
//        foreach ($results->records() as $record) {
//            $node = $record->container->get('n');
//            echo $node->container->get('title'); // "The Matrix"
//        }

        $em = $this->container->get('neo4j.entity_manager');

//        $bart = new User();
//        $bart->setPhone(3131313);
//        $bart->setUsername('Zuev');
//        $bart->setEmail('1234@gmail.com');
//        $bart->setToken('dfsdasd2121sdasda21asd2dasd');
//        $em->persist($bart);
//        $em->flush();

//        $users = $em->getRepository(Test::class)->findBy(['age' => '31']);
        $users = $em->getRepository(User::class)->findAll();

//        foreach ($users as $user) {
//            $em->remove($user);
//            $em->flush();
//        }

        return $users;
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