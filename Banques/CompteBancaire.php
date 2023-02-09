<?php
  class CompteBancaire
  {
    private $_libelle;
    private $_soldeInitial = 0;
    private $_soldeActuel = 0;
    private $_deviseMonetaire;
    private $_titulaire;

    public function __construct($libelle, $deviseMonetaire, $titulaire) 
    {
      $this->_libelle = $libelle;
      $this->_deviseMonetaire = $deviseMonetaire;
      $this->_titulaire = $titulaire;
    }
    public function __toString() 
    {
      return $this->get_libelle().' : <br> Solde : '.$this->get_soldeActuel()." ".$this->get_deviseMonetaire().'<br>'.$this->get_titulaire();
    }

    /**
    * Get the value of _libelle
    */ 
    public function get_libelle()
    {
      return $this->_libelle;
    }
    /**
    * Get the value of _soldeActuel
    */ 
    public function get_soldeActuel()
    {
      return $this->_soldeActuel;
    }
    /**
    * Get the value of _deviseMonetaire
    */ 
    public function get_deviseMonetaire()
    {
      return $this->_deviseMonetaire;
    }
    /**
    * Get the value of _titulaire
    */ 
    public function get_titulaire()
    {
      return $this->_titulaire;
    }
          
    /**
    * Set the value of _libelle
    *
    * @return  self
    */ 
    public function set_libelle($libelle)
    {
      $this->_libelle = $libelle;
      return $this;
    }
    /**
    * Set the value of _soldeInitial
    *
    * @return  self
    */ 
    /**
    * Set the value of _soldeActuel
    *
    * @return  self
    */ 
    public function set_soldeActuel($soldeActuel)
    {
      $this->_soldeActuel = $soldeActuel;
      return $this;
    }
    /**
    * Set the value of _deviseMonetaire
    *
    * @return  self
    */ 
    public function set_deviseMonetaire($deviseMonetaire)
    {
      $this->_deviseMonetaire = $deviseMonetaire;
      return $this;
    }
    /**
    * Set the value of _titulaire
    *
    * @return  self
    */ 
    public function set_titulaire($titulaire)
    {
      $this->_titulaire = $titulaire;
      return $this;
    }

    function crediterCompteBancaire($montantTransaction)
    {
      $this->_soldeActuel = $this->_soldeActuel + $montantTransaction;
      echo "Le compte ".$this->_libelle." a été crédité de ".$montantTransaction." ".$this->_deviseMonetaire.'<br><br>';
    }
    function debiterCompteBancaire($montantTransaction)
    {
      if($montantTransaction < $this->_soldeActuel)
      {
        $this->_soldeActuel -= $montantTransaction;
        echo "Le compte ".$this->_libelle." a été débité de ".$montantTransaction." ".$this->_deviseMonetaire.'<br><br>';
      }
      else
      {
      echo "Le compte ".$this->_libelle." ne possède pas la somme de ".$montantTransaction." ".$this->_deviseMonetaire.'<br>'.
      "Solde Actuel : ".$this->_soldeActuel." ".$this->_deviseMonetaire.'<br>';
      }
    }
    function virementCompteBancaire(CompteBancaire $compteDebite, $montantTransaction)
    {
      $compteDebite->debiterCompteBancaire($montantTransaction);
      $this->crediterCompteBancaire($montantTransaction);
    }
    public function afficherCompteBancaire() 
    {
      echo '<table border=1> <th class="h2"> info '.$this->_libelle.'</th>
            <tr><td> Solde Actuel : '.$this->_soldeActuel." ".$this->_deviseMonetaire.'</td></tr>'; 
      echo '<th class="h2"> Titulaire : </th>';
      echo '<tr><td>'.$this->_titulaire->__toString().'</td></tr>';
      echo '</table> <br>';
    }
  }
?>