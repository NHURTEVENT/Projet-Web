<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventFormRepository")
 */
class EventForm
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotNull()
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotNull()
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Assert\NotNull()
     */
    private $begin_date;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Assert\NotNull()
     */
    private $end_date;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\NotNull()
     */
    private $ponctual;

    /**
     * @ORM\Column(type="boolean")
     *
     * @Assert\NotNull()
     */
    private $free;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotNull()
     */
    private $price;

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->begin_date;
    }

    public function setBeginDate(\DateTimeInterface $begin_date): self
    {
        $this->begin_date = $begin_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

        return $this;
    }

    public function isPonctual(): ?bool
    {
        return $this->ponctual;
    }

    public function setPonctual(bool $ponctual): self
    {
        $this->ponctual = $ponctual;

        return $this;
    }

    public function isFree(): ?bool
    {
        return $this->free;
    }

    public function setFree(bool $free): self
    {
        $this->free = $free;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
