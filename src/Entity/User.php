<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Subscription;


/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User extends BaseEntity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $email;

    /**
     * @var Subscription $subscription
     * @ORM\OneToMany(targetEntity="Subscription", mappedBy="user")
     */
    private $subscription;

    /**
     * @ORM\Column(name="is_active", type="boolean",  options={"default":"0"})
     *
     */
    private $isActive = false;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return \App\Entity\Subscription
     */
    public function getSubscription()
    {
        return $this->subscription;
    }

    /**
     * @param \App\Entity\Subscription $subscription
     */
    public function setSubscription(\App\Entity\Subscription $subscription): void
    {
        $this->subscription = $subscription;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }


}