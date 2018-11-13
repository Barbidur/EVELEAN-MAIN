<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreditCard
 *
 * @ORM\Table(name="credit_card", uniqueConstraints={@ORM\UniqueConstraint(name="credit_card_stripe_token", columns={"credit_card_stripe_token"})}, indexes={@ORM\Index(name="credit_card_customer_id_idx", columns={"customer_id"})})
 * @ORM\Entity
 */
class CreditCard
{
    /**
     * @var string
     *
     * @ORM\Column(name="credit_card_stripe_token", type="string", length=255, nullable=false)
     */
    private $creditCardStripeToken;

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
     * @ORM\Column(name="credit_card_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $creditCardId;

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
     * Set creditCardStripeToken
     *
     * @param string $creditCardStripeToken
     *
     * @return CreditCard
     */
    public function setCreditCardStripeToken($creditCardStripeToken)
    {
        $this->creditCardStripeToken = $creditCardStripeToken;

        return $this;
    }

    /**
     * Get creditCardStripeToken
     *
     * @return string
     */
    public function getCreditCardStripeToken()
    {
        return $this->creditCardStripeToken;
    }

    /**
     * Set createDt
     *
     * @param \DateTime $createDt
     *
     * @return CreditCard
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
     * @return CreditCard
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
     * Get creditCardId
     *
     * @return integer
     */
    public function getCreditCardId()
    {
        return $this->creditCardId;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     *
     * @return CreditCard
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
