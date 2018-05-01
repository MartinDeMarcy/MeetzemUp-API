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
     * @var \Model\User
     */
    private $mate;

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
     * Set mate
     *
     * @param \Model\User $mate
     *
     * @return Match
     */
    public function setMate(\Model\User $mate = null)
    {
        $this->mate = $mate;

        return $this;
    }

    /**
     * Get mate
     *
     * @return \Model\User
     */
    public function getMate()
    {
        return $this->mate;
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
            if (strcmp($key, "mate") == 0 && $option == 0)
                $json->$key = $value->getJson();
            else if (strcmp($key, "user") == 0 && $option == 0)
                $json->$key = $value->getId();
            else if ($value instanceof User && $option == 1)
                $json->$key = $value->getId();
            else
               $json->$key = $value;
        }
        return json_encode($json);
    }
}
