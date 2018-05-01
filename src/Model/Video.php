<?php

namespace Model;

/**
 * Video
 */
class Video
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
    private $direct_link;

    /**
     * @var \Model\Video
     */
    private $relative;

    /**
     * @var string
     */
    private $output_primary;

    /**
     * @var string
     */
    private $output_secondary;

    /**
     * @var string
     */
    private $context;

    /**
     * @var string
     */
    private $content;

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
     * @return Video
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
     * @return Video
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
     * Set directLink
     *
     * @param string $directLink
     *
     * @return Video
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
     * Set relative
     *
     * @param \Model\Video $relative
     *
     * @return Video
     */
    public function setRelative(\Model\Video $relative = null)
    {
        $this->relative = $relative;

        return $this;
    }

    /**
     * Get relative
     *
     * @return \Model\Video
     */
    public function getRelative()
    {
        return $this->relative;
    }

    /**
     * Set outputPrimary
     *
     * @param string $outputPrimary
     *
     * @return Video
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
     * @return Video
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
     * Set context
     *
     * @param string $context
     *
     * @return Video
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
     * Set content
     *
     * @param string $content
     *
     * @return Video
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
     * Set isLiked
     *
     * @param boolean $isLiked
     *
     * @return Video
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
     * @return Video
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
                else if ($value instanceof Video && $option == 1)
                    $json->$key = $value->getId();
                else
                   $json->$key = $value;
           }
        }
        return json_encode($json);
    }






}
