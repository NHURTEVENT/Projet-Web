<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="boolean")
     */
    private $reported;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user_id;

    /**
     * @ORM\ManyToOne(targetEntity="Event")
     */
    private $event_id;

    public function getId()
    {
        return $this->id;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getReported(): ?bool
    {
        return $this->reported;
    }

    public function setReported(bool $reported): self
    {
        $this->reported = $reported;

        return $this;
    }

    public function getUserId(): User
    {
        return $this->user_id;
    }

    public function setUserId(User $user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getEventId(): Event
    {
        return $this->event_id;
    }

    public function setEventId(Event $event_id)
    {
        $this->event_id = $event_id;

        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }
}
