<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrateur_Inscription extends CI_Controller {
	public function __construct()
   {
    parent::__construct();
    
    }
	public function index()
	{
        $this->load->view('Template/EnTete');
        $this->load->view('Inscription/DonneeFixe');
    }

    public function EquipePasPayer()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Inscription/DonneeFixe');
        $AnneeEnCours = $this->ModeleUtilisateur->GetAnnee($Utilisateur = array( 'annee'=> date('Y')));
        $this->session->AnneeEnCours = $AnneeEnCours; //je fait les 2 cathégories d'age (date de la course - la limite d'age)
        $date= $AnneeEnCours['DATECOURSE'];
        $an=substr($date,0,4); 
        $mois=substr($date,5,2); 
        $jour=substr($date,8,2);
        $an = $an - $AnneeEnCours['LIMITEAGE'];
        $LesInscrits = $this->ModeleUtilisateur->GetInscription($date = array( 'annee'=> date('Y')));
        foreach ($LesInscrits as $UnInscrit) 
        {
            //$MembreEquipe = $this->ModeleUtilisateur->GetMembreEquipe($Utilisateur = array('noequipe' => $UnInscrit['NOEQUIPE'], 'annee'=> date('Y')));
            //$UneEquipe['nom'] = $UnInscrit['NOM'];
            $NomEquipe = $this->ModeleUtilisateur->GetWhereEquipe($Utilisateur = array( 'noequipe'=> $UnInscrit['NOEQUIPE']));
            $UneEquipe['NomEquipe'] = $NomEquipe['NOMEQUIPE'];
            $UneEquipe['NoEquipe'] = $NomEquipe['NOEQUIPE'];
            $Adultes = $this->ModeleUtilisateur->GetAdulteEquipe($Utilisateur = array('NOEQUIPE' => $UnInscrit['NOEQUIPE'], 'DATE'=> $an.'/'.$mois.'/'.$jour));
            $UneEquipe['NBAdultesInscri'] = count($Adultes);
            $NBrepasAdulte = 0;
            foreach ($Adultes as $UnAdulte) 
            {
                if ($UnAdulte['REPASSURPLACE']==1)
                {
                $NBrepasAdulte++;
                }
            }
            $UneEquipe['NBrepasAdulte'] = $NBrepasAdulte;
            $Enfant = $this->ModeleUtilisateur->GetEnfantEquipe($Utilisateur = array('NOEQUIPE' => $UnInscrit['NOEQUIPE'], 'DATE'=> $an.'/'.$mois.'/'.$jour));
            $UneEquipe['NBEnfantsInscri'] = count($Enfant);
            $NBrepasEnfant = 0;
            foreach ($Enfant as $UnEnfant) {
                if ($UnEnfant['REPASSURPLACE']==1)
                {
                    $NBrepasEnfant++;
                }
            }
            $UneEquipe['NBrepasEnfant'] = $NBrepasEnfant;
            $prixTotal = 0;
            $prixTotal +=$this->session->AnneeEnCours['TARIFINSCRIPTIONADULTE'] * $UneEquipe['NBAdultesInscri']; //on affiche les sous qu'ils devront
            $prixTotal +=$this->session->AnneeEnCours['TARIFREPASADULTE'] * $NBrepasAdulte;
            $prixTotal +=$this->session->AnneeEnCours['TARIFINSCRIPTIONENFANT'] * $UneEquipe['NBEnfantsInscri'];
            $prixTotal +=$this->session->AnneeEnCours['TARIFREPASENFANT'] * $NBrepasEnfant;
            $UneEquipe['PrixTotal'] = $prixTotal;
            $UneEquipe['MontantPaye'] = $UnInscrit['MONTANTPAYE'];
            if ($UnInscrit['MONTANTPAYE'] < $prixTotal) {
                $UneEquipe['Manque'] = $prixTotal - $UnInscrit['MONTANTPAYE'];
                $LesEquipes[] = $UneEquipe;
            }
        }
        $Equipes['LesEquipes'] = $LesEquipes;
        $Equipes['datefin'] = $AnneeEnCours['DATECLOTUREINSCRIPTION'];
        $this->load->view('Inscription/Relance', $Equipes);
    }
    public function Relance()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Inscription/DonneeFixe');
        if($this->input->post('submit')) 
        {  
            $AnneeEnCours = $this->ModeleUtilisateur->GetAnnee($Utilisateur = array( 'annee'=> date('Y')));
            $this->session->AnneeEnCours = $AnneeEnCours; //je fait les 2 cathégories d'age (date de la course - la limite d'age)
            $date= $AnneeEnCours['DATECOURSE'];
            $an=substr($date,0,4); 
            $mois=substr($date,5,2); 
            $jour=substr($date,8,2);
            $an = $an - $AnneeEnCours['LIMITEAGE'];
            $LesInscrits = $this->ModeleUtilisateur->GetInscription($date = array( 'annee'=> date('Y')));
            foreach ($LesInscrits as $UnInscrit) 
            {
                $Equipe = $this->ModeleUtilisateur->GetWhereEquipe($Utilisateur = array( 'noequipe'=> $UnInscrit['NOEQUIPE']));
                $NomEquipe = $Equipe['NOMEQUIPE'];
                $NoEquipe = $Equipe['NOEQUIPE'];
                $NoResponsable = $Equipe['NOPAR_RESPONSABLE'];
                $Adultes = $this->ModeleUtilisateur->GetAdulteEquipe($Utilisateur = array('NOEQUIPE' => $UnInscrit['NOEQUIPE'], 'DATE'=> $an.'/'.$mois.'/'.$jour));
                $NBAdultesInscri = count($Adultes);
                $NBrepasAdulte = 0;
                foreach ($Adultes as $UnAdulte) 
                {
                    if ($UnAdulte['REPASSURPLACE']==1)
                    {
                    $NBrepasAdulte++;
                    }
                }
                $Enfant = $this->ModeleUtilisateur->GetEnfantEquipe($Utilisateur = array('NOEQUIPE' => $UnInscrit['NOEQUIPE'], 'DATE'=> $an.'/'.$mois.'/'.$jour));
                $NBEnfantsInscri = count($Enfant);
                $NBrepasEnfant = 0;
                foreach ($Enfant as $UnEnfant) {
                    if ($UnEnfant['REPASSURPLACE']==1)
                    {
                        $NBrepasEnfant++;
                    }
                }
                $prixTotal = 0;
                $prixTotal +=$this->session->AnneeEnCours['TARIFINSCRIPTIONADULTE'] * $NBAdultesInscri; //on affiche les sous qu'ils devront
                $prixTotal +=$this->session->AnneeEnCours['TARIFREPASADULTE'] * $NBrepasAdulte;
                $prixTotal +=$this->session->AnneeEnCours['TARIFINSCRIPTIONENFANT'] * $NBEnfantsInscri;
                $prixTotal +=$this->session->AnneeEnCours['TARIFREPASENFANT'] * $NBrepasEnfant;
                $MontantPaye = $UnInscrit['MONTANTPAYE'];
                $Responsable = $this->ModeleUtilisateur->GetConnexionVisiteur($Utilisateur = array('noparticipant' => $Equipe['NOPAR_RESPONSABLE']));
                if ($MontantPaye < $prixTotal)
                {
                    $Manque = $prixTotal - $MontantPaye;
                    $this->load->library('email');
                    $this->email->from('thomas.choanier.BTS@gmail.com', 'Administrateur RandoTroll');
                    $this->email->to($Responsable['MAIL']); 
                    $this->email->subject('Relance payemant RANDOTROLL');
                    $message = $this->input->post('email');
                    $message .= "\r\nil manque la somme de : ".$Manque." €.\r\nAttention la date de cloture des inscription est le ".$AnneeEnCours['DATECLOTUREINSCRIPTION']."\r\nCordialement, l'équipe RANDOTROLL";
                    $this->email->message($message);	
                    if (!$this->email->send())
                    {
                        $this->email->print_debugger();
                    }
                }
            }
        }
    }
    public function QRcode()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Inscription/DonneeFixe');
        $this->load->library('ciqrcode');
	
        $params['data'] = '';
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH.'test.png';
        $this->ciqrcode->generate($params);
        $this->load->view('Inscription/qrcode');
    }
    public function GestionPaiement()
    {
        $this->load->view('Template/EnTete');
        $this->load->view('Inscription/DonneeFixe');

        $LesEquipesAnneeCourante['LesEquipes'] = $this->ModeleUtilisateur->GetEquipeParAnnee($Utilisateur = array('ANNEE' =>date('Y')));
        $this->load->view('Inscription/GestionPaiement/navigation');
        $this->load->view('Inscription/GestionPaiement/recherche',$LesEquipesAnneeCourante);
        if($this->input->post('submit'))
        {
            $UneEquipe = $this->ModeleUtilisateur->GetEquipeParAnnee($Utilisateur = array('ANNEE' =>date('Y'),'NOEQUIPE' =>$this->input->post('equipe')));
            $this->load->view('Inscription/GestionPaiement/AffichageEquipe', $UneEquipe);
        }
        if($this->input->post('submit2'))
        {
            $this->ModeleUtilisateur->UpdateSinscrire($Utilisateur = array('ANNEE' =>date('Y'),'NOEQUIPE' =>$this->input->post('noequipe'),'MONTANTPAYE'=>$this->input->post('txtPaye'),'MONTANTREMBOURSE' =>$this->input->post('txtRembourse'), 'MODEREGLEMENT'=>$this->input->post('reglement')));
            $UneEquipe = $this->ModeleUtilisateur->GetEquipeParAnnee($Utilisateur = array('ANNEE' =>date('Y'),'NOEQUIPE' =>$this->input->post('noequipe')));
            $this->load->view('Inscription/GestionPaiement/AffichageEquipe', $UneEquipe);
        }
        
    }
    public function Ticket()
    {
        define('FPDF_FONTPATH',$this->config->item('fonts_path'));
        $this->load->library('fpdf');
        $this->load->view('Inscription/ticket');
    }
}
