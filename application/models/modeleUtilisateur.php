<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeleUtilisateur extends CI_Model {
  public function __construct()
  {
  $this->load->database();
  /* chargement database.php (dans config), obligatoirement dans le constructeur */
  }
  public function GetConnexionVisiteur($Value)
  {
    $this->db->select('*');
    if (isset($Value['mail'])) 
    {
      $this->db->where('MAIL', $Value['mail']);
    }
    if (isset($Value['mdp'])) 
    {
      $this->db->where('MOTDEPASSE', $Value['mdp']);
    }
    if (isset($Value['noparticipant'])) 
    {
      $this->db->where('participant.NOPARTICIPANT', $Value['noparticipant']);
    }

    $this->db->join('participant', 'participant.NOPARTICIPANT = responsable.NOPARTICIPANT');
    $this->db->join('equipe', 'equipe.NOPAR_RESPONSABLE = participant.NOPARTICIPANT');
    if (!(isset($Value['Inscription']))) //sert uniquement lors de la requete d'inscritption (pour pas écrire la jointure qui suit)
    {
      $this->db->join('membrede', 'participant.NOPARTICIPANT = membrede.NOPARTICIPANT');
    }
    $requete = $this->db->get('responsable');
    return $requete->row_array();
  }
  public function VerifMailResponsable($Value)
  {
    $this->db->select('*');
    $this->db->from('responsable');
    if (isset($Value['noparticipant']))
    {
    $this->db->where_not_in('NOPARTICIPANT', $Value['noparticipant']);
    }
    $this->db->where('MAIL', $Value['mail']);
    return $this->db->count_all_results();
  }
  public function VerifNomEquipe($Value)
  {
    $this->db->select('*');
    $this->db->from('equipe');
    if (isset($Value['noequipe']))
    {
    $this->db->where_not_in('NOEQUIPE', $Value['noequipe']);
    }
    $this->db->where('NOMEQUIPE', $Value['nomequipe']);
    return $this->db->count_all_results();
  }
  public function getRandonneur($Value)
  {
    $requete = $this->db->get_where('randonneur', $Value);
    return $requete->result_array();
  }
  public function AddParticipant($Value)
  {
    $this->db->insert('participant', $Value);
    return $this->db->insert_id();
  }
  public function AddResponsable($Value)
  {
    $this->db->insert('responsable', $Value);
  }
  public function getParticipant($Value)
  {
    $requete = $this->db->get_where('participant',$Value);
    return $requete->row_array(); 
  }
  public function AddEquipe($Value)
  {
    $this->db->insert('equipe', $Value);
  }
  public function AddMembreDe($Value)
  {
    $this->db->insert('membrede', $Value);
  }
  public function GetMembreEquipe($Value)
  {
    $this->db->select('*');
    if (isset($Value['noequipe'])) //si en paramètre il y a noequipe
    {
      $this->db->where('membrede.NOEQUIPE', $Value['noequipe']);
    }
    if (isset($Value['annee'])) //si en paramètre il y a annee
    {
      $this->db->where('ANNEE', $Value['annee']);
    }
    if (isset($Value['noparticipant'])) //si en paramètre il y a noparticipant
    {
      $this->db->where('participant.NOPARTICIPANT', $Value['noparticipant']);
    }
    $this->db->join('randonneur', 'participant.NOPARTICIPANT = randonneur.NOPARTICIPANT','left');
    $this->db->join('membrede', 'participant.NOPARTICIPANT = membrede.NOPARTICIPANT');
    $requete = $this->db->get('participant');
    return $requete->result_array();
  }
  public function AddRandonneur($Value)
  {
    $this->db->insert('randonneur', $Value);
  }
  public function UpdateRandonneur($Value)
  {
    $this->db->where('NOPARTICIPANT', $Value['NOPARTICIPANT']);
    $this->db->update('randonneur', $Value);
  }
  public function UpdateResponsable($Value)
  {
    $this->db->where('NOPARTICIPANT', $Value['NOPARTICIPANT']);
    $this->db->update('responsable', $Value);
  }
  public function UpdateParticipant($Value)
  {
    $this->db->where('NOPARTICIPANT', $Value['NOPARTICIPANT']);
    $this->db->update('participant', $Value);
  }
  public function UpdateMembreDe($Value)
  {
    $this->db->where('NOPARTICIPANT', $Value['NOPARTICIPANT']);
    $this->db->update('membrede', $Value);
  }
  public function UpdateEquipe($Value)
  {
    $this->db->where('NOEQUIPE', $Value['NOEQUIPE']);
    $this->db->update('equipe', $Value);
  }
  public function DeleteParticipant($Value)
  {
    $tables = array('membrede','randonneur','participant');
    $this->db->where('NOPARTICIPANT', $Value);
    $this->db->delete($tables);
  }
  public function GetParcours()
  {
    $requete = $this->db->get('parcours');
    return $requete->result_array();
  }
  public function GetAnnee($Value)
  {
    $this->db->where('ANNEE', $Value['annee']);
    $requete = $this->db->get('annee');
    return $requete->row_array();
  }
  public function AddChoisir($Value)
  {
    $this->db->insert('choisir', $Value);
  }
  public function GetChoisir($Value)
  {
    $this->db->where('NOEQUIPE', $Value['NOEQUIPE']);
    $this->db->where('ANNEE', $Value['ANNEE']);
    $requete = $this->db->get('choisir');
    return $requete->row_array();
  }
  public function AddSinscrire($Value)
  {
    $this->db->insert('sinscrire', $Value);
  }
  public function UpdateChoisir($Value)
  {
    $this->db->where('NOEQUIPE', $Value['NOEQUIPE']);
    $this->db->where('ANNEE', $Value['ANNEE']);
    $this->db->update('choisir', $Value);
  }
  public function GetAdulteEquipe($Value)
  {
    $this->db->select('*');
    $this->db->join('membrede', 'membrede.NOPARTICIPANT = participant.NOPARTICIPANT');
    $this->db->where('NOEQUIPE', $Value['NOEQUIPE']);
    $this->db->where('DATEDENAISSANCE <', $Value['DATE']);
    $requete = $this->db->get('participant');
    return $requete->result_array();
  }
  public function GetEnfantEquipe($Value)
  {
    $this->db->select('*');
    $this->db->join('membrede', 'membrede.NOPARTICIPANT = participant.NOPARTICIPANT');
    $this->db->where('NOEQUIPE', $Value['NOEQUIPE']);
    $this->db->where('DATEDENAISSANCE >', $Value['DATE']);
    $requete = $this->db->get('participant');
    return $requete->result_array();
  }
  public function GetAdministrateur($Value)
  {
    $this->db->select('*');
    $this->db->where('EMAIL', $Value['email']);
    $this->db->join('benevole', 'benevole.NOCONTRIBUTEUR = contributeur.NOCONTRIBUTEUR');
    $this->db->join('administrateur', 'benevole.NOCONTRIBUTEUR = administrateur.NOCONTRIBUTEUR');
    $this->db->where('MOTDEPASSE', $Value['mdp']);
    $requete = $this->db->get('contributeur');
    return $requete->row_array();
  }
  public function GetInscription($Value)
  {
    $requete = $this->db->get_where('sinscrire',$Value);
    return $requete->result_array();
  }
  public function GetWhereEquipe($Value)
  {
    $requete = $this->db->get_where('equipe',$Value);
    return $requete->row_array();
  }
  public function GetEquipeParAnnee($Value)
  {
    $this->db->select('*');
    $this->db->join('equipe', 'sinscrire.NOEQUIPE = equipe.NOEQUIPE');
    $this->db->join('responsable', 'responsable.NOPARTICIPANT = equipe.NOPAR_RESPONSABLE');
    $this->db->join('participant', 'equipe.NOPAR_RESPONSABLE = participant.NOPARTICIPANT');
    $this->db->where('ANNEE', $Value['ANNEE']);
    if (isset($Value['NOEQUIPE']))
    {
      $this->db->where('sinscrire.NOEQUIPE', $Value['NOEQUIPE']);
    }
    $requete = $this->db->get('sinscrire');
    if (isset($Value['NOEQUIPE']))
    {
      return $requete->row_array();
    }
    return $requete->result_array();
  }
  public function UpdateSinscrire($Value)
  {
    $this->db->where('NOEQUIPE', $Value['NOEQUIPE']);
    $this->db->where('ANNEE', $Value['ANNEE']);
    $this->db->update('sinscrire', $Value);
  }
  public function GetEquipeValide()
  {
    $this->db->select('*');
    $this->db->where('DATEVALIDATION <>', NULL);
    $this->db->join('membrede', 'membrede.NOEQUIPE = sinscrire.NOEQUIPE');
    $this->db->join('equipe', 'sinscrire.NOEQUIPE = equipe.NOEQUIPE');
    $this->db->join('participant', 'participant.NOPARTICIPANT = membrede.NOPARTICIPANT');
    $this->db->order_by('equipe.NOEQUIPE', 'ASC');
    $requete = $this->db->get('sinscrire');
    return $requete->result_array();
  }
  public function GetNombreEquipeInscrite($Value)
  {
    $this->db->where('sinscrire.ANNEE', $Value['ANNEE']);
    $this->db->where('parcours.NOPARCOURS', $Value['NOPARCOURS']);
    $this->db->where('sinscrire.DATEVALIDATION <>', null);
    $this->db->from('sinscrire');
    $this->db->join('choisir', 'choisir.NOEQUIPE = sinscrire.NOEQUIPE');
    $this->db->join('parcours', 'choisir.NOPARCOURS = parcours.NOPARCOURS');
    return $this->db->count_all_results(); 
  }
  /*public function GetNombreParticipantInscrit($Value)
  {
    $this->db->where('sinscrire.ANNEE', $Value['ANNEE']);
    $this->db->where('parcours.NOPARCOURS', $Value['NOPARCOURS']);
    $this->db->where('sinscrire.DATEVALIDATION <>', null);
    $this->db->from('membrede');
    $this->db->join('equipe', 'equipe.NOEQUIPE = membrede.NOEQUIPE');
    $this->db->join('sinscrire', 'sinscrire.NOEQUIPE = equipe.NOEQUIPE');
    $this->db->join('choisir', 'choisir.NOEQUIPE = sinscrire.NOEQUIPE');
    $this->db->join('parcours', 'choisir.NOPARCOURS = parcours.NOPARCOURS');
    return $this->db->count_all_results();
  }*/
  public function GetNombreParticipantAdulteInscrit($Value)
  {
    $this->db->where('sinscrire.ANNEE', $Value['ANNEE']);
    $this->db->where('parcours.NOPARCOURS', $Value['NOPARCOURS']);
    $this->db->where('sinscrire.DATEVALIDATION <>', null);
    $this->db->where('DATEDENAISSANCE <', $Value['DATE']);
    $this->db->from('participant');
    $this->db->join('membrede', 'membrede.NOPARTICIPANT = participant.NOPARTICIPANT');
    $this->db->join('equipe', 'equipe.NOEQUIPE = membrede.NOEQUIPE');
    $this->db->join('sinscrire', 'sinscrire.NOEQUIPE = equipe.NOEQUIPE');
    $this->db->join('choisir', 'choisir.NOEQUIPE = sinscrire.NOEQUIPE');
    $this->db->join('parcours', 'choisir.NOPARCOURS = parcours.NOPARCOURS');
    return $this->db->count_all_results();
  }
  public function GetNombreParticipantEnfantInscrit($Value)
  {
    $this->db->where('sinscrire.ANNEE', $Value['ANNEE']);
    $this->db->where('parcours.NOPARCOURS', $Value['NOPARCOURS']);
    $this->db->where('sinscrire.DATEVALIDATION <>', null);
    $this->db->where('DATEDENAISSANCE >', $Value['DATE']);
    $this->db->from('participant');
    $this->db->join('membrede', 'membrede.NOPARTICIPANT = participant.NOPARTICIPANT');
    $this->db->join('equipe', 'equipe.NOEQUIPE = membrede.NOEQUIPE');
    $this->db->join('sinscrire', 'sinscrire.NOEQUIPE = equipe.NOEQUIPE');
    $this->db->join('choisir', 'choisir.NOEQUIPE = sinscrire.NOEQUIPE');
    $this->db->join('parcours', 'choisir.NOPARCOURS = parcours.NOPARCOURS');
    return $this->db->count_all_results();
  }
  public function getTotalEncaisse($Value)
  {
    $this->db->where('sinscrire.ANNEE', $Value['ANNEE']);
    $this->db->select_sum('MONTANTPAYE');
    $this->db->select_sum('MONTANTREMBOURSE');
    $requete = $this->db->get('sinscrire');
    return $requete->row_array();
  }
  public function GetRepasAdultes($Value)
  {
    $this->db->where('sinscrire.ANNEE', $Value['ANNEE']);
    $this->db->where('sinscrire.DATEVALIDATION <>', null);
    $this->db->where('DATEDENAISSANCE <', $Value['DATE']);
    $this->db->from('participant');
    $this->db->join('membrede', 'membrede.NOPARTICIPANT = participant.NOPARTICIPANT');
    $this->db->join('equipe', 'equipe.NOEQUIPE = membrede.NOEQUIPE');
    $this->db->join('sinscrire', 'sinscrire.NOEQUIPE = equipe.NOEQUIPE');
    return $this->db->count_all_results();
  }
  public function GetRepasEnfants($Value)
  {
    $this->db->where('sinscrire.ANNEE', $Value['ANNEE']);
    $this->db->where('sinscrire.DATEVALIDATION <>', null);
    $this->db->where('DATEDENAISSANCE >', $Value['DATE']);
    $this->db->from('participant');
    $this->db->join('membrede', 'membrede.NOPARTICIPANT = participant.NOPARTICIPANT');
    $this->db->join('equipe', 'equipe.NOEQUIPE = membrede.NOEQUIPE');
    $this->db->join('sinscrire', 'sinscrire.NOEQUIPE = equipe.NOEQUIPE');
    return $this->db->count_all_results();
  }
  public function GetEmailRandonneur()
  {
    $this->db->select('distinct (MAIL)');
    $this->db->join('randonneur', 'randonneur.NOPARTICIPANT = participant.NOPARTICIPANT');
    $this->db->where('MAIL <>', 'NULL');
    $requete = $this->db->get('participant');
    return $requete->result_array();
  }
  public function GetEmailResponsable()
  {
    $this->db->select('distinct (MAIL)');
    $this->db->join('responsable', 'responsable.NOPARTICIPANT = participant.NOPARTICIPANT');
    $requete = $this->db->get('participant');
    return $requete->result_array();
  }
}