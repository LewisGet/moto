<?php

namespace Aedes\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=25)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=25)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="text")
     */
    private $contact;

    /**
     * @var string
     *
     * @ORM\Column(name="ezTime", type="string", length=255)
     */
    private $ezTime;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set contact
     *
     * @param string $contact
     * @return User
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set ezTime
     *
     * @param string $ezTime
     * @return User
     */
    public function setEzTime($ezTime)
    {
        $this->ezTime = $ezTime;

        return $this;
    }

    /**
     * Get ezTime
     *
     * @return string
     */
    public function getEzTime()
    {
        return $this->ezTime;
    }
}