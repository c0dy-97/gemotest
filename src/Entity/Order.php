<?php

namespace App\Entity;

class Order {
    public $ext_num;
    public $order_num;
    public $contractor;
    public $hash;
    public $comment;
    public $services;
    public $patient;

    public function __construct($ext_num, $contractor, $hash, $comment, $services, $patient, $order_num = '')
    {
        $this->ext_num = $ext_num;
        $this->order_num = $order_num;
        $this->contractor = $contractor;
        $this->hash = $hash;
        $this->comment = $comment;
        $this->services = $services;
        $this->patient = $patient;
    }

    public function getExt_num()
    {
        return $this->ext_num;
    }

    public function setExt_num($ext_num)
    {
        $this->ext_num = $ext_num;

        return $this;
    }

    public function getOrder_num()
    {
        return $this->order_num;
    }

    public function setOrder_num($order_num)
    {
        $this->order_num = $order_num;

        return $this;
    }

    public function getContractor()
    {
        return $this->contractor;
    }

    public function setContractor($contractor)
    {
        $this->contractor = $contractor;

        return $this;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    public function getServices()
    {
        return $this->services;
    }

    public function setServices($services)
    {
        $this->services = $services;

        return $this;
    }

    public function getPatient()
    {
        return $this->patient;
    }

    public function setPatient($patient)
    {
        $this->patient = $patient;

        return $this;
    }
}
