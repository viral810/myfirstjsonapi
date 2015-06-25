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

    public function __construct($em)
    {
        $this->em = $em;
    }
    public function getInventory()
    {

        $inventory = $this->em->getRepository('AcmeInventoryBundle:Inventory')
            ->findAll();

        return $inventory;
    }
}