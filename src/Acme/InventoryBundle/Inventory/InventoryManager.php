<?php
/**
 * Created by PhpStorm.
 * User: viralpatel
 * Date: 2015-06-24
 * Time: 10:03 PM
 */

namespace Acme\InventoryBundle\Inventory;

class InventoryManager
{
    private $em;
    private $inventory;

    public function __construct($em, $inventory)
    {
        $this->em = $em;
        $this->inventory = $inventory;
    }
    public function getInventory()
    {
        $inventory = $this->em->getRepository('AcmeInventoryBundle:Inventory')
            ->findAll();

        return $inventory;
    }

    public function addInventory($data)
    {
        $this->inventory->setName($data["name"]);
        $this->inventory->setBroker($data['broker']);
        $this->inventory->setDescription($data['description']);
        $this->inventory->setLocation($data['location']);
        $this->inventory->setPrice($data['price']);


        $this->em->persist($this->inventory);
        $this->em->flush();
    }
}