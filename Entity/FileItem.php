<?php

namespace Erp\Bundle\CoreBundle\Entity;

/**
 * FileItem
 */
class FileItem
{
    /** @var string */
    private $id;

    /** @var resource */
    protected $data;

    /** @var string */
    private $mimeType;

    /** @var array */
    private $roles;

    /**
     * Get the value of FileItem
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Data
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of Data
     *
     * @param mixed data
     *
     * @return static
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of Mime Type
     *
     * @return mixed
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set the value of Mime Type
     *
     * @param mixed mimeType
     *
     * @return static
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get roles
     *
     * @return string[]|null
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Get roles
     *
     * @param string[]|null $roles
     *
     * @return static
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Add role
     *
     * @param string $role
     *
     * @return static
     */
    public function addRole(string $role)
    {
        if (!in_array($role, $this->roles)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * Remove role
     *
     * @param string $role
     */
    public function removeRole(string $role)
    {
        unset($this->roles[array_search($role, $this->roles)]);
    }
}
