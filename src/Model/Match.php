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
     * @var \Model\User
     */
    private $user;
    
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
     * @return Match
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
