<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super_Administrateur extends CI_Controller {
	public function __construct()
   {
    parent::__construct();
    {
        if (!($this->session->profil == 'super')) // 0 : statut visiteur
      {
        redirect('Visiteur'); // pas les droits : redirection vers connexion
      }
    }
   }
	public function index()
	{
        $this->load->view('Template/EnTete');
        $this->load->view('super/DonneeFixe');
    }
    public function Gestion_annee()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('super/DonneeFixe');
        $Annee = $this->ModeleUtilisateur->GetAnnee($arrayName = array('annee' => date('Y')));
        if (empty($Annee))
        {
            $this->load->view('super/Gestion_annee');
            if($this->input->post('submitForm'))
            {
                if ($this->input->post('txtCheminPdf') == '') { $CheminPdf = null;} else {$CheminPdf = $this->input->post('txtCheminPdf');}
                if ($this->input->post('txtCheminAffiche') == '') { $CheminAffiche = null;} else {$CheminAffiche = $this->input->post('txtCheminAffiche');}
                if ($this->input->post('txtCheminAffichette') == '') { $CheminAffichette = null;} else {$CheminAffichette = $this->input->post('txtCheminAffichette');}
                $Annee = array
                (
                    'ANNEE' => '2018',
                    'DATECOURSE' => $this->input->post('DateCourse'),
                    'LIMITEAGE' => $this->input->post('txtLimiteAge'),
                    'TARIFINSCRIPTIONADULTE' => $this->input->post('txtInscriA'),
                    'TARIFINSCRIPTIONENFANT' => $this->input->post('txtInscriE'),
                    'TARIFREPASENFANT' => $this->input->post('txtRepasA'),
                    'TARIFREPASADULTE' => $this->input->post('txtRepasE'),
                    'MAXPARTICIPANTS' => $this->input->post('txtParticipantMax'),
                    'MAXPAREQUIPE' => $this->input->post('txtMaxParEquipe'),
                    'DATECLOTUREINSCRIPTION' => $this->input->post('DateCloture'),
                    'MAILORGANISATION' => $this->input->post('txtMail'),
                    'CHEMINPDFLIVRET' => $CheminPdf,
                    'CHEMINIMAGEAFFICHE' => $CheminAffiche,
                    'CHEMINIMAGEAFFICHETTE' => $CheminAffichette,
                );
                $this->ModeleUtilisateur->AddAnnee($Annee);
            }
        }
        else {
            $this->load->view('super/Gestion_annee',$Annee);
            if($this->input->post('submitModif'))
            {
                if ($this->input->post('txtCheminPdf') == '') { $CheminPdf = null;} else {$CheminPdf = $this->input->post('txtCheminPdf');}
                if ($this->input->post('txtCheminAffiche') == '') { $CheminAffiche = null;} else {$CheminAffiche = $this->input->post('txtCheminAffiche');}
                if ($this->input->post('txtCheminAffichette') == '') { $CheminAffichette = null;} else {$CheminAffichette = $this->input->post('txtCheminAffichette');}
                $Annee = array
                (
                    'ANNEE' => '2018',
                    'DATECOURSE' => $this->input->post('DateCourse'),
                    'LIMITEAGE' => $this->input->post('txtLimiteAge'),
                    'TARIFINSCRIPTIONADULTE' => $this->input->post('txtInscriA'),
                    'TARIFINSCRIPTIONENFANT' => $this->input->post('txtInscriE'),
                    'TARIFREPASENFANT' => $this->input->post('txtRepasA'),
                    'TARIFREPASADULTE' => $this->input->post('txtRepasE'),
                    'MAXPARTICIPANTS' => $this->input->post('txtParticipantMax'),
                    'MAXPAREQUIPE' => $this->input->post('txtMaxParEquipe'),
                    'DATECLOTUREINSCRIPTION' => $this->input->post('DateCloture'),
                    'MAILORGANISATION' => $this->input->post('txtMail'),
                    'CHEMINPDFLIVRET' => $CheminPdf,
                    'CHEMINIMAGEAFFICHE' => $CheminAffiche,
                    'CHEMINIMAGEAFFICHETTE' => $CheminAffichette,
                );
                $this->ModeleUtilisateur->UpdateAnnee($Annee);
                
                redirect('Super_Administrateur/Gestion_annee');
                
            }
        }
    }
    public function Gestion_Droit()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('super/DonneeFixe');
        $LesBénévoles['LesBénévoles'] = $this->ModeleUtilisateur->GetBenevole();
        $this->load->view('super/Recherche_Benevoles',$LesBénévoles);
        if ($this->input->post('submitRecherche')) {
            $Administrateur = $this->ModeleUtilisateur->GetAdministrateur($arrayName = array('nocontributeur' =>$this->input->post('nocontributeur')));
            $Administrateur['NOCONTRIBUTEUR']=$this->input->post('nocontributeur');
            $this->load->view('super/Attribution_Droit',$Administrateur);
        }
        if ($this->input->post('submitAjout')) {
            $Administrateur = $this->ModeleUtilisateur->GetAdministrateur($arrayName = array('nocontributeur' =>$this->input->post('nocontributeur')));
            if (!(empty($Administrateur))) {
                $this->ModeleUtilisateur->UpdateAdministrateur($admin = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur'),'PROFIL'=>$this->input->post('Droit') ));
            }
            else{
                $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'; // génération du mdp
                $MDP = str_shuffle($char);
                $MDP = substr($MDP, '0','6'); //mdp généré
                $this->ModeleUtilisateur->addAdministrateur($admin = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur'),'MOTDEPASSE'=>$MDP,'PROFIL'=>$this->input->post('Droit') ));
                $LeNewAdmin=$this->ModeleUtilisateur->GetWhereContributeur($arrayName = array('NOCONTRIBUTEUR' =>$this->input->post('nocontributeur')));
                $this->load->library('email');
                $this->email->from('thomas.choanier.BTS@gmail.com', 'L\'Equipe RandoTroll');
                $this->email->to($LeNewAdmin['EMAIL']);
                $this->email->subject('Votre mot de passe');
                $message = "Vous avez maintenant un compte administrateur ".$this->input->post('Droit')."! Votre mot de passe est : $MDP et votre nom d'utilisateur : ".$LeNewAdmin['EMAIL']." CDL le responsable";
                $this->email->message($message);
                if (!$this->email->send())
                {
                        $this->email->print_debugger();
                } 
            }
        }
    }
    public function Retrograder($Value)
    {
        $this->ModeleUtilisateur->DeleteAdministrateur($Value);
        redirect('Super_Administrateur/Gestion_Droit');
    }
    public function Mailing()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('super/DonneeFixe');
        $this->load->view('super/Mailing');
        if ($this->input->post('submit')) 
        {
            if ($this->input->post('sponsor')) 
            {
                if($this->input->post('qui')==1)
                {
                    $LesSponsors['LesSponsors'] = $this->ModeleUtilisateur->GetEmailSponsor(1);
                    //var_dump($LesSponsors);
                }
                else 
                {
                    $LesSponsors['LesSponsors'] = $this->ModeleUtilisateur->GetEmailSponsor(2);
                    //var_dump($LesSponsors);
                }
                foreach ($LesSponsors['LesSponsors'] as $UnSponsor) 
                {
                    $this->load->library('email');
                $this->email->from('thomas.choanier.BTS@gmail.com', 'L\'Equipe RandoTroll');
                $this->email->to($UnSponsor['MAILCONTACT']);
                $this->email->subject($this->input->post('txtObject'));
                $message = $this->input->post('email');
                $this->email->message($message);
                if (!$this->email->send()) // envoie au sponsor séléctionné
                {
                        $this->email->print_debugger();
                } 
                }
            }
            if ($this->input->post('participant')) 
            {
                if($this->input->post('qui')==1)
                {
                    $LesSponsors['LesRandonneur'] = $this->ModeleUtilisateur->GetEmailRandonneur();
                    $LesSponsors['LesResponsable'] = $this->ModeleUtilisateur->GetEmailResponsable();
                    var_dump($LesSponsors);
                }
                else 
                {
                    $LesSponsors['LesRandonneur'] = $this->ModeleUtilisateur->GetEmailRandonneur(1);
                    $LesSponsors['LesResponsable'] = $this->ModeleUtilisateur->GetEmailResponsable(1);
                    var_dump($LesSponsors);
                }
                foreach ($LesSponsors['LesRandonneur'] as $UnRandonneur) 
                {
                    $this->load->library('email');
                $this->email->from('thomas.choanier.BTS@gmail.com', 'L\'Equipe RandoTroll');
                $this->email->to($UnRandonneur['MAIL']);
                $this->email->subject($this->input->post('txtObject'));
                $message = $this->input->post('email');
                $this->email->message($message);
                if (!$this->email->send()) // envoie au randonneur séléctionné
                {
                        $this->email->print_debugger();
                } 
                }
                //----------------
                foreach ($LesSponsors['LesResponsable'] as $UnResponsable) 
                {
                    $this->load->library('email');
                $this->email->from('thomas.choanier.BTS@gmail.com', 'L\'Equipe RandoTroll');
                $this->email->to($UnResponsable['MAIL']);
                $this->email->subject($this->input->post('txtObject'));
                $message = $this->input->post('email');
                $this->email->message($message);
                if (!$this->email->send()) // envoie au responsable séléctionné
                {
                        $this->email->print_debugger();
                } 
                }
            }
            
        }
    }
}
?>