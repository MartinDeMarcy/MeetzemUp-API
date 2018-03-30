<?php

namespace Model;

/**
 * Text
 */
class Text
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
    private $content;

    /**
     * @var string
     */
    private $context;

    /**
     * @var string
     */
    private $feeling;

    /**
     * @var string
     */
    private $representation;

    /**
     * @var string
     */
    private $classification;

    /**
     * @var integer
     */
    private $relative_id;

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
     * @return Text
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
     * Set content
     *
     * @param string $content
     *
     * @return Text
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
     * @return Text
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
     * Set feeling
     *
     * @param string $feeling
     *
     * @return Text
     */
    public function setFeeling($feeling)
    {
        $this->feeling = $feeling;
    
        return $this;
    }

    /**
     * Get feeling
     *
     * @return string
     */
    public function getFeeling()
    {
        return $this->feeling;
    }

    /**
     * Set representation
     *
     * @param string $representation
     *
     * @return Text
     */
    public function setRepresentation($representation)
    {
        $this->representation = $representation;
    
        return $this;
    }

    /**
     * Get representation
     *
     * @return string
     */
    public function getRepresentation()
    {
        return $this->representation;
    }

    /**
     * Set classification
     *
     * @param string $classification
     *
     * @return Text
     */
    public function setClassification($classification)
    {
        $this->classification = $classification;
    
        return $this;
    }

    /**
     * Get classification
     *
     * @return string
     */
    public function getClassification()
    {
        return $this->classification;
    }

    /**
     * Set relativeId
     *
     * @param integer $relativeId
     *
     * @return Text
     */
    public function setRelativeId($relativeId)
    {
        $this->relative_id = $relativeId;
    
        return $this;
    }

    /**
     * Get relativeId
     *
     * @return integer
     */
    public function getRelativeId()
    {
        return $this->relative_id;
    }

    /**
     * Set processed
     *
     * @param integer $processed
     *
     * @return Text
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
     * @return Text
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
    public function toJson() {
        $json = new \stdClass();

        foreach ($this as $key => $value) {
            if ($value instanceof User)
                $json->$key = $value->getJson();
            else
               $json->$key = $value;
        }
        return json_encode($json);
    }
}
