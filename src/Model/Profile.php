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
     * @var integer
     */
    private $user_id;

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
    private $last_update = 'CURRENT_TIMESTAMP';


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Profile
     */
    public function setUserId($userId)
    {
        $this->user_id = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->user_id;
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
}

