<?php
// src/Controller/ChambreController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ChambreRepository;

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
}
