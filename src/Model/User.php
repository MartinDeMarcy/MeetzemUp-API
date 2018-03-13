<?php

namespace Model;

/**
 * User
 */
class User
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $first_name;

    /**
     * @var string
     */
    private $last_name;

    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $facebook_linked = 0;

    /**
     * @var integer
     */
    private $twitter_linked = 0;

    /**
     * @var integer
     */
    private $pinterest_linked = 0;

    /**
     * @var integer
     */
    private $gmail_linked = 0;

    /**
     * @var integer
     */
    private $instagram_linked = 0;

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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->first_name = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->last_name = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set facebookLinked
     *
     * @param integer $facebookLinked
     *
     * @return User
     */
    public function setFacebookLinked($facebookLinked)
    {
        $this->facebook_linked = $facebookLinked;
    
        return $this;
    }

    /**
     * Get facebookLinked
     *
     * @return integer
     */
    public function getFacebookLinked()
    {
        return $this->facebook_linked;
    }

    /**
     * Set twitterLinked
     *
     * @param integer $twitterLinked
     *
     * @return User
     */
    public function setTwitterLinked($twitterLinked)
    {
        $this->twitter_linked = $twitterLinked;
    
        return $this;
    }

    /**
     * Get twitterLinked
     *
     * @return integer
     */
    public function getTwitterLinked()
    {
        return $this->twitter_linked;
    }

    /**
     * Set pinterestLinked
     *
     * @param integer $pinterestLinked
     *
     * @return User
     */
    public function setPinterestLinked($pinterestLinked)
    {
        $this->pinterest_linked = $pinterestLinked;
    
        return $this;
    }

    /**
     * Get pinterestLinked
     *
     * @return integer
     */
    public function getPinterestLinked()
    {
        return $this->pinterest_linked;
    }

    /**
     * Set gmailLinked
     *
     * @param integer $gmailLinked
     *
     * @return User
     */
    public function setGmailLinked($gmailLinked)
    {
        $this->gmail_linked = $gmailLinked;
    
        return $this;
    }

    /**
     * Get gmailLinked
     *
     * @return integer
     */
    public function getGmailLinked()
    {
        return $this->gmail_linked;
    }

    /**
     * Set instagramLinked
     *
     * @param integer $instagramLinked
     *
     * @return User
     */
    public function setInstagramLinked($instagramLinked)
    {
        $this->instagram_linked = $instagramLinked;
    
        return $this;
    }

    /**
     * Get instagramLinked
     *
     * @return integer
     */
    public function getInstagramLinked()
    {
        return $this->instagram_linked;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     *
     * @return User
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

