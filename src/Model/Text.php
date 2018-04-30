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
    private $network_id;

    /**
     * @var \DateTime
     */
    private $last_update;

    /**
     * @var \Model\User
     */
    private $user;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $textParent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $textChild;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->textParent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->textChild = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set networkId
     *
     * @param string $networkId
     *
     * @return Text
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
     * Add textParent
     *
     * @param \Model\Text $textParent
     *
     * @return Text
     */
    public function addTextParent(\Model\Text $textParent)
    {
        $this->textParent[] = $textParent;

        return $this;
    }

    /**
     * Remove textParent
     *
     * @param \Model\Text $textParent
     */
    public function removeTextParent(\Model\Text $textParent)
    {
        $this->textParent->removeElement($textParent);
    }

    /**
     * Get textParent
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTextParent()
    {
        return $this->textParent;
    }

    /**
     * Add textChild
     *
     * @param \Model\Text $textChild
     *
     * @return Text
     */
    public function addTextChild(\Model\Text $textChild)
    {
        $this->textChild[] = $textChild;

        return $this;
    }

    /**
     * Remove textChild
     *
     * @param \Model\Text $textChild
     */
    public function removeTextChild(\Model\Text $textChild)
    {
        $this->textChild->removeElement($textChild);
    }

    /**
     * Get textChild
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTextChild()
    {
        return $this->textChild;
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
                else if (strcmp($key, "textParent") == 0) {
                    foreach ($value as $textParent) {
                        if ($textParent)
                            array_push($textArray, $textParent->getId());
                    }
                    $json->$key = json_encode($textArray);
                }
                else if (strcmp($key, "textChild") == 0) {
                    foreach ($value as $textChild) {
                        if ($textChild)
                            array_push($textArray, $textChild->getId());
                    }
                    $json->$key = json_encode($textArray);
                }
                else
                 $json->$key = $value;
         }
     }
     return json_encode($json);
 }

    /**
    * Return JSON Object of the entity
    *
    * @return \JSON
    */
    public function getJson() {
        $json = new \stdClass();

        foreach ($this as $key => $value) {
            if (strcmp($key, "__initializer__") != 0 && strcmp($key, "__cloner__") != 0 && strcmp($key, "__isInitialized__") != 0)
                $json->$key = $value;
        }

        return $json;
    }
}
