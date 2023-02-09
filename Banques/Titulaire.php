<?php
        class Titulaire
        {
          private $_nom;
          private $_prenom;
          private $_dateNaissance;
          private $_ville;
          private $_compteBancaires = [];
          
          public function __construct($nom, $prenom, $dateNaissance, $ville) 
          {
            $this->_nom = $nom;
            $this->_prenom = $prenom;
            $this->_dateNaissance = $dateNaissance;
            $this->_ville = $ville;

          }
          public function __toString() 
          {
            return $this->get_nom().", ".$this->get_prenom().', '.$this->get_dateNaissance().", ".$this->get_ville();
          }

          /**
          * Get the value of _nom
          */ 
          public function get_nom()
          {
                return $this->_nom;
          }
          /**
          * Get the value of _prenom
          */ 
          public function get_prenom()
          {
                return $this->_prenom;
          }
          /**
          * Get the value of _dateNaissance
          */ 
          public function get_dateNaissance()
          {
                return $this->_dateNaissance;
          }
          /**
          * Get the value of _ville
          */ 
          public function get_ville()
          {
                return $this->_ville;
          }
        
          /**
          * Set the value of _nom
          *
          * @return  self
          */ 
          public function set_nom($_nom)
          {
                $this->_nom = $_nom;
                return $this;
          }
          /**
          * Set the value of _prenom
          *
          * @return  self
          */ 
          public function set_prenom($_prenom)
          {
            $this->_prenom = $_prenom;
            return $this;
          }
          /**
          * Set the value of _dateNaissance
          *
          * @return  self
          */ 
          public function set_dateNaissance($_dateNaissance)
          {
                $this->_dateNaissance = $_dateNaissance;
                return $this;
          }
          /**
          * Set the value of _ville
          *
          * @return  self
          */ 
          public function set_ville($_ville)
          {
                $this->_ville = $_ville;
                return $this;
          }

          public function ajouterCompteBancaire(CompteBancaire $compteBancaire) 
          {
            $this->_compteBancaires[] = $compteBancaire;
          }          
          public function afficherTitulaire() 
          {
            echo '<table border=1> <th class="h2"> info Titulaire : '.$this->get_nom().", ".$this->get_prenom().'</th>';
            echo '<tr><td> Date de Naissance : '.$this->get_dateNaissance()."<br> Domicilié à : ".$this->get_ville().'</td></tr>'; 
            echo '<th class="h2"> Compte Bancaire : </th></td>';
            foreach ($this->_compteBancaires as $compteBancaire) 
            {
              echo '<tr><td>'.$compteBancaire->__toString().'</td></tr>';
            }
            echo '</table> <br>';
          }

        }
?>