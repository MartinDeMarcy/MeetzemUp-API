<?php

namespace Model;

/**
 * Picture
 */
class Picture
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $network_id;

    /**
     * @var \Model\User
     */
    private $user;

    /**
     * @var string
     */
    private $output_primary;

    /**
     * @var string
     */
    private $output_secondary;

    /**
     * @var \Model\Picture
     */
    private $relative;

    /**
     * @var string
     */
    private $direct_link;

    /**
     * @var string
     */
    private $meta;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $context;

    /**
     * @var boolean
     */
    private $is_liked = false;

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
     * Set networkId
     *
     * @param string $networkId
     *
     * @return Picture
     */
    public function setNetworkId($networkId)
    {
        $this->network_id = $networkId;

        return $this;
    }

    /**
     * Get networkId
     *
     * @return string
     */
    public function getNetworkId()
    {
        return $this->network_id;
    }

    /**
     * Set user
     *
     * @param \Model\User $user
     *
     * @return Picture
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
     * Set outputPrimary
     *
     * @param string $outputPrimary
     *
     * @return Picture
     */
    public function setOutputPrimary($outputPrimary)
    {
        $this->output_primary = $outputPrimary;

        return $this;
    }

    /**
     * Get outputPrimary
     *
     * @return string
     */
    public function getOutputPrimary()
    {
        return $this->output_primary;
    }

    /**
     * Set outputSecondary
     *
     * @param string $outputSecondary
     *
     * @return Picture
     */
    public function setOutputSecondary($outputSecondary)
    {
        $this->output_secondary = $outputSecondary;

        return $this;
    }

    /**
     * Get outputSecondary
     *
     * @return string
     */
    public function getOutputSecondary()
    {
        return $this->output_secondary;
    }

    /**
     * Set relativeId
     *
     * @param \Model\Picture $relativeId
     *
     * @return Picture
     */
    public function setRelative(\Model\Picture $relative = null)
    {
        $this->relative = $relative;

        return $this;
    }

    /**
     * Get relativeId
     *
     * @return \Model\Picture
     */
    public function getRelative()
    {
        return $this->relative;
    }

    /**
     * Set directLink
     *
     * @param string $directLink
     *
     * @return Picture
     */
    public function setDirectLink($directLink)
    {
        $this->direct_link = $directLink;

        return $this;
    }

    /**
     * Get directLink
     *
     * @return string
     */
    public function getDirectLink()
    {
        return $this->direct_link;
    }

    /**
     * Set meta
     *
     * @param string $meta
     *
     * @return Picture
     */
    public function setMeta($meta)
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Get meta
     *
     * @return string
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Picture
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set context
     *
     * @param string $context
     *
     * @return Picture
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

    /**
     * Get context
     *
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Set isLiked
     *
     * @param boolean $isLiked
     *
     * @return Picture
     */
    public function setIsLiked($isLiked)
    {
        $this->is_liked = $isLiked;

        return $this;
    }

    /**
     * Get isLiked
     *
     * @return boolean
     */
    public function getIsLiked()
    {
        return $this->is_liked;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     *
     * @return Picture
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
            $textArray = array();
            if (strcmp($key, "__initializer__") != 0 && strcmp($key, "__cloner__") && strcmp($key, "__isInitialized__")) {
                if ($value instanceof User && is_null($option))
                    $json->$key = $value->getJson();
                else if ($value instanceof User && $option == 1)
                    $json->$key = $value->getId();
                else if ($value instanceof Picture && $option == 1)
                    $json->$key = $value->getId();
                else
                   $json->$key = $value;
           }
        }
        return json_encode($json);
    }
}
