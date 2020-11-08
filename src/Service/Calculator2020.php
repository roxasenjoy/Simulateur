<?php

namespace App\Service;

use App\Entity\Clients;
use App\Entity\Credits;
use App\Entity\Investissements;

class Calculator2020
{

    /**
     * @var Clients
     */
    public $clients;

    public function __construct(Clients $client)
    {
        $this->clients = $client;
    }


    /****************************************************************************/
    /*                            Solutions investissements                     */
    /****************************************************************************/
    public function getSolutionsInvestissements(){

        if($this->getBudgetIdealInvestissementLMP() < 100.000){
            return 2;
        }

        return 3;

    }

    /****************************************************************************/
    /*              Fonctions disponibles pour faciliter les calculs            */
    /****************************************************************************/

    /**
     * Cette fonction addition tous les champs investissements souhaités.
     * Champs disponibles :
     *      - getInvestMontant
     *      - getInvestDuree
     *      - getInvestRente
     *      - getInvestAchat
     *
     * @var object // String
     * @var getter // String
     * @var return // String
     *
     * @return int|mixed
     */
    public function getInvestissements($object,$getter, $return){ // GOOD
        $object =
            $this
                ->clients
                ->getPatrimoines()
                ->getInvestissements()
                ->map(function(Investissements $investissements) use ($getter) {
                    foreach([$investissements->$getter()] as $value){
                        return $value;
                    }
                });

        $return = 0;
        foreach($object as $value){
            $return += $value*12;
        }

        return $return;
    }

    /****************************************************************************/

    /**
     * Cette fonction addition tous les champs crédits souhaités.
     * Champs disponibles :
     *      - getCreditMontant
     *      - getCreditDuree
     *
     * @var object // String
     * @var getter // String
     * @var return // String
     *
     * @return int|mixed
     */
    public function getCredits($object,$getter, $return){ // GOOD
        $object =
            $this
                ->clients
                ->getPatrimoines()
                ->getCredits()
                ->map(function(Credits $credits) use ($getter) {
                    foreach([$credits->$getter()] as $value){
                        return $value;
                    }
                });

        $return = 0;
        foreach($object as $value){
            $return += $value*12;
        }

        return $return;
    }
    /****************************************************************************/
    /****************************************************************************/
    /****************************************************************************/

    /**
     * @return int
     */
    public function getRevenuAnnuel() :int // GOOD
    {
        $revenuAnnuel = $this->clients->getPatrimoines()->getRevenuFoyer();
        return $revenuAnnuel;
    }

    /**
     * @return int
     */
    public function getTMI():int // GOOD
    {
        /* Limite des quotient familial */
        $tranche_1 = 10064;
        $tranche_2 = 27794;
        $tranche_3 = 74517;
        $tranche_4 = 157806;

        /* Pourncetage des TMI*/
        $TMI_1 = 0;
        $TMI_2 = 11;
        $TMI_3 = 30;
        $TMI_4 = 41;
        $TMI_5 = 45;

        $partsFiscal = $this->clients->getSituations()->getEnfantFiscal();
        $revenuAnnuel = $this->clients->getPatrimoines()->getRevenuFoyer();

        /* Si le revenu annuel est égal à 0, on retourne 0*/
        if($revenuAnnuel != 0){
            /* Si les parts fiscals sont égales à 0, on évite l'erreur en ne mettant que le revenu annuel */
            if($partsFiscal > 0){
                $QF = $revenuAnnuel / $partsFiscal;
            }else{
                $QF = $revenuAnnuel;
            }
            /* Calcul du TMI avec les tranches */
            if($QF <= $tranche_1){ $tmi = $TMI_1; }
            if($QF > $tranche_1 && $QF <= $tranche_2){ $tmi = $TMI_2; }
            if($QF > $tranche_2 && $QF <= $tranche_3){ $tmi = $TMI_3; }
            if($QF > $tranche_3 && $QF <= $tranche_4){ $tmi = $TMI_4; }
            if($QF > $tranche_4){ $tmi = $TMI_5; }
            return $tmi;
        }
        return 0;
    }

