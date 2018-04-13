<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 12/04/2018
 * Time: 08:49
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\CategoryEnum;

/**
 * @ORM\Entity
 * @ORM\Table(name="categories")
 */
class Category

{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="id", type="string")
     */
    private $id;

    /**
     * @param string $type
     * @return Category
     */
    public function setCategory($category)
    {
        if (!in_array($category, CategoryEnum::getAvailableCategory())) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->category = $category;

        return $this;
    }
}
