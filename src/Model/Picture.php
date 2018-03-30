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
     * @var \Model\User
     */
    private $user;

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
     * @var integer
     */
    private $processed;

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
     * Set processed
     *
     * @param integer $processed
     *
     * @return Picture
     */
    public function setProcessed($processed)
    {
        $this->processed = $processed;
    
        return $this;
    }

    /**
     * Get processed
     *
     * @return integer
     */
    public function getProcessed()
    {
        return $this->processed;
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
