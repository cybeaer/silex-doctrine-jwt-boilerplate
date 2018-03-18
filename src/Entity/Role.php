<?php
namespace mgcom\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity()
 * @Table(name="role")
 */
class Role {
    /**
     * @var string
     *
     * @id()
     * @GeneratedValue(strategy="UUID")
     * @Column(name="id", type="guid", unique=true, nullable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @name()
     * @Column(name="name", type="string", unique=true, nullable=false)
     */
    private $name;

    /**
     * @return string
     */
    public function getId(){
        return $this->id;
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