    public function getChargesAnnuels():int // GOOD
    {
        $pensionAlimentaire = $this->clients->getSituations()->getPension() * 12;
        $proprietaire_creditAnnuel = $this->clients->getPatrimoines()->getProprioCredit() * 12;
        $locataire_loyerAnnuel = $this->clients->getPatrimoines()->getLocaLoyer() * 12 ;

        $chargesAnnuels =
            $pensionAlimentaire /* Pension alimentaire annuelle */
            + $proprietaire_creditAnnuel /* Propriétaire : Crédit du bien annuel */
            + $locataire_loyerAnnuel /* Locataire : Coût du loyer annuel */
            + $this->getInvestissements( /* Tous les crédits des investissements */
                "creditInvest",
                "getInvestMontant",
                "creditInvestValue")
            - $this->getInvestissements( /* Tous les loyers perçus des investissements */
                "loyerPercu",
                "getInvestRente",
                "loyerPercuValue")
            + $this->getCredits( /* Montant de tous les crédits */
                "credit",
                "getCreditMontant",
                "creditValue")
        ;

        /* On ne peut pas avoir des charges négatives */
        if($chargesAnnuels < 0){
            $chargesAnnuels = 0;
        }

       return $chargesAnnuels/12;
    }

    /**
     * @return false|float
     */
    public function getEstimationImpots(){ // GOOD

        /* Limite des quotient familial */
        $tranche_1 = 10064;
        $tranche_2 = 25659;
        $tranche_3 = 73369;
        $tranche_4 = 157806;

        /* Pourncetage des TMI*/
        $TMI_2 = 0.11;
        $TMI_3 = 0.30;
        $TMI_4 = 0.41;
        $TMI_5 = 0.45;

        // Exemple :
            // Revenu net imposable : 55950
            // Parts : 3
        $revenuNetImposable = $this->clients->getPatrimoines()->getRevenuFoyer();
        $partsFiscales = $this->clients->getSituations()->getEnfantFiscal();

        //Eviter de diviser par 0
        if($partsFiscales == 0){
            $partsFiscales = 1;
        }

        $revenuPerParts = $revenuNetImposable / $partsFiscales; // 18 650 = 55950 / 3
        $impots = 0;

        if($revenuPerParts <= $tranche_1){ // Inférieur à 10064
            $impots = $impots + 0;
        }

        if($revenuPerParts > $tranche_1 && $revenuPerParts <= $tranche_2){ // Entre 10 064 et 27 794
            $impots += ($revenuPerParts - $tranche_1) * $TMI_2;
        }

        if($revenuPerParts > $tranche_2 && $revenuPerParts <= $tranche_3){ // Entre 27 794 et 74 517
            $impots += ($tranche_2 - $tranche_1) * $TMI_2;
            $impots += ($revenuPerParts - $tranche_2) * $TMI_3;
        }

        if($revenuPerParts > $tranche_3 && $revenuPerParts <= $tranche_4){ // Entre 74 517 et 157 806
            $impots += ($tranche_2 - $tranche_1) * $TMI_2;
            $impots += ($tranche_3 - $tranche_2) * $TMI_3;
            $impots += ($revenuPerParts - $tranche_3) * $TMI_4;
        }

        if($revenuPerParts > $tranche_4){ // Supérieur à 157 806
            $impots += ($tranche_2 - $tranche_1) * $TMI_2;
            $impots += ($tranche_3 - $tranche_2) * $TMI_3;
            $impots += ($tranche_4 - $tranche_3) * $TMI_4;
            $impots += ($revenuPerParts - $tranche_4) * $TMI_5;
        }

        $impots = $impots * $partsFiscales; // On multiplie le résultat par le nombre de parts fiscales

        return round($impots); // On arrondie le résultat

    }

    public function scorePinel(){
        $budget = $this->budgetPinel();
        $maximumPinel = 300000;

        return round($budget * 100 / $maximumPinel); // Pourcentage de score


    }

    public function budgetPinel(){

        $impot = $this->getEstimationImpots();

        if($impot > 6000){
            return 300000;
        }

        $impot = $impot / 0.02;
        return $impot;


    }



    /*********************************************************************
     *********************************************************************
     ************************** LES CHIFFRES CLÉS PINEL ************************
     *********************************************************************
     *********************************************************************/

