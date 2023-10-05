<?php
// src/Controller/ChambreController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ChambreRepository;
use App\Entity\Chambre;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ChambreController extends AbstractController
{
    /**
     * @Route("/chambres", name="chambre_list", methods={"GET"})
     */
    public function list(ChambreRepository $chambreRepository): Response
    {
        $chambres = $chambreRepository->findAll();
        $data = [];

        foreach ($chambres as $chambre) {
            $proprietaire = $chambre->getProprietaire();
            $data[] = [
                'id' => $chambre->getId(),
                'titre_chambre' => $chambre->getTitreChambre(),
                'description_chambre' => $chambre->getDescriptionChambre(),
                'prix_mensuel' => $chambre->getPrixMensuel(),
                'disponibilite' => $chambre->getDisponibilite(),
                'adresse_chambre' => $chambre->getAdresseChambre(),
                'photo' => $chambre->getPhoto(),
                'proprietaire' => [
                    'nom' => $proprietaire->getNom(),
                    'prenom' => $proprietaire->getPrenom(),
                    'email' => $proprietaire->getEmail()
                ]
            ];
        }

        return $this->json($data);
    }
    /**
     * @Route("/chambres/add", name="chambre_add", methods={"POST"})
     */
    /**
     * @Route("/chambres/add", name="chambre_add", methods={"POST"})
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $data = json_decode($request->getContent(), true);

        $chambre = new Chambre();
        $chambre->setTitreChambre($data['titre_chambre']);
        $chambre->setDescriptionChambre($data['description_chambre']);
        $chambre->setPrixMensuel($data['prix_mensuel']);
        $chambre->setDisponibilite($data['disponibilite']);
        $chambre->setAdresseChambre($data['adresse_chambre']);
        $chambre->setPhoto($data['photo']);

        $proprietaireId = $data['proprietaire_id'];
        $proprietaire = $entityManager->getRepository(User::class)->find($proprietaireId);
        if ($proprietaire) {
            $chambre->setProprietaire($proprietaire);
        }

        $entityManager->persist($chambre);
        $entityManager->flush();

        return $this->json([
            'message' => 'Chambre ajoutée avec succès',
            'chambre_id' => $chambre->getId(),
        ]);
    }
}
