<?php 

namespace Acme\InventoryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 *@ORM\Entity
 *@ORM\Table(name="Inventory")
 */
class Inventory
{

	/**
	 *
	 *@ORM\Column(type="integer")
	 *@ORM\Id
	 *@ORM\GeneratedValue(strategy="AUTO")
	 *
	 */
	protected $id;
	 /**
     * @ORM\Column(type="string", length=100)
     */
	protected $name;
	 /**
     * @ORM\Column(type="decimal", scale=2)
     */
	protected $price;
	 /**
     * @ORM\Column(type="text")
     */
	protected $description;
	/**
     * @ORM\Column(type="text")
     */
	protected $location;
	/**
     * @ORM\Column(type="string", length=100)
     */
	protected $broker;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Inventory
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Inventory
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Inventory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return Inventory
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set broker
     *
     * @param string $broker
     * @return Inventory
     */
    public function setBroker($broker)
    {
        $this->broker = $broker;

        return $this;
    }

    /**
     * Get broker
     *
     * @return string 
     */
    public function getBroker()
    {
        return $this->broker;
    }

    
}
