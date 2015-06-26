<?php
/**
 * Created by PhpStorm.
 * User: viralpatel
 * Date: 2015-06-24
 * Time: 10:03 PM
 */

namespace Acme\InventoryBundle\Inventory;

use Acme\InventoryBundle\Entity\Inventory;
use Doctrine\ORM\EntityManager;

class InventoryManager
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @return mixed
     */
    public function getInventory()
    {

        $inventory = $this->em->getRepository('AcmeInventoryBundle:Inventory')
            ->findAll();

        return $inventory;
    }

    /**
     * @param $data
     * @param $inventory
     */
    public function addInventory($data)
    {
        $inventory = new Inventory();
        $inventory->setName($data["name"]);
        $inventory->setBroker($data['broker']);
        $inventory->setDescription($data['description']);
        $inventory->setLocation($data['location']);
        $inventory->setPrice($data['price']);


        $this->em->persist($inventory);
        $this->em->flush();
    }

    /**
     * @param $inventory
     */
    public function deleteInventory($inventory)
    {
        $this->em->remove($inventory);
        $this->em->flush();
    }
}