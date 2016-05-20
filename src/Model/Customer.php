<?php

namespace Stinder\Model;

use Stidner\Interfaces\ToArrayInterface;

class Customer implements ToArrayInterface
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $phone;

    /**
     * @var string
     */
    protected $orgno;

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getOrgno()
    {
        return $this->orgno;
    }

    /**
     * @param string $orgno
     *
     * @return $this
     */
    public function setOrgno($orgno)
    {
        $this->orgno = $orgno;
        return $this;
    }

    public function toArray()
    {
        $data = [];

        $optionalParameters = [
            'email' => 'email',
            'phone' => 'phone',
            'orgno' => 'orgno',
        ];

        foreach ($optionalParameters as $key => $value) {
            if (!isset($this->$value)) {
                $data[$key] = $this->$value;
            }
        }

        return $data;
    }
}
