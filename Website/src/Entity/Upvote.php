<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UpvoteRepository")
 */
class Upvote
{
    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user_id;

    /**
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Idea")
     */
    private $idea_id;

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * @return mixed
     */
    public function getIdeaId()
    {
        return $this->idea_id;
    }

    /**
     * @param mixed $idea_id
     */
    public function setIdeaId($idea_id)
    {
        $this->idea_id = $idea_id;
    }


}
