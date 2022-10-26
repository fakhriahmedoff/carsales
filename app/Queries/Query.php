<?php

namespace App\Queries;

interface Query
{
    public function search($filters = []);

}