<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LikedEventRepository")
 */
class LikedEvent
{
    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user_id;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Event")
     */
    private $event_id;

    public function getId()
    {
        return $this->id;
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
}
