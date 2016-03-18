<?php

class Disque extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;


    /**
     *
     * @var string
     */
    protected $nom;

    /**
     *
     * @var integer
     */
    protected $idUtilisateur;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    /**
     * Method to set the value of field nom
     *
     * @param string $nom
     * @return $this
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Method to set the value of field idUtilisateur
     *
     * @param integer $idUtilisateur
     * @return $this
     */
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Returns the value of field idUtilisateur
     *
     * @return integer
     */
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
    	// TODO 4.3 recherche des services avec hasManyToMany
        $this->hasManyToMany('id', 'DisqueService', 'idDisque', 'idService', 'Service', 'id', array('alias' => 'Services'));
        $this->hasMany('id', 'DisqueTarif', 'idDisque', array('alias' => 'DisqueTarifs'));
        $this->hasMany('id', 'Historique', 'idDisque', array('alias' => 'Historiques'));
        $this->belongsTo('idUtilisateur', 'Utilisateur', 'id', array('alias' => 'Utilisateur'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'disque';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Disque[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Disque
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
	public function __toString(){
		return $this->nom;
	}
}
