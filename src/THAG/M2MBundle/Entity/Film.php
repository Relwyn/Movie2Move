<?php
/**
 * Created by PhpStorm.
 * User: relwyn
 * Date: 25/04/17
 * Time: 15:41
 */

namespace THAG\M2MBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Film
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="THAG\M2MBundle\Entity\Acteur", cascade={"persist"})
     */
    private $acteurs;

    /**
     * @ORM\ManyToMany(targetEntity="THAG\M2MBundle\Entity\Realisateur", cascade={"persist"})
     */
    private $realisateurs;

    /**
     * @ORM\ManyToMany(targetEntity="THAG\M2MBundle\Entity\Genre", cascade={"persist"})
     */
    private $genres;

    /**
     * @ORM\Column(name="date", type="integer")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity="THAG\M2MBundle\Entity\Film_trad", mappedBy="film")
     */
    private $id_film_trad;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->acteurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->realisateurs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->genres = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add acteur
     *
     * @param \THAG\M2MBundle\Entity\Acteur $acteur
     *
     * @return Film
     */
    public function addActeur(\THAG\M2MBundle\Entity\Acteur $acteur)
    {
        $this->acteurs[] = $acteur;

        return $this;
    }

    /**
     * Remove acteur
     *
     * @param \THAG\M2MBundle\Entity\Acteur $acteur
     */
    public function removeActeur(\THAG\M2MBundle\Entity\Acteur $acteur)
    {
        $this->acteurs->removeElement($acteur);
    }

    /**
     * Get acteurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActeurs()
    {
        return $this->acteurs;
    }

    /**
     * Add realisateur
     *
     * @param \THAG\M2MBundle\Entity\Realisateur $realisateur
     *
     * @return Film
     */
    public function addRealisateur(\THAG\M2MBundle\Entity\Realisateur $realisateur)
    {
        $this->realisateurs[] = $realisateur;

        return $this;
    }

    /**
     * Remove realisateur
     *
     * @param \THAG\M2MBundle\Entity\Realisateur $realisateur
     */
    public function removeRealisateur(\THAG\M2MBundle\Entity\Realisateur $realisateur)
    {
        $this->realisateurs->removeElement($realisateur);
    }

    /**
     * Get realisateurs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRealisateurs()
    {
        return $this->realisateurs;
    }

    /**
     * Add genre
     *
     * @param \THAG\M2MBundle\Entity\Genre $genre
     *
     * @return Film
     */
    public function addGenre(\THAG\M2MBundle\Entity\Genre $genre)
    {
        $this->genres[] = $genre;

        return $this;
    }

    /**
     * Remove genre
     *
     * @param \THAG\M2MBundle\Entity\Genre $genre
     */
    public function removeGenre(\THAG\M2MBundle\Entity\Genre $genre)
    {
        $this->genres->removeElement($genre);
    }

    /**
     * Get genres
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGenres()
    {
        return $this->genres;
    }


    /**
     * Set date
     *
     * @param integer $date
     *
     * @return Film
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return integer
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add idFilmTrad
     *
     * @param \THAG\M2MBundle\Entity\Film_trad $idFilmTrad
     *
     * @return Film
     */
    public function addIdFilmTrad(\THAG\M2MBundle\Entity\Film_trad $idFilmTrad)
    {
        $this->id_film_trad[] = $idFilmTrad;

        return $this;
    }

    /**
     * Remove idFilmTrad
     *
     * @param \THAG\M2MBundle\Entity\Film_trad $idFilmTrad
     */
    public function removeIdFilmTrad(\THAG\M2MBundle\Entity\Film_trad $idFilmTrad)
    {
        $this->id_film_trad->removeElement($idFilmTrad);
    }

    /**
     * Get idFilmTrad
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIdFilmTrad()
    {
        return $this->id_film_trad;
    }
}
