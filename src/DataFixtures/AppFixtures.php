<?php


namespace App\DataFixtures;

use DateTime;
use App\Entity\User;
use App\Entity\Package;
use App\Entity\Subscription;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $this->loadUsers($manager);
        $this->loadPackages($manager);
     //   $this->loadSubscription($manager);
    }

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$name, $username, $email]) {
            $user = new User();
            $user->setName($name);
            $user->setUsername($username);;
            $user->setEmail($email);
            $user->setCreatedAt(new DateTime('now'));
            $user->setUpdatedAt(new DateTime('now'));
            $manager->persist($user);
            $this->addReference($username, $user);
        }
        $manager->flush();
    }

    private function loadPackages(ObjectManager $manager): void
    {
        foreach ($this->getPackageData() as [$title, $description, $price, $currency, $durationDays]) {
            $package = new Package();
            $package->setTitle($title);
            $package->setDescription($description);
            $package->setPrice($price);
            $package->setCurrency($currency);
            $package->setDurationDays($durationDays);
            $package->setCreatedAt(new DateTime('now'));
            $package->setUpdatedAt(new DateTime('now'));
            $manager->persist($package);
            $this->addReference($title, $package);
        }
        $manager->flush();
    }
   /* private function loadSubscription(ObjectManager $manager): void
    {
        foreach ($this->getSubscriptionData() as [$title, $slug, $summary, $content, $publishedAt, $author, $tags]) {
            $subscription = new Subscription();
            $subscription->setUser($slug);
            $subscription->setPackage($summary);
            $subscription->setIsActive();
            $subscription->setStartsAt();
            $subscription->getExpireAt();
            $subscription->setCreatedAt(new DateTime('now'));
            $subscription->setUpdatedAt(new DateTime('now'));

            $manager->persist($subscription);
        }
        $manager->flush();
    }

*/
    private function getUserData(): array
    {
        return [
            // $userData = [$name, $username, $email, $roles];
            ['John Doe', 'johndoe', 'john_admin@symfony.com'],
            //['Tom Doe', 'tom_admin', 'kitten', 'tom_admin@symfony.com'],
            //['John Doe', 'john_user', 'kitten', 'john_user@symfony.com'],
        ];
    }

    private function getPackageData(): array
    {
        return [
            //packageData = [$title, $description, $price, $currency, $durationDays]
            ['Basic', 'basic desc', 10, 'usd', 30],
            ['Pro', 'pro desc', 50, 'usd', 30],
            ['Elite', 'elite desc', 100, 'usd', 30],
        ];
    }
    private function getSubscriptionData()
    {


    }
}