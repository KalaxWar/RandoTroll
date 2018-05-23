<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrateur_Organisation extends CI_Controller {
	public function __construct()
   {
    parent::__construct();
    }
	public function index()
	{
        $this->load->view('Template/EnTete');
        $this->load->view('Organisation/DonneeFixe');
    }

    public function Gestion_Contributeur()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Organisation/DonneeFixe');
        $LesContributeurs['LesContributeurs'] = $this->ModeleUtilisateur->GetContributeur();
        
        $this->load->view('Organisation/Recherche_Contributeur',$LesContributeurs);
        if($this->input->post('submit')) 
        {
            $UnContributeur = $this->ModeleUtilisateur->GetWhereContributeur($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
            $UnContributeur['sponso'] = $this->ModeleUtilisateur->GetWhereApporteurDesSponsors($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
            $UnContributeur['bene'] = $this->ModeleUtilisateur->GetWhereBenevole($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
            $this->load->view('Organisation/Gestion_Contributeur',$UnContributeur);
        }
        else
        {
            $this->load->view('Organisation/Gestion_Contributeur');
        }
        if($this->input->post('submitForm')) 
        {
            if ($this->input->post('txtTelPortable') == '') { $telport = null;} else {$telport = $this->input->post('txtTelPortable');}
            if ($this->input->post('txtTelFixe') == '') { $telfixe = null;} else {$telfixe = $this->input->post('txtTelFixe');}
            if ($this->input->post('txtAdresse') == '') { $adresse = null;} else {$adresse = $this->input->post('txtAdresse');}
            if ($this->input->post('txtCP') == '') { $cp = null;} else {$cp = $this->input->post('txtCP');}
            if ($this->input->post('txtVille') == '') { $ville = null;} else {$ville = $this->input->post('txtVille');}
            $UnContributeur = array
            (
                'NOM' => $this->input->post('txtNom'),
                'PRENOM' => $this->input->post('txtPrenom'),
                'EMAIL' => $this->input->post('txtMail'),
                'TELPORTABLE' => $telport,
                'TELFIXE' => $telfixe,
                'ADRESSE' => $adresse,
                'CODEPOSTAL' => $cp,
                'VILLE' => $ville
            );
            $NoContributeur = $this->ModeleUtilisateur->AddContributeur($UnContributeur);
            if ($this->input->post('Bene')) {
                 $this->ModeleUtilisateur->AddApporteurDesSponsors($arrayName = array('NOCONTRIBUTEUR' =>$NoContributeur));
            }
            if ($this->input->post('Sponso')) {
                $this->ModeleUtilisateur->AddBenevole($arrayName = array('NOCONTRIBUTEUR' =>$NoContributeur));
            }
            redirect('Administrateur_Organisation/Gestion_Contributeur');
        }
        if($this->input->post('submitModif')) 
        {
            if ($this->input->post('txtTelPortable') == '') { $telport = null;} else {$telport = $this->input->post('txtTelPortable');}
            if ($this->input->post('txtTelFixe') == '') { $telfixe = null;} else {$telfixe = $this->input->post('txtTelFixe');}
            if ($this->input->post('txtAdresse') == '') { $adresse = null;} else {$adresse = $this->input->post('txtAdresse');}
            if ($this->input->post('txtCP') == '') { $cp = null;} else {$cp = $this->input->post('txtCP');}
            if ($this->input->post('txtVille') == '') { $ville = null;} else {$ville = $this->input->post('txtVille');}
            $LeContributeur = array
            (
                'NOCONTRIBUTEUR' => $this->input->post('nocontributeur'),
                'NOM' => $this->input->post('txtNom'),
                'PRENOM' => $this->input->post('txtPrenom'),
                'EMAIL' => $this->input->post('txtMail'),
                'TELPORTABLE' => $telport,
                'TELFIXE' => $telfixe,
                'ADRESSE' => $adresse,
                'CODEPOSTAL' => $cp,
                'VILLE' => $ville
            );
            $this->ModeleUtilisateur->UpdateContributeur($LeContributeur);
            $UnContributeur['sponso'] = $this->ModeleUtilisateur->GetWhereApporteurDesSponsors($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
            $UnContributeur['bene'] = $this->ModeleUtilisateur->GetWhereBenevole($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));

            if (!(isset($UnContributeur['sponso']))) 
            {
                if ($this->input->post('Sponso')) 
                {
                    $this->ModeleUtilisateur->AddApporteurDesSponsors($arrayName = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
                }
            }
            if (!(isset($UnContributeur['bene']))) 
            {
                if ($this->input->post('Bene')) 
                {
                    $this->ModeleUtilisateur->AddBenevole($arrayName = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
                }
            }
            redirect('Administrateur_Organisation/Gestion_Contributeur');
            
        }
    }
    public function Gestion_Benevoles()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Organisation/DonneeFixe');
        $LesBénévoles['LesBénévoles'] = $this->ModeleUtilisateur->GetBenevole();
        $this->load->view('Organisation/Recherche_Benevoles',$LesBénévoles);
        $this->load->view('Organisation/Ajout_Commission');
        $Donnée['LesCommissions'] = $this->ModeleUtilisateur->GetCommission();
        $Donnée['Participer']=$this->ModeleUtilisateur->GetParticiper();
        $this->load->view('Organisation/Benevoles_Commis',$Donnée);
        if($this->input->post('submitRecherche')) 
        {
            $Commission['personne'] = $this->ModeleUtilisateur->GetWhereContributeur($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
            $Commission['LesCommissionsPasInscrit'] = $this->ModeleUtilisateur->GetWhereCommission($this->input->post('nocontributeur'));
            $Commission['LesCommissionsInscrit'] = $this->ModeleUtilisateur->GetWhereBenevoleCommis($this->input->post('nocontributeur'));
            $this->load->view('Organisation/Selection_Commission',$Commission);
        }
        if($this->input->post('submitAjout'))
        {
            $this->ModeleUtilisateur->AddBenevoleCommission($Commission = array('LIBELLE' => $this->input->post('txtCommission')));
            redirect('Administrateur_Organisation/Gestion_Benevoles');
        }
        
    }
    public function Gestion_Sponsor()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Organisation/DonneeFixe');
        $LesSponsors['LesSponsors'] = $this->ModeleUtilisateur->GetSponsor();
        $LesSponsors['LesContributeurs'] = $this->ModeleUtilisateur->GetApporteurDesSponsors();
        $this->load->view('Organisation/Recherche_Sponsor',$LesSponsors);
        if($this->input->post('submitRecherche')) 
        {
            $LesSponsors['LeSponso'] = $this->ModeleUtilisateur->GetWhereSponsor($this->input->post('nosponsor'));
            $LesSponsors['LeContributeur'] = $this->ModeleUtilisateur->GetWhereApporter($this->input->post('nosponsor'));
            $LesSponsors['Contribution'] = $this->ModeleUtilisateur->GetWhereContribuer($this->input->post('nosponsor'));
            $this->load->view('Organisation/Contribution_Sponsor',$LesSponsors);
            $this->load->view('Organisation/Ajout_Sponsor',$LesSponsors);
            
        }
        else
        {
            $this->load->view('Organisation/Ajout_Sponsor',$LesSponsors);
        }

        if($this->input->post('SubmitContribution'))
        {
            $Montant = $this->ModeleUtilisateur->GetWhereContribuer($this->input->post('nosponsor'));
            var_dump($Montant);
            if (!(empty($Montant))) {
                $this->ModeleUtilisateur->UpdateContribuer($arrayName = array('NOSPONSOR' =>$this->input->post('nosponsor'),'ANNEE' => date('Y'),'MONTANT'=>$this->input->post('txtMontant')));
            }
            else {
                $this->ModeleUtilisateur->AddContribuer($arrayName = array('NOSPONSOR' =>$this->input->post('nosponsor'),'ANNEE' => date('Y'),'MONTANT'=>$this->input->post('txtMontant')));
            }
        }
        if($this->input->post('submitForm'))
        {
            if ($this->input->post('txtMail') == '') { $mail = null;} else {$mail = $this->input->post('txtMail');}
            if ($this->input->post('txtTelPortable') == '') { $telport = null;} else {$telport = $this->input->post('txtTelPortable');}
            if ($this->input->post('txtTelFixe') == '') { $telfixe = null;} else {$telfixe = $this->input->post('txtTelFixe');}
            if ($this->input->post('txtAdresse') == '') { $adresse = null;} else {$adresse = $this->input->post('txtAdresse');}
            if ($this->input->post('txtCP') == '') { $cp = null;} else {$cp = $this->input->post('txtCP');}
            if ($this->input->post('txtVille') == '') { $ville = null;} else {$ville = $this->input->post('txtVille');}
            $Sponsor = array
            (
                'NOM' => $this->input->post('txtNom'),
                'MAILCONTACT' => $mail,
                'TELPORTABLECONTACT' => $telport,
                'TELFIXE' => $telfixe,
                'ADRESSE' => $adresse,
                'CODEPOSTAL' => $cp,
                'VILLE' => $ville
            );
            $idSponsor = $this->ModeleUtilisateur->AddSponsor($Sponsor);
            if ($this->input->post('nocontributeur')) {
                $this->ModeleUtilisateur->AddApporter($arrayName = array('NOCONTRIBUTEUR' => $this->input->post('nocontributeur'),'NOSPONSOR'=>$idSponsor));
            }
            redirect('Administrateur_Organisation/Gestion_Sponsor');
        }
        if($this->input->post('submitModif'))
        {
            if ($this->input->post('txtMail') == '') { $mail = null;} else {$mail = $this->input->post('txtMail');}
            if ($this->input->post('txtTelPortable') == '') { $telport = null;} else {$telport = $this->input->post('txtTelPortable');}
            if ($this->input->post('txtTelFixe') == '') { $telfixe = null;} else {$telfixe = $this->input->post('txtTelFixe');}
            if ($this->input->post('txtAdresse') == '') { $adresse = null;} else {$adresse = $this->input->post('txtAdresse');}
            if ($this->input->post('txtCP') == '') { $cp = null;} else {$cp = $this->input->post('txtCP');}
            if ($this->input->post('txtVille') == '') { $ville = null;} else {$ville = $this->input->post('txtVille');}
            $Sponsor = array
            (
                'NOSPONSOR' => $this->input->post('nosponsor'),
                'NOM' => $this->input->post('txtNom'),
                'MAILCONTACT' => $mail,
                'TELPORTABLECONTACT' => $telport,
                'TELFIXE' => $telfixe,
                'ADRESSE' => $adresse,
                'CODEPOSTAL' => $cp,
                'VILLE' => $ville
            );
            $this->ModeleUtilisateur->UpdateSponsor($Sponsor);
            $Apporter = $this->ModeleUtilisateur->GetWhereApporter($this->input->post('nosponsor'));
            var_dump($Apporter);
            if ($this->input->post('nocontributeur')) {
                if (!(empty($Apporter))) {
                    $this->ModeleUtilisateur->UpdateApporter($arrayName = array('NOCONTRIBUTEUR' => $this->input->post('nocontributeur'),'NOSPONSOR'=>$this->input->post('nosponsor')));
                }
                else
                {
                    $this->ModeleUtilisateur->AddApporter($arrayName = array('NOCONTRIBUTEUR' => $this->input->post('nocontributeur'),'NOSPONSOR'=>$this->input->post('nosponsor')));
                }
            }
            redirect('Administrateur_Organisation/Gestion_Sponsor');
        }
    }
    public function Ajout_Participer_Commission($commission,$contributeur)
    {
        $this->ModeleUtilisateur->AddParticiper($Participer = array('ANNEE' => date('Y'),'NOCOMMISSION'=>$commission,'NOCONTRIBUTEUR'=>$contributeur));
        redirect('Administrateur_Organisation/Gestion_Benevoles');
    }
    public function Supprimer_Participer_Commission($commission,$contributeur)
    {
        $this->ModeleUtilisateur->DeleteParticiper($Participer = array('ANNEE' => date('Y'),'NOCOMMISSION'=>$commission,'NOCONTRIBUTEUR'=>$contributeur));
        redirect('Administrateur_Organisation/Gestion_Benevoles');
    }
    public function Mailing_Remerciements()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Organisation/DonneeFixe');
        $this->load->view('Organisation/Mailing_Remerciements');
        if($this->input->post('submit'))
        {
            $LesSponsors = $this->ModeleUtilisateur->GetSponsorAnneeEnCours();
            //---- Envoye des mails a tout les randonneurs
            foreach ($LesSponsors as $UnSponsor)
            {
                if ($UnSponsor['MAILCONTACT']) 
                {
                    $this->load->library('email');
                    $this->email->from('thomas.choanier.BTS@gmail.com', 'L\'Equipe RandoTroll');
                    $this->email->to($UnSponsor['MAILCONTACT']);
                    $this->email->subject($this->input->post('txtObject'));
                    $message = $this->input->post('email');
                    $this->email->message($message);
                    if (!$this->email->send())
                    {
                            $this->email->print_debugger();
                    }
                }
            }
        }
    }
    public function Mailing_Tout_Les_Sponsors()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Organisation/DonneeFixe');
        $this->load->view('Organisation/Mailing_Tout_Les_Sponsors');
        if($this->input->post('submit'))
        {
            $LesSponsors = $this->ModeleUtilisateur->GetSponsors();
            //---- Envoye des mails a tout les randonneurs
            foreach ($LesSponsors as $UnSponsor)
            {
                if ($UnSponsor['MAILCONTACT']) 
                {
                    $this->load->library('email');
                    $this->email->from('thomas.choanier.BTS@gmail.com', 'L\'Equipe RandoTroll');
                    $this->email->to($UnSponsor['MAILCONTACT']);
                    $this->email->subject($this->input->post('txtObject'));
                    $message = $this->input->post('email');
                    $this->email->message($message);
                    if (!$this->email->send())
                    {
                            $this->email->print_debugger();
                    }
                }
            }
        }
    }
}
?>