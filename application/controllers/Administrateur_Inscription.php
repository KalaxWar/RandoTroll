<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrateur_Inscription extends CI_Controller {
	public function __construct()
   {
     parent::__construct();
     $this->load->view('Template/EnTete');
    }
	public function index()
	{
        $this->load->view('Inscription/DonneeFixe');
        $this->load->library('email');
        $this->email->from('thomas.choanier.BTS@gmail.com', 'Administrateur RandoTroll');
        $this->email->to('thomasdu22490@gmail.com'); 
        $this->email->subject('Relance payemant RANDOTROLL');
        $this->email->message("Bonjour,\r\nNous vous contactons aujourd'hui pour vous signaler que l'inscription de votre équipe à la course n'a pas été validé car il manque une somme de : 10€ \r\n Cordialement, l'équipe RANDOTROLL");	
        if (!$this->email->send()){
            $this->email->print_debugger();
        }
    }
}
