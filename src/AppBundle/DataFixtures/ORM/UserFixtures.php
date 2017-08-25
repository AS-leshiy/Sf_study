<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class UserFixtures extends AbstractFixture implements ContainerAwareInterface
{
    use ContainerAwareTrait;
    
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $passwordEncoder = $this->container->get('security.password_encoder');

        $someAmin = new User();
        $someAmin->setUsername('admin');
        $someAmin->setRoles(['ROLE_ADMIN']);
        $encodedPassword = $passwordEncoder->encodePassword($someAmin, 'adminpass');
        $someAmin->setPassword($encodedPassword);
        $manager->persist($someAmin);
        $this->addReference('some-admin', $someAmin);

        $manager->flush();
    }
}
