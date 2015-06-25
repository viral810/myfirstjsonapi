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

        $em = $this->getDoctrine()->getManager();
        $inventory = new Inventory();
        $inventoryManager = new InventoryManager($em, $inventory);
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
        $em = $this->getDoctrine()->getManager();
        $inventory = new Inventory();

        $createInventory = new InventoryManager($em, $inventory);
        $createInventory->addInventory($data);

        return new Response("I am an API and I created a new inventory for you");

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