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
    $this->db->where('MAIL', $Value['mail']);
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
    $this->db->where('NOEQUIPE', $Value['noequipe']);
    $requete = $this->db->get('choisir');
    return $requete->row_array();
  }
}