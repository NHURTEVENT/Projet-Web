<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikedPhotoRepository")
 */
class LikedPhoto
{

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Photo")
     */
    private $photo_id;

    public function getId()
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getPhotoId(): ?int
    {
        return $this->photo_id;
    }

    public function setPhotoId(int $photo_id): self
    {
        $this->photo_id = $photo_id;

        return $this;
    }
}
