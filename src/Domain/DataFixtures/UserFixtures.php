<?php

namespace App\Domain\DataFixtures;

use App\Domain\Models\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var PasswordEncoderInterface
     */
    private $encoder;

    /**
     * UserFixtures constructor.
     * @param EncoderFactoryInterface $encoder
     */
    public function __construct(EncoderFactoryInterface $encoder)
    {
        $this->encoder = $encoder->getEncoder(User::class);
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User(
            'JohnDoe',
            $this->encoder->encodePassword('12345678', ''),
            ['ROLE_USER']
        );

        $manager->persist($user);
        $manager->flush();
    }
}
