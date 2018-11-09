<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Instance
 *
 * @ORM\Table(name="instance", uniqueConstraints={@ORM\UniqueConstraint(name="instance_aws_id", columns={"instance_aws_id"})}, indexes={@ORM\Index(name="instance_customer_id_idx", columns={"customer_id"})})
 * @ORM\Entity
 */
class Instance
{
    /**
     * @var string
     *
     * @ORM\Column(name="instance_aws_id", type="string", length=255, nullable=false)
     */
    private $instanceAwsId;

    /**
     * @var string
     *
     * @ORM\Column(name="instance_aws_name", type="string", length=255, nullable=false)
     */
    private $instanceAwsName;

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
     * @ORM\Column(name="instance_id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $instanceId;

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
     * Set instanceAwsId
     *
     * @param string $instanceAwsId
     *
     * @return Instance
     */
    public function setInstanceAwsId($instanceAwsId)
    {
        $this->instanceAwsId = $instanceAwsId;

        return $this;
    }

    /**
     * Get instanceAwsId
     *
     * @return string
     */
    public function getInstanceAwsId()
    {
        return $this->instanceAwsId;
    }

    /**
     * Set instanceAwsName
     *
     * @param string $instanceAwsName
     *
     * @return Instance
     */
    public function setInstanceAwsName($instanceAwsName)
    {
        $this->instanceAwsName = $instanceAwsName;

        return $this;
    }

    /**
     * Get instanceAwsName
     *
     * @return string
     */
    public function getInstanceAwsName()
    {
        return $this->instanceAwsName;
    }

    /**
     * Set createDt
     *
     * @param \DateTime $createDt
     *
     * @return Instance
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
     * @return Instance
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
     * Get instanceId
     *
     * @return integer
     */
    public function getInstanceId()
    {
        return $this->instanceId;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return Instance
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
