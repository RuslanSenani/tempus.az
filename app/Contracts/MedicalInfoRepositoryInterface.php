<?php

namespace App\Contracts;

interface MedicalInfoRepositoryInterface
{

    public  function  getAllMedicalInfo();

    public  function  getMedicalInfoById($id);

}
