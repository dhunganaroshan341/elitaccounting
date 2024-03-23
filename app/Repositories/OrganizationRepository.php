<?php

namespace App\Repository;
use App\Models\Organization;
use App\Interfaces\OrganizationRepositoryInterface;

class OrganizationRepository  implements OrganizationRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function index(){
        return Organization::all();
    }

    public function getById($id){
       return Organization::findOrFail($id);
    }

    public function store(array $data){
       return Organization::create($data);
    }

    public function update(array $data,$id){
       return Organization::whereId($id)->update($data);
    }
    
    public function delete($id){
       Organization::destroy($id);
    }
    public function __construct()
    {
        //
    }
}
