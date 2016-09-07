<?php
/**
 * Created by PhpStorm.
 * User: danbevan
 * Date: 06/09/2016
 * Time: 14:52
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $biography;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank(message="Please, upload your profile image as a JPEG.")
     * @Assert\File(mimeTypes={ "image/jpeg" })
     */
    private $profileimage;

    /**
     * @ORM\OneToMany(targetEntity="Hobby", mappedBy="user")
     * @ORM\OrderBy({"age" = "DESC"})
     */
    private $hobbies;

    public function __construct()
    {
        $this->hobbies = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getBiography()
    {
        return $this->biography;
    }

    /**
     * @param mixed $biography
     */
    public function setBiography($biography)
    {
        $this->biography = $biography;
    }

    /**
     * @return mixed
     */
    public function getProfileimage()
    {
        return $this->profileimage;
    }

    /**
     * @param mixed $profileimage
     */
    public function setProfileimage($profileimage)
    {
        $this->profileimage = $profileimage;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * @return ArrayCollection|Hobby[]
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }


}