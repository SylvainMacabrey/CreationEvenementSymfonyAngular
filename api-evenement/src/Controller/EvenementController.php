<?php
namespace App\Controller;

use App\Entity\Evenement;
use App\Entity\User;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EvenementController extends Controller {

    public function __construct(EvenementRepository $evenementRepository) {
        $this->evenementRepository = $evenementRepository;
    }

    /**
    * @Route("/evenements", methods="GET", name="evenement.index")
    */
    public function index() {
        $evenements = $this->evenementRepository->findAll();
        var_dump($evenements); die;
        $data = $this->get('jms_serializer')->serialize($evenements, 'json');
        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
    * @Route("/evenements", methods="POST", name="evenement.create")
    */
    public function create(Request $request, EntityManagerInterface $em) {
        $data = $request->getContent();
        $evenement = $this->get('jms_serializer')->deserialize($data, 'App\Entity\Evenement', 'json');
        $em->persist($evenement);
        $em->flush();
        return new Response('', Response::HTTP_CREATED);
    }

}
