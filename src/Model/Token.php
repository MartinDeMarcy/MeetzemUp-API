<?php

namespace Model;

/**
 * Token
 */
class Token
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
    private $type;

    /**
     * @var integer
     */
    private $network_id;

    /**
     * @var string
     */
    private $access_token;

    /**
     * @var string
     */
    private $refresh_token;

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
     * @return Token
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
     * Set type
     *
     * @param integer $type
     *
     * @return Token
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set accessToken
     *
     * @param string $accessToken
     *
     * @return Token
     */
    public function setAccessToken($accessToken)
    {
        $this->access_token = $accessToken;
    
        return $this;
    }

    /**
     * Get accessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->access_token;
    }

    /**
     * Set refreshToken
     *
     * @param string $refreshToken
     *
     * @return Token
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refresh_token = $refreshToken;
    
        return $this;
    }

    /**
     * Get refreshToken
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refresh_token;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     *
     * @return Token
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
     * Set networkId
     *
     * @param integer $networkId
     *
     * @return Token
     */
    public function setNetworkId($networkId)
    {
        $this->network_id = $networkId;
    
        return $this;
    }

    /**
     * Get networkId
     *
     * @return integer
     */
    public function getNetworkId()
    {
        return $this->network_id;
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
