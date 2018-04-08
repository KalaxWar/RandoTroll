<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visiteur extends CI_Controller {
	public function __construct()
   {
     parent::__construct();
     $this->load->view('Template/EnTete');
    }
	public function index()
	{
        $this->connexion();
    }
    public function connexion()
    {
        $this->load->view('Connexion/Visiteur');
        $valide = $this->input->post('valide');
        if ($valide == 1)
        {
            $Utilisateur = $this->ModeleUtilisateur->GetConnexionVisiteur($Utilisateur = array('Inscription' => '','mail' => $this->input->post('txtLogin'), 'mdp'=> $this->input->post('txtMdp')));
            var_dump($Utilisateur);
            if (!($Utilisateur == null))
            {
                $this->session->profil = 'responsable';
                $this->session->nom = $Utilisateur['NOM'];
                $this->session->prenom = $Utilisateur['PRENOM'];
                $this->session->mail = $Utilisateur['MAIL'];
                $this->session->numero = $Utilisateur['NOPARTICIPANT'];
                $this->session->numeroEquipe = $Utilisateur['NOEQUIPE'];
                redirect('Responsable');
            }
        }
    }
    public function inscription()
    {
        $this->load->view('Connexion/inscription');
        $valide = $this->input->post('valide');
        if ($valide == 1)
        {
            $MailExisteResponsable = $this->ModeleUtilisateur->VerifMailResponsable($Utilisateur = array('mail' => $this->input->post('txtMail')));
            $MailExisteRandonneur['LesRandonneur'] = $this->ModeleUtilisateur->getRandonneur($Utilisateur = array('MAIL' => $this->input->post('txtMail')));
            if ($MailExisteResponsable ==0)
             { //mail n'existe pas
                if (!($MailExisteRandonneur == null)) {
                    foreach ($MailExisteRandonneur['LesRandonneur'] as $UnRandonneur) {
                        $this->ModeleUtilisateur->UpdateRandonneur($arrayName = array('NOPARTICIPANT' =>$UnRandonneur['NOPARTICIPANT'], 'MAIL' => null ));
                    }
                }
                $var = $this->input->post('txtDate');
                $date = str_replace('/', '-', $var);
                $date = date('Y-m-d', strtotime($date));
                $Participant = array(
                    'NOM' =>$this->input->post('txtNom'),
                    'PRENOM' =>$this->input->post('txtPrenom'),
                    'DATEDENAISSANCE' =>$date,
                    'SEXE' =>$this->input->post('sexe')
                );
                $this->ModeleUtilisateur->AddParticipant($Participant); // ajout du participant(responsable) dans la BDD
                $UnParticipant = $this->ModeleUtilisateur->getParticipant($Participant);
                $responsable = array(
                    'NOPARTICIPANT' => $UnParticipant['NOPARTICIPANT'] ,
                    'MOTDEPASSE' => $this->input->post('txtMdp'),
                    'MAIL' => $this->input->post('txtMail'),
                    'TELPORTABLE' => $this->input->post('txtTel')
                );
                $this->ModeleUtilisateur->AddResponsable($responsable); //ajout du responsable dans la BDD
                $equipe = array(
                    'NOPAR_RESPONSABLE' => $UnParticipant['NOPARTICIPANT'],
                    'NOMEQUIPE' => $this->input->post('txtEquipe')
                );
                $this->ModeleUtilisateur->AddEquipe($equipe); // ajout de l'équipe dans la BDD
                $Utilisateur = $this->ModeleUtilisateur->GetConnexionVisiteur($Utilisateur = array('Inscription' => '','mail' => $this->input->post('txtMail'), 'mdp'=> $this->input->post('txtMdp')));// on récupère les info du responsable
                var_dump($Utilisateur);
                $membreDe = array(
                    'NOPARTICIPANT' => $UnParticipant['NOPARTICIPANT'],
                    'ANNEE' => date('Y'),
                    'NOEQUIPE' => $Utilisateur['NOEQUIPE'],
                    'REPASSURPLACE' => 0
                );
                $this->ModeleUtilisateur->AddMembreDe($membreDe); // ajout du responsable dans MembreDe dans la BDD
                redirect('Visiteur');
            }
            else //email déjà utilisé
            {
                $Value['Value'] = 'Impossible adresse email déjà utilisée.';
                $this->load->view('BoiteAlerte',$Value);
            }
        }
    }

    public function seDeConnecter()
    {
        $this->session->sess_destroy();
            redirect('Visiteur');
    }
}
