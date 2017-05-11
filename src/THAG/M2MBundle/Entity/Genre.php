<?php
/**
 * Created by PhpStorm.
 * User: relwyn
 * Date: 25/04/17
 * Time: 16:23
 */

namespace THAG\M2MBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Genre
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $genre;

    /**
     * @ORM\ManyToMany(targetEntity="THAG\M2MBundle\Entity\Film", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;
    /**
     * @ORM\ManyToOne(targetEntity="THAG\M2MBundle\Entity\Langue")
     * @ORM\JoinColumn(nullable=false)
     */
    private $langue;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->film = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set genre
     *
     * @param string $genre
     *
     * @return Genre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return string
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Add film
     *
     * @param \THAG\M2MBundle\Entity\Film $film
     *
     * @return Genre
     */
    public function addFilm(\THAG\M2MBundle\Entity\Film $film)
    {
        $this->film[] = $film;

        return $this;
    }

    /**
     * Remove film
     *
     * @param \THAG\M2MBundle\Entity\Film $film
     */
    public function removeFilm(\THAG\M2MBundle\Entity\Film $film)
    {
        $this->film->removeElement($film);
    }

    /**
     * Get film
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFilm()
    {
        return $this->film;
    }

    /**
     * Set langue
     *
     * @param \THAG\M2MBundle\Entity\Langue $langue
     *
     * @return Genre
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
}
