<?php
namespace mgcom\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="role")
 */
class Role {
    /**
     * @var string
     *
     * @ORM\uuid()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="uuid", type="guid", unique=true, nullable=false)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\name()
     * @ORM\Column(name="name", type="string", unique=true, nullable=false)
     */
    private $name;

    /**
     * @return string
     */
    public function getUuid(){
        return $this->uuid;
    }

    /**
     * @param $val
     * @return Role
     */
    public function setName($val){
        $this->name = $val;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(){
        return $this->name;
    }
}