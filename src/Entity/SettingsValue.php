<?php

namespace App\Entity;

use App\Entity\Traits\TraceabilityCreated;
use App\Entity\Traits\TraceabilityUpdated;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SettingsRepository")
 * @ORM\Table(name="settings_value")
 */
class SettingsValue {

    Use TraceabilityCreated;
    Use TraceabilityUpdated;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Company
     * @ORM\ManyToOne(targetEntity="App\Entity\Settings")
     * @ORM\JoinColumn(name="setting_id", referencedColumnName="id", nullable=true)
     */
    private $setting;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $relationObject;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $relationObjectId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $value;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return SettingsValue
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Company
     */
    public function getSetting(): Company
    {
        return $this->setting;
    }

    /**
     * @param Company $setting
     * @return SettingsValue
     */
    public function setSetting(Company $setting): SettingsValue
    {
        $this->setting = $setting;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelationObject()
    {
        return $this->relationObject;
    }

    /**
     * @param mixed $relationObject
     * @return SettingsValue
     */
    public function setRelationObject($relationObject)
    {
        $this->relationObject = $relationObject;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getRelationObjectId()
    {
        return $this->relationObjectId;
    }

    /**
     * @param mixed $relationObjectId
     * @return SettingsValue
     */
    public function setRelationObjectId($relationObjectId)
    {
        $this->relationObjectId = $relationObjectId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return SettingsValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

}