<?php


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;
use App\Entity\User;
use App\Entity\Package;


/**
 *
 * @ORM\Entity(repositoryClass="App\Repository\SubscriptionRepository")
 * @ORM\Table(name="subscription")
 */
class Subscription extends BaseEntity
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User $user
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var Package $package
     * @ORM\ManyToOne(targetEntity="Package", inversedBy="package")
     * @ORM\JoinColumn(name="package_id", referencedColumnName="id")
     */
    private $package;

    /**
     * @ORM\Column(name="is_active", type="boolean",  options={"default":"0"})
     *
     */
    private $isActive = false;

    /**
     * @var DateTime $startsAt
     *
     * @ORM\Column(name="starts_at", type="datetime", nullable=true)
     */
    private $startsAt;

    /**
     * @var DateTime $expire_at
     *
     * @ORM\Column(name="expires_at", type="datetime", nullable=true)
     */
    private $expire_at;

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
     * @return \App\Entity\User
     */
    public function getUser(): \App\Entity\User
    {
        return $this->user;
    }

    /**
     * @param \App\Entity\User $user
     */
    public function setUser(\App\Entity\User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return \App\Entity\Package
     */
    public function getPackage(): \App\Entity\Package
    {
        return $this->package;
    }

    /**
     * @param \App\Entity\Package $package
     */
    public function setPackage(\App\Entity\Package $package): void
    {
        $this->package = $package;
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

    /**
     * @return DateTime
     */
    public function getStartsAt(): DateTime
    {
        return $this->startsAt;
    }

    /**
     * @param DateTime $startsAt
     */
    public function setStartsAt(DateTime $startsAt): void
    {
        $this->startsAt = $startsAt;
    }

    /**
     * @return DateTime
     */
    public function getExpireAt(): DateTime
    {
        return $this->expire_at;
    }

    /**
     * @param DateTime $expire_at
     */
    public function setExpireAt(DateTime $expire_at): void
    {
        $this->expire_at = $expire_at;
    }
}