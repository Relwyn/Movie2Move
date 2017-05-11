<?php
/**
 * Created by PhpStorm.
 * User: relwyn
 * Date: 26/04/17
 * Time: 12:08
 */

namespace THAG\M2MBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class score
{

    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="THAG\M2MBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="THAG\M2MBundle\Entity\Film")
     * @ORM\JoinColumn(nullable=false)
     */
    private $film;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $score=-1;

    //peux etre creer un second score fictif juste pour améliorer le premier
    /**
     * Constructor
     */


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
     * Set score
     *
     * @param integer $score
     *
     * @return score
     */
    public function setScore($score)
    {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set user
     *
     * @param \THAG\M2MBundle\Entity\User $user
     *
     * @return score
     */
    public function setUser(\THAG\M2MBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \THAG\M2MBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set film
     *
     * @param \THAG\M2MBundle\Entity\Film $film
     *
     * @return score
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
