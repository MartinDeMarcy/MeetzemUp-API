<?php

namespace Model;

/**
 * Match
 */
class Match
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
     * @var integer
     */
    private $match_id;

    /**
     * @var integer
     */
    private $compatibility;

    /**
     * @var \DateTime
     */
    private $last_update;

    public function toJson() {
        $json = new \stdClass();

        foreach ($this as $key => $value)
            $json->$key = $value;

        return json_encode($json);
    }

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
     * @return Match
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
     * Set matchId
     *
     * @param integer $matchId
     *
     * @return Match
     */
    public function setMatchId($matchId)
    {
        $this->match_id = $matchId;
    
        return $this;
    }

    /**
     * Get matchId
     *
     * @return integer
     */
    public function getMatchId()
    {
        return $this->match_id;
    }

    /**
     * Set compatibility
     *
     * @param integer $compatibility
     *
     * @return Match
     */
    public function setCompatibility($compatibility)
    {
        $this->compatibility = $compatibility;
    
        return $this;
    }

    /**
     * Get compatibility
     *
     * @return integer
     */
    public function getCompatibility()
    {
        return $this->compatibility;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     *
     * @return Match
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
