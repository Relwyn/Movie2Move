<?php
/**
 * Created by PhpStorm.
 * User: relwyn
 * Date: 25/04/17
 * Time: 16:25
 */

namespace THAG\M2MBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Film_trad
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="THAG\M2MBundle\Entity\Film", cascade={"persist"},inversedBy="id_film_trad")
     * @ORM\JoinColumn(nullable=false)
     */
    private  $film;

    /**
     * @ORM\ManyToOne(targetEntity="THAG\M2MBundle\Entity\Langue")
     * @ORM\JoinColumn(nullable=false)
     */
    private $langue;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $titre_trad;

    /**
     * @ORM\Column(type="string", nullable=false, length=10000)
     */
    private $synopsis_trad;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titreTrad
     *
     * @param string $titreTrad
     *
     * @return Film_trad
     */
    public function setTitreTrad($titreTrad)
    {
        $this->titre_trad = $titreTrad;

        return $this;
    }

    /**
     * Get titreTrad
     *
     * @return string
     */
    public function getTitreTrad()
    {
        return $this->titre_trad;
    }

    /**
     * Set synopsisTrad
     *
     * @param string $synopsisTrad
     *
     * @return Film_trad
     */
    public function setSynopsisTrad($synopsisTrad)
    {
        $this->synopsis_trad = $synopsisTrad;

        return $this;
    }

    /**
     * Get synopsisTrad
     *
     * @return string
     */
    public function getSynopsisTrad()
    {
        return $this->synopsis_trad;
    }




    /**
     * Set langue
     *
     * @param \THAG\M2MBundle\Entity\Langue $langue
     *
     * @return Film_trad
     */
    public function setLangue(\THAG\M2MBundle\Entity\Langue $langue)
    {
        $this->langue = $langue;

        return $this;
    }

    /**
     * Get langue
     *
     * @return \THAG\M2MBundle\Entity\Langue
     */
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * Set film
     *
     * @param \THAG\M2MBundle\Entity\Film $film
     *
     * @return Film_trad
     */
    public function setFilm(\THAG\M2MBundle\Entity\Film $film)
    {
        $this->film = $film;
        return $this;
    }

    /**
     * Get film
     *
     * @return \THAG\M2MBundle\Entity\Film
     */
    public function getFilm()
    {
        return $this->film;
    }
}