    public function getReductionImpot($pourcentageReduction){ // A vérifier

        /* Economie d'impôts = Réduction d'impôts

          Calcul : Montant de l'investissements + frais de mutation = A (Plafonnés à 300 000 euros)

        Réduction d'impôts par an :
            Réduction d'impôt sur 6 ans : 2% x 6 ans = 12%
            Réduction d’impôt sur 9 ans: 2% x 9 ans = 18%
            Réduction d’impôt sur 12 ans: (2% x 9 ans) + (1% x 3 ans) = 21 %
        */
        //https://defiscalisation.ooreka.fr/astuce/voir/746931/exemple-de-reduction-d-impot-avec-la-loi-pinel


        $montantInvestissement = $this->getInvestissements('investAchat', 'getInvestAchat', 'investAchatValue') /12;
        $fraisMutation = $montantInvestissement * 0.025; // Les frais de mutation sont à 2.5% de la valeur du bien.

        //(Plafonnés à 300 000 euros)
        if($montantInvestissement > 300000){
            $montantInvestissement = 300000;
        }

        $reductionImpot = ($montantInvestissement + $fraisMutation) * $pourcentageReduction;

        return $reductionImpot;
    }

    public function getReductionImpotSixAns(){
        return $this->getReductionImpot(0.12);
    }

    public function getReductionImpotNeufAns(){
        return $this->getReductionImpot(0.18);
    }

    public function getReductionImpotDouzeAns(){
        return $this->getReductionImpot(0.21);
    }

    public function getEconomieImpotMoyenne(){
        return
            ($this->getReductionImpotSixAns() +
            $this->getReductionImpotNeufAns() +
            $this->getReductionImpotDouzeAns())  / 3;

    }


    /**
     * @return int|null
     */
    public function getApport() // GOOD
    {
        $apport =  $this->clients->getEpargnes()->getApport();

        if ($apport === null){
            $apport = 0;
        }

        return $apport;
    }

    public function getDureePlacement($pourcentageReduction){ // GOOD
        /*
         * http://impotsurlerevenu.org/loi-pinel/967-loi-pinel-montant-de-la-reduction-d-impot.php
         */



        $investissements = $this->budgetPinel();
        $tauxReduction = $pourcentageReduction;

        if($investissements > 300000){
            $investissements = 300000;
        }

        $reductionAnnuel = $investissements * $tauxReduction;

        return $reductionAnnuel;
    }

    public function getDureePlacementSixAns(){ // GOOD
        return $this->getDureePlacement(0.12);
    }

    public function getDureePlacementNeufAns(){ // GOOD
        return $this->getDureePlacement(0.18);
    }

    public function getDureePlacementDouzeAns(){ // GOOD
        return $this->getDureePlacement(0.21);
    }

    public function getRendementNetPINEL(){ // A VERIFIER
        /**
         * https://immobilier.lefigaro.fr/annonces/edito/acheter/je-me-prepare/comment-calculer-le-rendement-de-son-investissement-locatif
         */

        $achat = $this->getInvestissements("achat", "getInvestAchat", "achatValue") / 12 ; // Valeur du bien (Ne t'occupe pas de la division)
        $loyer = $this->getInvestissements("loyer", "getInvestMontant", "loyerValue"); // Loyer du bien
        $charges = $loyer*0.10;

        if ($achat === 0){
            $achat = 1;
        }

        $rendementNet = (($loyer - $charges ) / $achat) * 100;

        return round($rendementNet, 2); // Arrondi la valeur
    }



   /* public function calculPourcentage($reductionImpot, $tempsReductionImpot){
        $montantInvestissement = $this->getInvestissements("achat", "getInvestAchat", "achatValue") / 12;
        $defiscaliser = ($montantInvestissement * $reductionImpot) / $tempsReductionImpot;

        return $defiscaliser;
    }*/

    /*********************************************************************
     *********************************************************************
     *********************** VOS FLUX DE TRÉSORIE ************************
     *********************************************************************
     *********************************************************************/

