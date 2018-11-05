<?php

namespace WANGARDEN\FactureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facture
 *
 * @ORM\Table(name="facture")
 * @ORM\Entity(repositoryClass="WANGARDEN\FactureBundle\Repository\FactureRepository")
 */
class Facture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**

     * @ORM\ManyToOne(targetEntity="WANGARDEN\FactureBundle\Entity\Client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="WANGARDEN\FactureBundle\Entity\FactureProduit", mappedBy="Facture", cascade={"persist"})
     *
     */
    private $facturesptoduits;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float")
     */
    private $montant;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Facture
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return Facture
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set client
     *
     * @param \WANGARDEN\FactureBundle\Entity\Client $client
     *
     * @return Facture
     */
    public function setClient(\WANGARDEN\FactureBundle\Entity\Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \WANGARDEN\FactureBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->facturesptoduits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add facturesptoduit
     *
     * @param \WANGARDEN\FactureBundle\Entity\FactureProduit $facturesptoduit
     *
     * @return Facture
     */
    public function addFacturesptoduit(\WANGARDEN\FactureBundle\Entity\FactureProduit $facturesptoduit)
    {
        $this->facturesptoduits[] = $facturesptoduit;

        return $this;
    }

    /**
     * Remove facturesptoduit
     *
     * @param \WANGARDEN\FactureBundle\Entity\FactureProduit $facturesptoduit
     */
    public function removeFacturesptoduit(\WANGARDEN\FactureBundle\Entity\FactureProduit $facturesptoduit)
    {
        $this->facturesptoduits->removeElement($facturesptoduit);
    }

    /**
     * Get facturesptoduits
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFacturesptoduits()
    {
        return $this->facturesptoduits;
    }
}
