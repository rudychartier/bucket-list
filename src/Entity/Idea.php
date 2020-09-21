<?php

namespace App\Entity;

use App\Repository\IdeaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=IdeaRepository::class)
 */
class Idea
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @Assert\NotBlank(message="Veuillez préciser le nom de votre idée !")
     * @Assert\Length(max="250",maxMessage="Le nom de votre idée est trop long !")
     * @ORM\Column (type="string", length=250)
     */
    private $title;
    /**
     * @Assert\Length(min="20",minMessage="Veuillez décrire un petit peu plus votre idée svp !")
     * @ORM\Column (type="text")
     */
    private $description;
    /**
     * @Assert\NotBlank(message="Veuillez préciser votre nom !")
     * @Assert\Length(max="40",maxMessage="Votre nom est trop long !")
     * @ORM\Column (type="text")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category",inversedBy="ideas")
     */
    private $category;
    public function __construct()
    {
        $this->category=new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * @param mixed $isPublished
     */
    public function setIsPublished($isPublished): void
    {
        $this->isPublished = $isPublished;
    }

    /**
     * @return mixed
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated): void
    {
        $this->dateCreated = $dateCreated;
    }
    /**
     * @ORM\Column (type="boolean")
     */
    private $isPublished;
    /**
     * @ORM\Column (type="datetime")
     */
    private $dateCreated;

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }


}
