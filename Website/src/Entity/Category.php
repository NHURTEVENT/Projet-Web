<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
    private $category;


    /**
     * @param string $type
     * @return Category
     */
    public function setCategory($category)
    {
        /*
        if (!in_array($category, CategoryEnum::getAvailableCategory())) {
            throw new \InvalidArgumentException("Invalid type");
        }
        */
        $this->category = $category;

    }

    public function getCategory(){
        return $this->category;
    }

    public function getId()
    {
        return $this->id;
    }
}
