<?php

namespace App\Services;

use App\Protocol;
use App\Exceptions\ErrorException;
use App\Http\Resources\ProtocolCollection;
use App\Http\Resources\Protocol as ProtocolResource;

class ProtocolService extends BaseService
{
    public function update($data)
    {
        $extern_salesman_id = $data['extern_salesman_id'];
        $organization_id = $data['organization_id'];
        $path = $data['path'];
        $name = $data['name'];

        if ($this->isExternSalesman($data)) {
            return $this->updateExternSalesmanProtocol($extern_salesman_id, $path, $name);
        }

        if ($this->isOrganization($data)) {
            return $this->updateOrganizationProtocol($organization_id, $path, $name);
        }

        return false;
    }

    private function updateExternSalesmanProtocol($extern_salesman_id, $path, $name)
    {
        return Protocol::updateOrCreate(['extern_salesman_id' => $extern_salesman_id], [
            'path' => $path,
            'name' => $name,
            'extern_salesman_id' => $extern_salesman_id,
            'updated_at' => now()
        ]);
    }

    private function updateOrganizationProtocol($organization_id, $path, $name)
    {
        return Protocol::updateOrCreate(['organization_id' => $organization_id], [
            'path' => $path,
            'name' => $name,
            'organization_id' => $organization_id,
            'updated_at' => now()
        ]);
    }


    private function isExternSalesman($data)
    {
        return boolval($data['extern_salesman_id']);
    }

    private function isOrganization($data)
    {
        return boolval($data['organization_id']);
    }
}
