<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @Vich\Uploadable()
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var File|null
     * @Assert\Image(
     *     mimeTypes={"image/jpeg", "image/png"},
     *     mimeTypesMessage = "Please upload a valid Image",
     *     maxSize="8024k"
     * )
     * @Vich\UploadableField(mapping="gites_images", fileNameProperty="name")
     */
    private $imageFile;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Gites", inversedBy="images")
     */
    private $gite;

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
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    /**
     * @param null|File $imageFile
     * @return self
     */
    public function setImageFile(?File $imageFile): self
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    public function getGite(): ?Gites
    {
        return $this->gite;
    }

    public function setGite(?Gites $gite): self
    {
        $this->gite = $gite;

        return $this;
    }

}