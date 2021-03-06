<?php

namespace App\Controller;

use App\Entity\Pessoa;
use App\Service\Serializer\CustomSerializer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pessoa")
 */
class PessoaController extends AbstractController
{

    /**
     * @Route("", methods={"POST","HEAD"})
     */
    public function create(Request $request, CustomSerializer $serializer)
    {
        $pessoa = $serializer->deserialize($request->getContent(), Pessoa::class);
        dump($pessoa);
        return new Response($serializer->serialize($pessoa), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }

    /**
     * @Route("/{id}", methods={"PUT"})
     */
    public function edit(int $id)
    {
        return new Response(json_encode(['id' => $id, 'METHOD' => 'PUT']), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }

    /**
     * @Route("/{id}", methods={"DELETE"})
     */
    public function delete($id)
    {
        return new Response(json_encode(['id' => $id, 'METHOD' => 'DELETE']), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }

    /**
     * @Route("/{id}", methods={"GET","HEAD"})
     */
    public function findById(int $id)
    {
        // ... return a JSON response with the post
        // throw new Exception("Exceção de teste");
        return new Response(json_encode(['id' => $id]), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }

    /**
     * @Route("", methods={"GET","HEAD"})
     */
    public function findAll(Request $request)
    {
        dump($request->query->get('filter'));
        // ... return a JSON response with the post
        // throw new Exception("Exceção de teste");
        return new Response(json_encode(['METHOD' => 'findAll']), Response::HTTP_OK, ["Content-Type" => "application/json"]);
    }
}
