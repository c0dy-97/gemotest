<?php

namespace App\Entity;

class Service {
    public $id;
    public $biomaterial_id;
    public $localization_id;
    public $transport_id;

    public function __construct($id, $biomaterial_id, $localization_id, $transport_id)
    {
        $this->id = $id;
        $this->biomaterial_id = $biomaterial_id;
        $this->localization_id = $localization_id;
        $this->transport_id = $transport_id;
    }
}
