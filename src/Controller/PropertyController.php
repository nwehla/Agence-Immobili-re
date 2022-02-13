<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use ProxyManager\ProxyGenerator\PropertyGenerator\PublicPropertiesMap;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PropertyController extends AbstractController
{
    /**
     * @Route("/biens", name="property_index")
     */
    public function index(EntityManagerInterface $manager,PropertyRepository $repo): Response
    {

        $property= $repo->findAllVisible();
        dd($property);
        return $this->render('property/index.html.twig',[
            'property'=>$property,
            'current_menu'=>'properties',
        ]);
    }

    /**
     * @Route("/biens/slug-id",name="property.show",Requirements={"slug": "[a-z0-9/]*"})
     */
    public function show( string $slug,Property $property): Response
    {
        if($property->getSlug() !== $slug){
return$this->redirectToRoute('property.show',[
    'id'=>$property->getId(),
    'slug' =>$property->getSlug(),
      301]);

        }
        return $this->render("property/show.html.twig",[
            'current_menu'=>'properties',
            'property'=>$property,
        ]);

    }

        
    
}
