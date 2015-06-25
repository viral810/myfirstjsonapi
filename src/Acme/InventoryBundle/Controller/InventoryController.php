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
        $inventoryManager = new InventoryManager($em);
        $inventory = $inventoryManager->getInventory();

        return array('inventory'=>$inventory);
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

         return array('inventory'=>$inventory);
    }

    /**
     * @Route("/api/inventory/new/")
     * @Method("POST")
     */
    public function newInventoryAction(Request $request){

        $inventory = new Inventory();
        $inventory->setName("Liberty Village Apartments");
        $inventory->setBroker("Emod");
        $inventory->setDescription("Located in downtown Toronto");
        $inventory->setLocation("Toronto");
        $inventory->setPrice("20,000.99");

        $em = $this->getDoctrine()->getManager();
        $em->persist($inventory);
        $em->flush();
        return new Response("I am an API and I created a new inventory for you");
    }

    /**
     * @Route("/api/inventory/form/",name="submit_query")
     *
     */
    public function formAction(Request $request)
    {
        $serializer = $this->get('jms_serializer');
        $data = $request->request->all();
//        $jsonContent = $serializer->serialize($data, 'json');
        //$content = json_decode($jsonContent, true);
// $jsonContent contains {"name":"foo","age":99,"sportsman":false}

        //echo $data['name']; // or return it in a Response
        $inventory = new Inventory();
        $inventory->setName($data["name"]);
        $inventory->setBroker($data['broker']);
        $inventory->setDescription($data['description']);
        $inventory->setLocation($data['location']);
        $inventory->setPrice($data['price']);

        $em = $this->getDoctrine()->getManager();
        $em->persist($inventory);
        $em->flush();
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