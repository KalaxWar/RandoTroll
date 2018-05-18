<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ReCapitulatif extends CI_Controller {

    public function index()
    {
        
    }
    public function TableauDeBord()
    {
        $Lesparcours['LesParcours'] = $this->ModeleUtilisateur->GetParcours();
        foreach ($Lesparcours['LesParcours'] as $UnParcour) {
            $km = $UnParcour['KILOMETRAGE'];
            $NombreEquipeParParcours['NBEquipe'] = $this->ModeleUtilisateur->GetNombreEquipeInscrite($Utilisateur = array('ANNEE' =>date('Y'),'NOPARCOURS' => $UnParcour['NOPARCOURS']));
            $NombreEquipeParParcours['kms'] = $UnParcour['KILOMETRAGE'];
            $Donnee[$km] = $NombreEquipeParParcours;
            //-------------------------------------------------
            $date= $this->session->AnneeEnCours['DATECOURSE'];
            $an=substr($date,0,4); 
            $mois=substr($date,5,2); 
            $jour=substr($date,8,2);
            $an = $an - $this->session->AnneeEnCours['LIMITEAGE'];
            $NombreParticipantAdulteParParcours['NBparticipantAdultes'] = $this->ModeleUtilisateur->GetNombreParticipantAdulteInscrit($Utilisateur = array('ANNEE' =>date('Y'),'NOPARCOURS' => $UnParcour['NOPARCOURS'],'DATE'=> $an.'-'.$mois.'-'.$jour));
            $NombreParticipantAdulteParParcours['kms'] = $UnParcour['KILOMETRAGE'];
            array_push($Donnee[$km],$NombreParticipantAdulteParParcours['NBparticipantAdultes']);
            //-------------------------------------------------
            $NombreParticipantEnfantParParcours['NBparticipantEnfants'] = $this->ModeleUtilisateur->GetNombreParticipantEnfantInscrit($Utilisateur = array('ANNEE' =>date('Y'),'NOPARCOURS' => $UnParcour['NOPARCOURS'],'DATE'=> $an.'-'.$mois.'-'.$jour));
            $NombreParticipantEnfantParParcours['kms'] = $UnParcour['KILOMETRAGE'];
            array_push($Donnee[$km],$NombreParticipantEnfantParParcours['NBparticipantEnfants']);
            //------------------------------------------------
            $Montant = $this->ModeleUtilisateur->getTotalEncaisse($Utilisateur = array('ANNEE' =>date('Y')));
            $TotalEncaisse = $Montant['MONTANTPAYE'] - $Montant['MONTANTREMBOURSE'];
            //------------------------------------------------
            array_push($Donnee[$km],$UnParcour['NBDEPARTICIPANTSMAXI']);
            
        }
        $tout['Lesparcours'] = $Donnee;

            $NombreRepasAdultes = $this->ModeleUtilisateur->GetRepasAdultes($Utilisateur = array('ANNEE' =>date('Y'),'DATE'=> $an.'-'.$mois.'-'.$jour));
            //------------------------------------------------
            $NombreRepasEnfants = $this->ModeleUtilisateur->GetRepasEnfants($Utilisateur = array('ANNEE' =>date('Y'),'DATE'=> $an.'-'.$mois.'-'.$jour));
            $tout['NombreRepasAdultes'] = $NombreRepasAdultes;
            $tout['NombreRepasEnfants'] = $NombreRepasEnfants;
            $tout['TotalEncaisse'] = $TotalEncaisse;
        $this->load->view('Template/EnTete');
        $this->load->view('Inscription/DonneeFixe');
        $this->load->view('Recapitulatif/TableauDeBord',$tout);
        
    }
    public function AffectationVague()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Inscription/DonneeFixe');
        $Données['LesEquipes'] = $this->ModeleUtilisateur->GetEquipeValide();
        $this->load->view('Recapitulatif/AffectationVague',$Données);
        if($this->input->post('submit')) 
        {
            $noequipe = 0;
            foreach ($Données['LesEquipes'] as $UneEquipe) {
                if ($UneEquipe['NOEQUIPE'] <> $noequipe) 
                {
                    $noequipe = $UneEquipe['NOEQUIPE'];
                    $this->ModeleUtilisateur->UpdateChoisir($choisir = array('ANNEE' =>date('Y'),'NOEQUIPE' => $noequipe,'VAGUE' =>$this->input->post($noequipe)));

                }
            }
            
            redirect('Recapitulatif/AffectationVague');
            
        }
    }
}



?>