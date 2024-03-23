<?php

namespace App\Http\Controllers;

use App\Repositories\OrganizationRepository;
use App\Interfaces\OrganizationRepositoryInterface;

use App\Models\Organization;
use App\Http\Requests\StoreOrganizationRequest;
use App\Http\Requests\UpdateOrganizationRequest;
// use App\Interfaces\OrganizationRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\OrganizationResource;
use Illuminate\Support\Facades\DB;
// use App\Repository\OrganizationRepository;
// use App\Interfaces\OrganizationRepositoryInterface;

class OrganizationController extends Controller
{
    private OrganizationRepositoryInterface $organizationRepositoryInterface;

    public function __construct(OrganizationRepositoryInterface $organizationRepositoryInterface)
{
    $this->organizationRepositoryInterface = $organizationRepositoryInterface;
}

    /**
     * Display a listing of the resource.
     */
        public function index()
        {
            $data = $this->organizationRepositoryInterface->index();

            return ApiResponseClass::sendResponse(OrganizationResource::collection($data),'',200);
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrganizationRequest $request)
    {
        $details = [
            'name' => $request->name,
            'address' => $request->address,
            // Add new data here
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'estd' => $request->estd,
            'vat_no' => $request->vat_no,
        ];
    
        DB::beginTransaction();
        try {
            $organization = $this->organizationRepositoryInterface->store($details);
    
            DB::commit();
            return ApiResponseClass::sendResponse(new OrganizationResource($organization), 'Organization Create Successful', 201);
    
        } catch (\Exception $ex) {
            return ApiResponseClass::rollback($ex);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $organization = $this->organizationRepositoryInterface->getById($id);

        return ApiResponseClass::sendResponse(new OrganizationResource($organization),'',200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrganizationRequest $request, $id)
    {
        $updateDetails =[
            'name' => $request->name,
            'address' => $request->address,
            // Add new data here
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'type' => $request->type,
            'estd' => $request->estd,
            'vat_no' => $request->vat_no,
        ];
        DB::beginTransaction();
        try{
             $organization = $this->organizationRepositoryInterface->update($updateDetails,$id);

             DB::commit();
             return ApiResponseClass::sendResponse('Organization Update Successful','',201);

        }catch(\Exception $ex){
            return ApiResponseClass::rollback($ex);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
         $this->organizationRepositoryInterface->delete($id);

        return ApiResponseClass::sendResponse('Organization Delete Successful','',204);
    }
}