    /**
     * Ne prend en compte que les crédits immobiliers
     * @return int|mixed|null
     */
    public function getCreditImmobilier():int // GOOD
    {
        // Addition des crédits que le propriétaire a dans son patrimoine afin de le rajouter au calcul final
        // Mensuel

        $creditImmobilierTotal =
            $this->clients->getPatrimoines()->getProprioCredit()
        +   $this->getInvestissements("creditImmobilierInvest", "getInvestMontant", "creditImmobilierInvestValue") / 12;
        return $creditImmobilierTotal;
    }

    /**
     * @return int|mixed
     */
    public function getLoyerPercu():int // GOOD
    {
        // Défini tous les loyers que le propiétaires perçoient
        // Mensuel

        return $this
            ->getInvestissements(
                "renteInvest",
                "getInvestRente",
                "renteValue"
            ) /12 ;
    }

    public function getReductionImpotMoyenne(){ // GOOD
        $sixAns = $this->getDureePlacementSixAns();
        $neufAns = $this->getDureePlacementNeufAns();
        $douzeAns = $this->getDureePlacementDouzeAns();

        $reductionImpotMoyenne =( $sixAns + $neufAns + $douzeAns) / 3;

        return round($reductionImpotMoyenne /12);
    }

    public function getEffortEpargneMensuel(){ // GOOD

        /**
         *  https://www.myexpat.fr/faq-items/effort-depargne/#:~:text=L'effort%20d'%C3%A9pargne%20est,mensualit%C3%A9s%20qu'il%20doit%20rembourser
         *  DÉFINITION EFFORT D’ÉPARGNE
         *      L’effort d’épargne est une dépense supplémentaire assumée par le propriétaire
         *      lorsque le montant des loyers n’atteint pas celui des mensualités
         *      qu’il doit rembourser. Autrement dit, l’effort d’épargne est défini en fonction de
         *      la différence entre les flux de trésorerie entrant et sortant lors d’un investissement immobilier locatif.
         */


        /* Flux entrants */
        $loyer = $this->getLoyerPercu();
        $reductionImpotMoyenne = $this->getReductionImpotMoyenne();
        /* Flux Sortants */
        $fraisDeGestion = ($this->getInvestissements("achatPrice", "getInvestAchat", "achatValue")/12) * 0.0295;
        $charges = $this->getChargesAnnuels()*12;
        $credit = $this->getCreditImmobilier();


        $fluxEntrants = $loyer + $reductionImpotMoyenne;
        $fluxSortants = $fraisDeGestion + $charges + $credit ;

        $effortEpargneMensuel = $fluxSortants - $fluxEntrants;

        if($effortEpargneMensuel <= 0){
            $effortEpargneMensuel = 0;
        }

        return round($effortEpargneMensuel/12);
    }


    /*****************************************************************************************/


    /* LMP */
    public function getEpargneMensuelleLMP(){

        $annualiteCredit = 6372 / 110000 * $this->getCapaciteEndetementLMP(); //bon
        $loyerPercu = $this->getLoyerPercuLMP(); // pas bon

        $epargneMensuelle = $annualiteCredit - $loyerPercu; // bon

        return ceil($epargneMensuelle /12) ; //bon
    }

    public function getRentabiliteNetLMP(){
        return 3; // bon
    }

    public function getCapaciteEndetementLMP(){

        $revenu = $this->getRevenuAnnuel(); // 50 000 bon
        $capaciteEndetement = $revenu - $this->getChargesAnnuels(); //49800 bon

        if($capaciteEndetement < 90000){
            // Si il est inférieur, il ne faut pas afficher LMP
            $capaciteEndetement = 0;
        }
        return ceil($capaciteEndetement); // bon
    }

    public function getLoyerPercuLMP(){

        $loyerPercu = $this->getBudgetIdealInvestissementLMP() *  $this->getRentabiliteNetLMP()/100;

        return ceil($loyerPercu);
    }

    public function getBudgetIdealInvestissementLMP(){

        $budgetIdealInvestissement = $this->getCapaciteEndetementLMP();

        if($this->getCapaciteEndetementLMP() < 90000){
            // Si il est inférieur, il ne faut pas afficher LMP
            $budgetIdealInvestissement = 0;
        }

        return ceil($budgetIdealInvestissement);
    }







}

