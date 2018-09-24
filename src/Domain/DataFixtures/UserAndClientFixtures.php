<?php

namespace App\Domain\DataFixtures;

use App\Domain\Models\Client;
use App\Domain\Models\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class UserAndClientFixtures extends Fixture
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
        $client = new Client(
            'DoeSarl',
            $this->encoder->encodePassword('12345678', '')
        );
        $manager->persist($client);
        $manager->flush();

        $user1 = new User(
            'JohnDoe',
            $this->encoder->encodePassword('12345678', ''),
            ['ROLE_USER'],
            $client
        );
        $manager->persist($user1);

        $user2 = new User(
            'JaneDoe',
            $this->encoder->encodePassword('12345678', ''),
            ['ROLE_USER'],
            $client
        );
        $manager->persist($user2);

        $manager->flush();
    }
}
