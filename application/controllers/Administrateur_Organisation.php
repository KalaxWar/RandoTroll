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
            $UnContributeur['bene'] = $this->ModeleUtilisateur->GetWhereApporteurDesSponsors($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
            $UnContributeur['sponso'] = $this->ModeleUtilisateur->GetWhereBenevole($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
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
            $UnContributeur['bene'] = $this->ModeleUtilisateur->GetWhereApporteurDesSponsors($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
            $UnContributeur['sponso'] = $this->ModeleUtilisateur->GetWhereBenevole($Utilisateur = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));

            if (!(isset($UnContributeur['bene']))) 
            {
                if ($this->input->post('Bene')) 
                {
                    $this->ModeleUtilisateur->AddApporteurDesSponsors($arrayName = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
                }
            }
            if (!(isset($UnContributeur['sponso']))) 
            {
                if ($this->input->post('Sponso')) 
                {
                    $this->ModeleUtilisateur->AddBenevole($arrayName = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
                }
            }
            redirect('Administrateur_Organisation/Gestion_Contributeur');
            
        }
    }
}
?>