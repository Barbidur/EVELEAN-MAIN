<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 *
 * @ORM\Table(name="customer", uniqueConstraints={@ORM\UniqueConstraint(name="customer_email", columns={"customer_email"})})
 * @ORM\Entity
 */
class Customer
{
    /**
     * @var string
     *
     * @ORM\Column(name="customer_email", type="string", length=255, nullable=false)
     */
    private $customerEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_company", type="string", length=255, nullable=false)
     */
    private $customerCompany;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_fname", type="string", length=255, nullable=false)
     */
    private $customerFname;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_lname", type="string", length=255, nullable=false)
     */
    private $customerLname;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_country", type="string", length=255, nullable=false)
     */
    private $customerCountry;

    /**
     * @var boolean
     *
     * @ORM\Column(name="customer_receive_update", type="boolean", nullable=false)
     */
    private $customerReceiveUpdate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="customer_belong_to_group", type="boolean", nullable=false)
     */
    private $customerBelongToGroup;

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
     * @ORM\Column(name="customer_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $customerId;

    /**
     * Set customerEmail
     *
     * @param string $customerEmail
     *
     * @return Customer
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * Get customerEmail
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * Set customerCompany
     *
     * @param string $customerCompany
     *
     * @return Customer
     */
    public function setCustomerCompany($customerCompany)
    {
        $this->customerCompany = $customerCompany;

        return $this;
    }

    /**
     * Get customerCompany
     *
     * @return string
     */
    public function getCustomerCompany()
    {
        return $this->customerCompany;
    }

    /**
     * Set customerFname
     *
     * @param string $customerFname
     *
     * @return Customer
     */
    public function setCustomerFname($customerFname)
    {
        $this->customerFname = $customerFname;

        return $this;
    }

    /**
     * Get customerFname
     *
     * @return string
     */
    public function getCustomerFname()
    {
        return $this->customerFname;
    }

    /**
     * Set customerLname
     *
     * @param string $customerLname
     *
     * @return Customer
     */
    public function setCustomerLname($customerLname)
    {
        $this->customerLname = $customerLname;

        return $this;
    }

    /**
     * Get customerLname
     *
     * @return string
     */
    public function getCustomerLname()
    {
        return $this->customerLname;
    }

    /**
     * Set customerCountry
     *
     * @param string $customerCountry
     *
     * @return Customer
     */
    public function setCustomerCountry($customerCountry)
    {
        $this->customerCountry = $customerCountry;

        return $this;
    }

    /**
     * Get customerCountry
     *
     * @return string
     */
    public function getCustomerCountry()
    {
        return $this->customerCountry;
    }

    /**
     * Set customerReceiveUpdate
     *
     * @param boolean $customerReceiveUpdate
     *
     * @return Customer
     */
    public function setCustomerReceiveUpdate($customerReceiveUpdate)
    {
        $this->customerReceiveUpdate = $customerReceiveUpdate;

        return $this;
    }

    /**
     * Get customerReceiveUpdate
     *
     * @return boolean
     */
    public function getCustomerReceiveUpdate()
    {
        return $this->customerReceiveUpdate;
    }

    /**
     * Set customerBelongToGroup
     *
     * @param boolean $customerBelongToGroup
     *
     * @return Customer
     */
    public function setCustomerBelongToGroup($customerBelongToGroup)
    {
        $this->customerBelongToGroup = $customerBelongToGroup;

        return $this;
    }

    /**
     * Get customerBelongToGroup
     *
     * @return boolean
     */
    public function getCustomerBelongToGroup()
    {
        return $this->customerBelongToGroup;
    }

    /**
     * Set createDt
     *
     * @param \DateTime $createDt
     *
     * @return Customer
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
     * @return Customer
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
     * Get customerId
     *
     * @return integer
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

}
