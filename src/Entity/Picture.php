<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 *  @Vich\Uploadable()
 */
class Picture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;


    /**
     * @Vich\UploadableField(mapping="picture_file", fileNameProperty="name")
     * @var File
     */
    private $pictureFile;

    /**
     * @ORM\OneToOne(targetEntity=Wine::class, mappedBy="picture", cascade={"persist", "remove"})
     */
    private $wine;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }



    /**
     * @return File
     */
    public function getPictureFile(): File
    {
        return $this->pictureFile;
    }

    /**
     * @param File $pictureFile
     */
    public function setPictureFile(File $pictureFile): void
    {
        $this->pictureFile = $pictureFile;
    }

    public function getWine(): ?Wine
    {
        return $this->wine;
    }

    public function setWine(?Wine $wine): self
    {
        // unset the owning side of the relation if necessary
        if ($wine === null && $this->wine !== null) {
            $this->wine->setPicture(null);
        }

        // set the owning side of the relation if necessary
        if ($wine !== null && $wine->getPicture() !== $this) {
            $wine->setPicture($this);
        }

        $this->wine = $wine;

        return $this;
    }

}
