<?php

namespace Erp\Bundle\CoreBundle\Entity;

/**
 * FileItem
 */
class TempFileItem
{
    /** @var string */
    private $uuid;

    /** @var DateTimeImmutable */
    private $tstmp;

    /** @var resource */
    private $data;

    /** @var string */
    private $mimeType;

    /**
     * Get the value of FileItem
     *
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set the value of FileItem
     *
     * @param mixed uuid
     *
     * @return self
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
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
     * @return self
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
     * @return self
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }


    /**
     * Get the value of Tstmp
     *
     * @return mixed
     */
    public function getTstmp()
    {
        return $this->tstmp;
    }

    /**
     * Set the value of Tstmp
     *
     * @param mixed tstmp
     *
     * @return static
     */
    public function setTstmp($tstmp)
    {
        $this->tstmp = $tstmp;

        return $this;
    }

}
