<?php

namespace App\Controller;

use App\Entity\Product;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/api/posts/{id}", methods={"POST","HEAD"})
     */
    public function create(Request $request, int $id)
    {
        // $entityManager = $this->getDoctrine()->getManager();

        // $product = new Product();
        // $product->setName('Keyboard');
        // $product->setPrice(1999);

        // // tell Doctrine you want to (eventually) save the Product (no queries yet)
        // $entityManager->persist($product);

        // // actually executes the queries (i.e. the INSERT query)
        // $entityManager->flush();

        $data = json_decode($request->getContent());
        // ... return a JSON response with the post
        return new Response(json_encode(["teste" => "Teste"]), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }

    /**
     * @Route("/api/posts/{id}", methods={"GET","HEAD"})
     */
    public function show(int $id)
    {
        // ... return a JSON response with the post
        throw new Exception("Exceção de teste");
        return new Response(json_encode(['id' => $id]), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }

    /**
     * @Route("/api/posts/{id}", methods={"PUT"})
     */
    public function edit(int $id)
    {
        // ... edit a post
    }

    /**
     * @Route("/api/posts", methods={"DELETE"})
     */
    public function delete()
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $entityManager = $this->getDoctrine()->getManager();

        $product1 = $repository->find(3);
        $entityManager->remove($product1);
        $entityManager->flush();

        $product2 = $repository->find(4);
        $entityManager->remove($product2);
        $entityManager->flush();

        return new Response(json_encode("Ok"), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }
}
