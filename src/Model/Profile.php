<?php

namespace Model;

/**
 * Profile
 */
class Profile
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
    private $leader;

    /**
     * @var string
     */
    private $creative;

    /**
     * @var string
     */
    private $class;

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
     * @return Profile
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
     * Set leader
     *
     * @param string $leader
     *
     * @return Profile
     */
    public function setLeader($leader)
    {
        $this->leader = $leader;
    
        return $this;
    }

    /**
     * Get leader
     *
     * @return string
     */
    public function getLeader()
    {
        return $this->leader;
    }

    /**
     * Set creative
     *
     * @param string $creative
     *
     * @return Profile
     */
    public function setCreative($creative)
    {
        $this->creative = $creative;
    
        return $this;
    }

    /**
     * Get creative
     *
     * @return string
     */
    public function getCreative()
    {
        return $this->creative;
    }

    /**
     * Set class
     *
     * @param string $class
     *
     * @return Profile
     */
    public function setClass($class)
    {
        $this->class = $class;
    
        return $this;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     *
     * @return Profile
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
