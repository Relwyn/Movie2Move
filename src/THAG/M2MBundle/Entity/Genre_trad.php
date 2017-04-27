<?php
/**
 * Created by PhpStorm.
 * User: relwyn
 * Date: 25/04/17
 * Time: 16:26
 */

namespace THAG\M2MBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Genre_trad
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="THAG\M2MBundle\Entity\Genre")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_genre;

    /**
     * @ORM\ManyToOne(targetEntity="THAG\M2MBundle\Entity\Langue")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_langue;

    /**
     * @ORM\Column(type="string", nullable=false)
     */

    private $genre_trad;



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
     * Set genreTrad
     *
     * @param string $genreTrad
     *
     * @return Genre_trad
     */
    public function setGenreTrad($genreTrad)
    {
        $this->genre_trad = $genreTrad;

        return $this;
    }

    /**
     * Get genreTrad
     *
     * @return string
     */
    public function getGenreTrad()
    {
        return $this->genre_trad;
    }

    /**
     * Set idGenre
     *
     * @param \THAG\M2MBundle\Entity\Genre $idGenre
     *
     * @return Genre_trad
     */
    public function setIdGenre(\THAG\M2MBundle\Entity\Genre $idGenre)
    {
        $this->id_genre = $idGenre;

        return $this;
    }

    /**
     * Get idGenre
     *
     * @return \THAG\M2MBundle\Entity\Genre
     */
    public function getIdGenre()
    {
        return $this->id_genre;
    }

    /**
     * Set idLangue
     *
     * @param \THAG\M2MBundle\Entity\Langue $idLangue
     *
     * @return Genre_trad
     */
    public function setIdLangue(\THAG\M2MBundle\Entity\Langue $idLangue)
    {
        $this->id_langue = $idLangue;

        return $this;
    }

    /**
     * Get idLangue
     *
     * @return \THAG\M2MBundle\Entity\Langue
     */
    public function getIdLangue()
    {
        return $this->id_langue;
    }
}
