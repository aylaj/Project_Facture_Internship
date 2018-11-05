<?php
namespace WANGARDEN\FactureBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
* Client
*
* @ORM\Table(name="client")
* @ORM\Entity(repositoryClass="WANGARDEN\FactureBundle\Repository\ClientRepository")
* @UniqueEntity(fields="mail", message="Cette adresse mail existe deja.")
*/
class Client
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
    * @var string
    *
    * @ORM\Column(name="nom", type="string", length=255, unique=true)
    * @Assert\Length(min=2, max=10)
    */
    private $nom;

    /**
    * @var string
    *
    * @ORM\Column(name="prenom", type="string", length=255)
    * @Assert\Length(min=2)
    */
    private $prenom;

    /**
    * @var string
    *
    * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
    */
    private $adresse;

    /**
    * @var string
    *
    * @ORM\Column(name="mail", type="string", length=255, nullable=true, unique=true)
    */
    private $mail;

    /**
    * @var int
    *
    * @ORM\Column(name="tel", type="string", length=255, nullable=true)
    *@Assert\Length(min=2)
    */
    private $tel;

    /**
    * @var bool
    *
    * @ORM\Column(name="societe", type="boolean")
    */
    private $societe;


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
    * Set nom
    *
    * @param string $nom
    *
    * @return Client
    */
    public function setNom($nom)
    {
        $this->nom = ucfirst($nom);
        //Uucfirst(strtolower($nom));: remplacer le premier caaractèreen majuscule
        return $this;
    }

    /**
    * Get nom
    *
    * @return string
    */
    public function getNom()
    {
        return $this->nom;
    }


    /**
    * @Assert\Callback
    *
    */
    public function isContentValid(ExecutionContextInterface $context)
    {
        $forbiddenWords = array('[0-9]','\W');
        // On vérifie que le contenu ne contient pas l'un des mots
        if (preg_match('#'.implode('|', $forbiddenWords).'#', $this->getNom())) {

    // La règle est violée, on définit l'erreur
            $context
    ->buildViolation('Contenu invalide car il contient des chiffres ou des caractères speciaux.') // message
    ->atPath('nom')      // attribut de l'objet qui est violé
    ->addViolation();
        }
        //déclenche l'erreur
        if (preg_match('#'.implode('|', $forbiddenWords).'#', $this->getPrenom())) {
            $context
->buildViolation('Contenu invalide car il contient des chiffres ou des caractères speciaux.') // message
->atPath('prenom')      // attribut de l'objet qui est violé
->addViolation();
        }
    }

    /**
    * Set prenom
    *
    * @param string $prenom
    *
    * @return Client
    */
    public function setPrenom($prenom)
    {
        $this->prenom = ucfirst($prenom);

        return $this;
    }

    /**
    * Get prenom
    *
    * @return string
    */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
    * Set adresse
    *
    * @param string $adresse
    *
    * @return Client
    */
    public function setAdresse($adresse)
    {
        $this->adresse = ucfirst($adresse);

        return $this;
    }

    /**
    * Get adresse
    *
    * @return string
    */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
    * Set mail
    *
    * @param string $mail
    *
    * @return Client
    */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
    * Get mail
    *
    * @return string
    */
    public function getMail()
    {
        return $this->mail;
    }

    /**
    * Set tel
    *
    * @param integer $tel
    *
    * @return Client
    */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
    * Get tel
    *
    * @return int
    */
    public function getTel()
    {
        return $this->tel;
    }

    /**
    * Set societe
    *
    * @param boolean $societe
    *
    * @return Client
    */
    public function setSociete($societe)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
    * Get societe
    *
    * @return bool
    */
    public function getSociete()
    {
        return $this->societe;
    }
}
