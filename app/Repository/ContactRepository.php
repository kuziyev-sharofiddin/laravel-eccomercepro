<?php

namespace App\Repository;
use App\Repository\BaseRepository;
use App\Models\Contact;
class ContactRepository extends BaseRepository
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }
}
