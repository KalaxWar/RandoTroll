<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Responsable extends CI_Controller {
	public function __construct()
   {
     parent::__construct();
     if (!($this->session->profil == 'responsable')) {
       
       redirect('Visiteur');
       
     }
     $this->load->view('Template/EnTete');
     $this->load->view('Responsable/DonneeFixe');
    }
    public function index()
    {
     $AnneeEnCours = $this->ModeleUtilisateur->GetAnnee($Utilisateur = array( 'annee'=> date('Y')));
     $this->session->AnneeEnCours = $AnneeEnCours; //je fait les 2 cathégories d'age (date de la course - la limite d'age)
     $date= $AnneeEnCours['DATECOURSE'];
     $an=substr($date,0,4); 
     $mois=substr($date,5,2); 
     $jour=substr($date,8,2);
     $an = $an - $AnneeEnCours['LIMITEAGE'];
     $Adultes = $this->ModeleUtilisateur->GetAdulteEquipe($Utilisateur = array('NOEQUIPE' => $this->session->numeroEquipe, 'DATE'=> $an.'/'.$mois.'/'.$jour));
     $UnUtilisateur['NBAdultesInscri'] = count($Adultes);
     $NBrepasAdulte = 0;
     foreach ($Adultes as $UnAdulte) {
       if ($UnAdulte['REPASSURPLACE']==1)
       {
         $NBrepasAdulte++;
       }
     }
     $UnUtilisateur['NBrepasAdulte'] = $NBrepasAdulte;
     $Enfant = $this->ModeleUtilisateur->GetEnfantEquipe($Utilisateur = array('NOEQUIPE' => $this->session->numeroEquipe, 'DATE'=> $an.'/'.$mois.'/'.$jour));
     $UnUtilisateur['NBEnfantsInscri'] = count($Enfant);
     $NBrepasEnfant = 0;
     foreach ($Enfant as $UnEnfant) {
       if ($UnEnfant['REPASSURPLACE']==1)
       {
         $NBrepasEnfant++;
       }
     }
     $UnUtilisateur['NBrepasEnfant'] = $NBrepasEnfant;
     $UnUtilisateur['LesUtilisateur'] = $this->ModeleUtilisateur->GetMembreEquipe($Utilisateur = array('noequipe' => $this->session->numeroEquipe, 'annee'=> date('Y')));
     $NombreDInscrit = count($UnUtilisateur['LesUtilisateur']);
     $UnUtilisateur['Responsable'] = $this->ModeleUtilisateur->GetConnexionVisiteur($Participant = array('noparticipant' => $this->session->numero));
     $UnUtilisateur['LesParcours'] = $this->ModeleUtilisateur->GetParcours();
     $UnUtilisateur['ParcoursChoisis'] = $this->ModeleUtilisateur->GetChoisir($arrayName = array('NOEQUIPE' =>$this->session->numeroEquipe,'ANNEE' => date('Y')));
     $UnUtilisateur['NombreDInscrit'] = $NombreDInscrit;
    $this->load->view('Responsable/Accueil',$UnUtilisateur);
    $this->load->view('Responsable/AjouterRandonneur');
    $this->load->view('Responsable/InscriptionEquipe',$UnUtilisateur);
    }
    public function modifierRandonneur($numero = null)
    {
      if (!($numero == null))
      {
        $AnneeEnCours = $this->ModeleUtilisateur->GetAnnee($Utilisateur = array( 'annee'=> date('Y')));
        $this->session->AnneeEnCours = $AnneeEnCours; //je fait les 2 cathégories d'age (date de la course - la limite d'age)
        $date= $AnneeEnCours['DATECOURSE'];
        $an=substr($date,0,4); 
        $mois=substr($date,5,2); 
        $jour=substr($date,8,2);
        $an = $an - $AnneeEnCours['LIMITEAGE'];
        $Adultes = $this->ModeleUtilisateur->GetAdulteEquipe($Utilisateur = array('NOEQUIPE' => $this->session->numeroEquipe, 'DATE'=> $an.'/'.$mois.'/'.$jour));
        $UnUtilisateur['NBAdultesInscri'] = count($Adultes);
        $NBrepasAdulte = 0;
        foreach ($Adultes as $UnAdulte) {
          if ($UnAdulte['REPASSURPLACE']==1)
          {
            $NBrepasAdulte++;
          }
        }
        $UnUtilisateur['NBrepasAdulte'] = $NBrepasAdulte;
        $Enfant = $this->ModeleUtilisateur->GetEnfantEquipe($Utilisateur = array('NOEQUIPE' => $this->session->numeroEquipe, 'DATE'=> $an.'/'.$mois.'/'.$jour));
        $UnUtilisateur['NBEnfantsInscri'] = count($Enfant);
        $NBrepasEnfant = 0;
        foreach ($Enfant as $UnEnfant) {
          if ($UnEnfant['REPASSURPLACE']==1)
          {
            $NBrepasEnfant++;
          }
        }
        $UnUtilisateur['NBrepasEnfant'] = $NBrepasEnfant;
        $arrayName = array('NOPARTICIPANT' => $this->session->numero, );
        $LesMembresEquipes = $this->ModeleUtilisateur->GetMembreEquipe($arrayName);
        $UnUtilisateur['Responsable'] = $this->ModeleUtilisateur->GetConnexionVisiteur($Participant = array('noparticipant' => $this->session->numero));
        $UnUtilisateur['LesUtilisateur'] = $this->ModeleUtilisateur->GetMembreEquipe($Utilisateur = array('noequipe' => $this->session->numeroEquipe, 'annee'=> date('Y')));
        $NombreDInscrit = count($UnUtilisateur['LesUtilisateur']);
        $UnUtilisateur['NombreDInscrit'] = $NombreDInscrit;
        $UnUtilisateur['LesParcours'] = $this->ModeleUtilisateur->GetParcours();
        $UnUtilisateur['ParcoursChoisis'] = $this->ModeleUtilisateur->GetChoisir($arrayName = array('NOEQUIPE' =>$this->session->numeroEquipe,'ANNEE' => date('Y')));
        $this->load->view('Responsable/Accueil',$UnUtilisateur);
        foreach ($LesMembresEquipes as $UnMembreEquipe) 
        {
          if ($UnMembreEquipe['NOPARTICIPANT'] == $numero) //si le membre que l'on veux supprimer fait bien parti de l'équipe sur la session actuel
          {
            if (!($UnMembreEquipe['NOPARTICIPANT'] == $this->session->numero)) // si le membre n'est pas le responsable
            {
              $UnParticipant = $this->ModeleUtilisateur->getParticipant($Participant = array('NOPARTICIPANT' => $numero));
              $LeParticipantAModif = $this->ModeleUtilisateur->GetMembreEquipe($Utilisateur = array('noparticipant' => $UnParticipant['NOPARTICIPANT']));
              if ((!$LeParticipantAModif == null))
              {
                $this->load->view('Responsable/AjouterRandonneur',$LeParticipantAModif[0]);
                $this->load->view('Responsable/InscriptionEquipe',$UnUtilisateur);
              }
            }
            else
            {
              redirect('Responsable','refresh'); //force si l'utilisateur change dans l'URL le numéro
            }
          }
        }
      }
      else
        {
          redirect('Responsable','refresh'); //force si l'utilisateur change dans l'URL le numéro
        }


      $valide = $this->input->post('Valide');
      if ($valide ==1) 
      { // alors j'update toute les tables
        if ($this->input->post('txtMail') == '') { $mail = null;} else {$mail = $this->input->post('txtMail');}
        if($this->ModeleUtilisateur->VerifMailResponsable($arrayName = array('mail' => $mail))) // si le mail du randonneur est identique a celui d'un responsable
        {
          $Value['Value'] = 'Impossible adresse email déjà utilisée par un responsable.';
          $this->load->view('BoiteAlerte',$Value);
          $mail = null;
        }
        else // si le mail n'est pas utilisé
        {
          $var = $this->input->post('txtDate');
          $date = str_replace('/', '-', $var);
          $date = date('Y-m-d', strtotime($date));
          $Participant = array(
            'NOPARTICIPANT' =>$numero,
            'NOM' =>$this->input->post('txtNom'),
            'PRENOM' =>$this->input->post('txtPrenom'),
            'DATEDENAISSANCE' =>$date,
            'SEXE' =>$this->input->post('sexe')
          );
          $this->ModeleUtilisateur->UpdateParticipant($Participant); // Update dans la table Participant

          if ($this->input->post('txtTel') == '') { $tel = null;} else {$tel = $this->input->post('txtTel');}
          $randonneur = array(
            'NOPARTICIPANT' => $numero ,
            'MAIL' => $mail,
            'TELPORTABLE' => $tel
          );
          $this->ModeleUtilisateur->UpdateRandonneur($randonneur); // Update dans la table Randonneur

          $membreDe = array(
            'NOPARTICIPANT' => $numero,
            'REPASSURPLACE' => $this->input->post('repas')
          );
          $this->ModeleUtilisateur->UpdateMembreDe($membreDe); // Update dans la table MembreDe
          redirect('Responsable/modifierRandonneur/'.$numero);
        }
      }
    }

    public function AjouterRandoneur()
    {
      $var = $this->input->post('txtDate');
      $date = str_replace('/', '-', $var);
      $date = date('Y-m-d', strtotime($date));
      $Participant = array(
        'NOM' =>$this->input->post('txtNom'),
        'PRENOM' =>$this->input->post('txtPrenom'),
        'DATEDENAISSANCE' =>$date,
        'SEXE' =>$this->input->post('sexe')
        );
      $this->ModeleUtilisateur->AddParticipant($Participant); // ajout du participant dans la BDD

      $UnParticipant = $this->ModeleUtilisateur->getParticipant($Participant); //récupère le numero du nouveau participant
      if ($this->input->post('txtMail') == '') { $mail = null;} else {$mail = $this->input->post('txtMail');}
      if ($this->input->post('txtTel') == '') { $tel = null;} else {$tel = $this->input->post('txtTel');}
      $randonneur = array(
          'NOPARTICIPANT' => $UnParticipant['NOPARTICIPANT'] ,
          'MAIL' => $mail,
          'TELPORTABLE' => $tel
      );
      $this->ModeleUtilisateur->AddRandonneur($randonneur); // ajout du randonneur dans la BDD

      $membreDe = array(
          'NOPARTICIPANT' => $UnParticipant['NOPARTICIPANT'],
          'ANNEE' => date('Y'),
          'NOEQUIPE' => $this->session->numeroEquipe,
          'REPASSURPLACE' => $this->input->post('repas')
      );
      $this->ModeleUtilisateur->AddMembreDe($membreDe); // ajout du responsable dans MembreDe dans la BDD
      redirect('Responsable','refresh');
    }

    public function SupprimerParticipant($numero)
    {
      $arrayName = array('NOPARTICIPANT' => $this->session->numero, );
      $LesMembresEquipes = $this->ModeleUtilisateur->GetMembreEquipe($arrayName);
      foreach ($LesMembresEquipes as $UnMembreEquipe) {
        if ($UnMembreEquipe['NOPARTICIPANT'] == $numero) //si le membre que l'on veux supprimer fait bien parti de l'équipe sur la session actuel
        {
          if (!($UnMembreEquipe['NOPARTICIPANT'] == $this->session->numero)) // si le membre n'est pas le responsable
          {
            $this->ModeleUtilisateur->DeleteParticipant($numero); // alors ont supprime
            redirect('Responsable');
          }

        }
      }
      var_dump($LesMembresEquipes);

    }

    public function MonCompte()
    {
      $this->load->view('Responsable/Compte');
    }
    public function inscriptionEquipe()
    {
      $Choisir = array(
        'NOEQUIPE' =>$this->session->numeroEquipe, 
        'ANNEE' => date('Y'),
        'NOPARCOURS' => $this->input->post('Parcours')
      );
      $ResultChoisir = $this->ModeleUtilisateur->GetChoisir($arrayName = array('NOEQUIPE' =>$this->session->numeroEquipe,'ANNEE' => date('Y')));
      if (!(isset($ResultChoisir)))
      {
        $this->ModeleUtilisateur->AddChoisir($Choisir);
        $Sinscrire = array(
          'NOEQUIPE' => $this->session->numeroEquipe,
          'ANNEE'=> date('Y'),
          'DATEINSCRIPTION'=> date('Y-m-d'));
          var_dump($Sinscrire);
        $this->ModeleUtilisateur->AddSinscrire($Sinscrire);
      }
      else
      {
        $this->ModeleUtilisateur->UpdateChoisir($Choisir);
      }
      redirect('Responsable');
    }
}
