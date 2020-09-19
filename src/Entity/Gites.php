<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GitesRepository")
 * @Vich\Uploadable()
 */
class Gites
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @ORM\Column(type="integer")
     */
    private $chambres;

    /**
     * @ORM\Column(type="integer")
     */
    private $douches;

    /**
     * @ORM\Column(type="text")
     */
    private $surface;

    /**
     * @ORM\Column(type="text")
     */
    private $lits;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dressing;

        /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=6, nullable=true)
     */
    private $tarifs;

    /**
     * @Assert\All({
     *   @Assert\Image(
     *     mimeTypes={"image/jpeg", "image/png", "image/gif"},
     *     mimeTypesMessage = "Please upload a valid Image" 
     * )
     * })
     */
    private $imageFiles;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="gites_images", fileNameProperty="imageNameMiniature")
     *
     * @var File
     */
    private $imageFileMiniature;
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageNameMiniature;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="gite", orphanRemoval=true, cascade={"persist", "remove"}, fetch="EAGER")
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="gites", orphanRemoval=true)
     */
    private $bookings;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getChambres(): ?int
    {
        return $this->chambres;
    }

    public function setChambres(int $chambres): self
    {
        $this->chambres = $chambres;

        return $this;
    }

    public function getDouches(): ?int
    {
        return $this->douches;
    }

    public function setDouches(int $douches): self
    {
        $this->douches = $douches;

        return $this;
    }

    public function getSurface(): ?string
    {
        return $this->surface;
    }

    public function setSurface(string $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getLits(): ?string
    {
        return $this->lits;
    }

    public function setLits(string $lits): self
    {
        $this->lits = $lits;

        return $this;
    }

    public function getDressing(): ?string
    {
        return $this->dressing;
    }

    public function setDressing(string $dressing): self
    {
        $this->dressing = $dressing;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }


    public function __toString()
    {
      return $this->getDisponible();
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setGites($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getGites() === $this) {
                $booking->setGites(null);
            }
        }

        return $this;
    }

    public function getTarifs(): ?string
    {
        return $this->tarifs;
    }

    public function setTarifs(?string $tarifs): self
    {
        $this->tarifs = $tarifs;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }
    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setGite($this);
        }
        return $this;
    }
    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getGite() === $this) {
                $image->setGite(null);
            }
        }
        return $this;
    }
    /**
     * @return mixed
     */
    public function getImageFiles()
    {
        return $this->imageFiles;
    }
    public function setImageFiles($imageFiles): self
    {
        foreach($imageFiles as $imageFile) {
            $image = new Image();
            $image->setImageFile($imageFile);
            $this->addImage($image);
        }
        $this->imageFiles = $imageFiles;
        return $this;
    }
    /**
     * @param File|null $imageFileMiniature
     * @throws \Exception
     */
    public function setImageFileMiniature(?File $imageFileMiniature = null): void
    {
        $this->imageFileMiniature = $imageFileMiniature;
        if (null !== $imageFileMiniature) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    public function getImageFileMiniature(): ?File
    {
        return $this->imageFileMiniature;
    }
    public function setImageNameMiniature(?string $imageNameMiniature): void
    {
        $this->imageNameMiniature = $imageNameMiniature;
    }
    public function getImageNameMiniature(): ?string
    {
        return $this->imageNameMiniature;
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

}
