<?php

namespace Acme\InventoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\InventoryBundle\Entity\Inventory;
use FOS\RestBundle\Controller\Annotations\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acme\InventoryBundle\Inventory\InventoryManager;

class InventoryController extends Controller
{
    /**
     * @return array
     * @View()
     */
    public function inventoryAction(){

        $inventoryManager = $this->get('acme.inventory');
        $inventoryListing = $inventoryManager->getInventory();

        return array('inventory'=> $inventoryListing);
    }

    /**
     * @return array
     * @param Inventory $inventory
     * @View()
     * @ParamConverter("inventory",class="AcmeInventoryBundle:Inventory")
     * @Route("/api/inventory/{inventory}.{_format}",name="inventory_show")
     * @Method("GET")
     */
    public function inventoryDetailAction(Inventory $inventory){

         return array('inventory'=> $inventory);
    }

    /**
     * @Route("/api/inventory/form/",name="submit_query")
     *
     */
    public function formAction(Request $request)
    {
        $data = $request->request->all();

        $createInventory = $this->get("acme.inventory");
        $createInventory->addInventory($data);

        return new Response("I am an API and I created a new inventory for you");

    }

    /**
     * @Route("/api/{inventory}/delete/",name="delete_query")
     * @param Inventory $inventory
     * @View()
     * @return array
     * @Method("DELETE")
     */
    public function deleteAction(Inventory $inventory)
    {
        $deleteInventory = $this->get("acme.inventory");
        $deleteInventory->deleteInventory($inventory);

        return new Response("I am an API and I deleted one inventory for you");

    }

    /**
     * @Route("/api/inventory/form/show/")
     * @Template()
     */
    public function formShowAction(Request $request)
    {

        return $this->render('AcmeInventoryBundle:Inventory:form.html.twig');
    }
}