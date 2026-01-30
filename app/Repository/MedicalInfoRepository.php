<?php

namespace App\Repository;

use App\Contracts\MedicalInfoRepositoryInterface;
use App\Models\MedicalInfo;


class MedicalInfoRepository implements MedicalInfoRepositoryInterface
{

    private MedicalInfo $medicalInfo;

    public function __construct(MedicalInfo $medicalInfo)
    {
        $this->medicalInfo = $medicalInfo;
    }

    public function getAllMedicalInfo()
    {
        return $this->medicalInfo->newQuery()->get();
    }

    public function getMedicalInfoById($id)
    {
        return $this->medicalInfo->newQuery()->findOrFail($id);
    }
}
