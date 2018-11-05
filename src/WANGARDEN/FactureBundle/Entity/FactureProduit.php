<?php

namespace WANGARDEN\FactureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureProduit
 *
 * @ORM\Table(name="facture_produit")
 * @ORM\Entity(repositoryClass="WANGARDEN\FactureBundle\Repository\FactureProduitRepository")
 */
class FactureProduit
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

* @ORM\ManyToOne(targetEntity="WANGARDEN\FactureBundle\Entity\Produit")

* @ORM\JoinColumn(nullable=false)

*/

    private $produit;

    /**
* @ORM\ManyToOne(targetEntity="WANGARDEN\FactureBundle\Entity\Facture", inversedBy="facturesptoduits", cascade={"persist"})
* @ORM\JoinColumn(nullable=false)
*/
    private $Facture;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return FactureProduit
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return FactureProduit
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
     * Set produit
     *
     * @param \WANGARDEN\FactureBundle\Entity\Produit $produit
     *
     * @return FactureProduit
     */
    public function setProduit(\WANGARDEN\FactureBundle\Entity\Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \WANGARDEN\FactureBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * Set facture
     *
     * @param \WANGARDEN\FactureBundle\Entity\Facture $facture
     *
     * @return FactureProduit
     */
    public function setFacture(\WANGARDEN\FactureBundle\Entity\Facture $facture)
    {
        $this->Facture = $facture;

        return $this;
    }

    /**
     * Get facture
     *
     * @return \WANGARDEN\FactureBundle\Entity\Facture
     */
    public function getFacture()
    {
        return $this->Facture;
    }
}
