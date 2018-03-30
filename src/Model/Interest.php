<?php

namespace Model;

/**
 * Interest
 */
class Interest
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Model\User
     */
    private $user;
    
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $parent;

    /**
     * @var integer
     */
    private $occurence;

    /**
     * @var \DateTime
     */
    private $last_update;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

   /**
     * Set user
     *
     * @param \Model\User $user
     *
     * @return Interest
     */
    public function setUser(\Model\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Model\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Interest
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set parent
     *
     * @param string $parent
     *
     * @return Interest
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set occurence
     *
     * @param integer $occurence
     *
     * @return Interest
     */
    public function setOccurence($occurence)
    {
        $this->occurence = $occurence;
    
        return $this;
    }

    /**
     * Get occurence
     *
     * @return integer
     */
    public function getOccurence()
    {
        return $this->occurence;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     *
     * @return Interest
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->last_update = $lastUpdate;
    
        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
    * Return JSON Object of the entity
    *
    * @return \JSON
    */
    public function toJson($option) {
        $json = new \stdClass();

        foreach ($this as $key => $value) {
            if ($value instanceof User && is_null($option))
                $json->$key = $value->getJson();
            else if ($value instanceof User && $option == 1)
                $json->$key = $value->getId();
            else
               $json->$key = $value;
        }
        return json_encode($json);
    }
}
