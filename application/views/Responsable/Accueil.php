<script type="text/javascript">
  function dernierechance()
    {
          valide = confirm("Voulez vous vraiment supprimer ? :");
          return valide;
    }
  </script>
  <div class='container'>
    <div class="row">
      <div class='col-sm-9' >
        <section>
          <div class="section-inner" style="background-color:#FDBA23;padding:20px;">
            <h2 align='center'>Les membres de l'équipe</h2> <br>
            <h4 align='center'><span class='glyphicon glyphicon-flag'></span> Nom de votre équipe : <b><?php echo $Responsable['NOMEQUIPE'] ?></b></h4>
            <p align='center'>Après avoir terminé de rentrer les membres de l'équipe oublier pas de l'inscrire, pour l'inscrire <a href="#Select-parcours">CLIQUEZ ICI</a></p>
            <p align='center'><span class='glyphicon glyphicon-exclamation-sign'></span> <?php echo $this->session->AnneeEnCours['MAXPAREQUIPE']; ?> personne pourrons composer votre équipe. Vous pouvez dépasser le nombre mais si il y a trop de personne l'administrateur risque de ne pas valider l'inscription</p> <br>

              <input type="hidden" name="num" value="1">
              <table class="table table-Info table-hover">
                  <th>Nom et prénom</th><th>Age</th><th>Repas</th><th>Email</th><th>Téléphone</th><th><?php echo "<a href='".site_url('Responsable')."'><button type='submit' name='ah' class='btn btn-primary'>Ajouter un randonneur</button></a>";?><th>
                    <?php 
                            $date= $Responsable['DATEDENAISSANCE'];
                            $an=substr($date,0,4); 
                            $mois=substr($date,5,2); 
                            $jour=substr($date,8,2);
                            $date = $an.$mois.$jour;
                            $aujourd = date('Y-m-d');
                            $an=substr($aujourd,0,4); 
                            $mois=substr($aujourd,5,2); 
                            $jour=substr($aujourd,8,2);
                            $aujourd = $an.$mois.$jour;
                            //echo $aujourd.'<br>'; // today
                            //echo $date.'<br>'; // naissance
                            $ageAnnee = $aujourd-$date;
                            //echo $ageAnnee.'<br>'; // la différance 
                            $age=substr($ageAnnee,0,2);
                            //echo $age;//age total
                            if ($Responsable['REPASSURPLACE']==1) {
                              $repas = "oui";
                            }
                            else
                            {
                              $repas = 'non';
                            }
                        echo "<tr><td>".$Responsable['NOM']." ".$Responsable['PRENOM']."</td><td>".$age."</td><td>".$repas."</td><td>".$Responsable['MAIL']."</td><td>".$Responsable['TELPORTABLE']."</td>";
                        echo "<td>RESPONSABLE <a href='".site_url('Responsable/MonCompte')."'><button type='submit' name='ah' class='btn btn-success'>Modifier</button></a></td></tr>";
                          ?>
                        
                        <?php foreach ($LesUtilisateur as $UnUtilisateur) 
                        {
                          if (!($UnUtilisateur['NOPARTICIPANT'] == $this->session->numero)) { //ON NE PREND PAS LE RESPONSABLE
                            $date= $UnUtilisateur['DATEDENAISSANCE'];
                            $an=substr($date,0,4); 
                            $mois=substr($date,5,2); 
                            $jour=substr($date,8,2);
                            $date = $an.$mois.$jour;
                            $aujourd = date('Y-m-d');
                            $an=substr($aujourd,0,4); 
                            $mois=substr($aujourd,5,2); 
                            $jour=substr($aujourd,8,2);
                            $aujourd = $an.$mois.$jour;
                            //echo $aujourd.'<br>'; // today
                            //echo $date.'<br>'; // naissance
                            $ageAnnee = $aujourd-$date;
                            //echo $ageAnnee.'<br>'; // la différance 
                            $age=substr($ageAnnee,0,2);
                            //echo $age;//age total
                            if ($UnUtilisateur['REPASSURPLACE']==1) {
                              $repas = "oui";
                            }
                            else
                            {
                              $repas = 'non';
                            }
                          echo "<tr><td>".$UnUtilisateur['NOM']." ".$UnUtilisateur['PRENOM']."</td><td>".$age."</td><td>".$repas."</td><td>".$UnUtilisateur['MAIL']."</td><td>".$UnUtilisateur['TELPORTABLE']."</td><td>";
                          $inscrit = $this->session->inscription;
                            echo "<a href='".site_url('Responsable/modifierRandonneur/'.$UnUtilisateur['NOPARTICIPANT'])."'><button type='submit' name='ah' class='btn btn-success'>Modifier</button></a>
                              <a href=".site_url('Responsable/SupprimerParticipant/'.$UnUtilisateur['NOPARTICIPANT'].'/')."><button type='submit' name='ah' class='btn btn-danger' onclick='return dernierechance()'>Supprimer</button></a></td></tr>";
                          }
                      } ?>
              </table>
          </div>
      </section><br>
      