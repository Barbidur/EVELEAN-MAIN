<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="user_login", columns={"user_login"})}, indexes={@ORM\Index(name="user_customer_id_idx", columns={"customer_id"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Column(name="user_login", type="string", length=255, nullable=false)
     */
    private $userLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=255, nullable=false)
     */
    private $userPassword;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_dt", type="datetime", nullable=true)
     */
    private $createDt = 'CURRENT_TIMESTAMP';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_dt", type="datetime", nullable=true)
     */
    private $updateDt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var \AppBundle\Entity\Customer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")
     * })
     */
    private $customer;



    /**
     * Set userLogin
     *
     * @param string $userLogin
     *
     * @return User
     */
    public function setUserLogin($userLogin)
    {
        $this->userLogin = $userLogin;

        return $this;
    }

    /**
     * Get userLogin
     *
     * @return string
     */
    public function getUserLogin()
    {
        return $this->userLogin;
    }

    /**
     * Set userPassword
     *
     * @param string $userPassword
     *
     * @return User
     */
    public function setUserPassword($userPassword)
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    /**
     * Get userPassword
     *
     * @return string
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }

    /**
     * Set createDt
     *
     * @param \DateTime $createDt
     *
     * @return User
     */
    public function setCreateDt($createDt)
    {
        $this->createDt = $createDt;

        return $this;
    }

    /**
     * Get createDt
     *
     * @return \DateTime
     */
    public function getCreateDt()
    {
        return $this->createDt;
    }

    /**
     * Set updateDt
     *
     * @param \DateTime $updateDt
     *
     * @return User
     */
    public function setUpdateDt($updateDt)
    {
        $this->updateDt = $updateDt;

        return $this;
    }

    /**
     * Get updateDt
     *
     * @return \DateTime
     */
    public function getUpdateDt()
    {
        return $this->updateDt;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return User
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }
}
