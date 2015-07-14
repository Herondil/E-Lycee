<?php

namespace dashboard\dashboardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fiches
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="dashboard\dashboardBundle\Entity\FichesRepository")
 */
class Fiches
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;


    /**
     * @ORM\ManyToOne(targetEntity="ElyceeBundle\Entity\User", inversedBy="fiches")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     *
     */
    private $teacher;

    /**
     * @ORM\ManyToOne(targetEntity="Classes", inversedBy="fiches")
     * @ORM\JoinColumn(name="lvl_id", referencedColumnName="id")
     *
     */
    private $niveau;


    /**
     * @ORM\ManyToOne(targetEntity="ElyceeBundle\Entity\Status", inversedBy="fiches")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     *
     */
    private $status;





    /**
     * @ORM\OneToMany(targetEntity="DashboardBundle\Entity\Choix", mappedBy="fiche", cascade={"persist"})
     */
    protected $choices;








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
     * Set title
     *
     * @param string $title
     * @return Fiches
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Fiches
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
}
