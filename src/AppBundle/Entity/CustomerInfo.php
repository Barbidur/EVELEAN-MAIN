<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerInfo
 *
 * @ORM\Table(name="customer_info", indexes={@ORM\Index(name="customer_info_customer_id_idx", columns={"customer_id"})})
 * @ORM\Entity
 */
class CustomerInfo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="customer_info_business_type", type="integer", nullable=false)
     */
    private $customerInfoBusinessType;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_info_industry", type="string", length=255, nullable=false)
     */
    private $customerInfoIndustry;

    /**
     * @var boolean
     *
     * @ORM\Column(name="customer_info_has_domain", type="boolean", nullable=false)
     */
    private $customerInfoHasDomain;

    /**
     * @var integer
     *
     * @ORM\Column(name="customer_info_facebook_ads_expenditure", type="bigint", nullable=false)
     */
    private $customerInfoFacebookAdsExpenditure;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_info_leadpages_target", type="string", length=255, nullable=false)
     */
    private $customerInfoLeadpagesTarget;

    /**
     * @var boolean
     *
     * @ORM\Column(name="customer_info_domain", type="boolean", nullable=true)
     */
    private $customerInfoDomain;

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
     * @ORM\Column(name="customer_info_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $customerInfoId;

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
     * Set customerInfoBusinessType
     *
     * @param integer $customerInfoBusinessType
     *
     * @return CustomerInfo
     */
    public function setCustomerInfoBusinessType($customerInfoBusinessType)
    {
        $this->customerInfoBusinessType = $customerInfoBusinessType;

        return $this;
    }

    /**
     * Get customerInfoBusinessType
     *
     * @return integer
     */
    public function getCustomerInfoBusinessType()
    {
        return $this->customerInfoBusinessType;
    }

    /**
     * Set customerInfoIndustry
     *
     * @param string $customerInfoIndustry
     *
     * @return CustomerInfo
     */
    public function setCustomerInfoIndustry($customerInfoIndustry)
    {
        $this->customerInfoIndustry = $customerInfoIndustry;

        return $this;
    }

    /**
     * Get customerInfoIndustry
     *
     * @return string
     */
    public function getCustomerInfoIndustry()
    {
        return $this->customerInfoIndustry;
    }

    /**
     * Set customerInfoHasDomain
     *
     * @param boolean $customerInfoHasDomain
     *
     * @return CustomerInfo
     */
    public function setCustomerInfoHasDomain($customerInfoHasDomain)
    {
        $this->customerInfoHasDomain = $customerInfoHasDomain;

        return $this;
    }

    /**
     * Get customerInfoHasDomain
     *
     * @return boolean
     */
    public function getCustomerInfoHasDomain()
    {
        return $this->customerInfoHasDomain;
    }

    /**
     * Set customerInfoFacebookAdsExpenditure
     *
     * @param integer $customerInfoFacebookAdsExpenditure
     *
     * @return CustomerInfo
     */
    public function setCustomerInfoFacebookAdsExpenditure($customerInfoFacebookAdsExpenditure)
    {
        $this->customerInfoFacebookAdsExpenditure = $customerInfoFacebookAdsExpenditure;

        return $this;
    }

    /**
     * Get customerInfoFacebookAdsExpenditure
     *
     * @return integer
     */
    public function getCustomerInfoFacebookAdsExpenditure()
    {
        return $this->customerInfoFacebookAdsExpenditure;
    }

    /**
     * Set customerInfoLeadpagesTarget
     *
     * @param string $customerInfoLeadpagesTarget
     *
     * @return CustomerInfo
     */
    public function setCustomerInfoLeadpagesTarget($customerInfoLeadpagesTarget)
    {
        $this->customerInfoLeadpagesTarget = $customerInfoLeadpagesTarget;

        return $this;
    }

    /**
     * Get customerInfoLeadpagesTarget
     *
     * @return string
     */
    public function getCustomerInfoLeadpagesTarget()
    {
        return $this->customerInfoLeadpagesTarget;
    }

    /**
     * Set customerInfoDomain
     *
     * @param boolean $customerInfoDomain
     *
     * @return CustomerInfo
     */
    public function setCustomerInfoDomain($customerInfoDomain)
    {
        $this->customerInfoDomain = $customerInfoDomain;

        return $this;
    }

    /**
     * Get customerInfoDomain
     *
     * @return boolean
     */
    public function getCustomerInfoDomain()
    {
        return $this->customerInfoDomain;
    }

    /**
     * Set createDt
     *
     * @param \DateTime $createDt
     *
     * @return CustomerInfo
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
     * @return CustomerInfo
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
     * Get customerInfoId
     *
     * @return integer
     */
    public function getCustomerInfoId()
    {
        return $this->customerInfoId;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return CustomerInfo
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
