<?php


namespace App\Repository\Filter;


class UserFilter
{
    /*
     * var boolean
     */
    private $isActive;

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     * @return UserFilter
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }
}