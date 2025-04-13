<?php
namespace App\Http\Controllers\Api\V1\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use App\Models\Location;
use App\Http\Requests\Api\UserAddressRequest;
use App\Http\Resources\Api\User\UserAddressResource;
use App\Http\Traits\ApiResponses;
use App\Http\Resources\Api\User\LocationResource;

class UserAddressController extends Controller
{
    use ApiResponses;
    public function index(Request $request)
    {
        $userAddresses = UserAddress::where('user_id', auth('api')->user()->id)->paginate(10);
        return UserAddressResource::collection($userAddresses);
    }
    public function store(UserAddressRequest $request)
    {
        $address = auth()->user()->addresses()->create($request->validated());
        $userAddress = new UserAddressResource($address);
        return $this->createdResponse($userAddress,__('api.Address added successfully'));
    }
    public function show(UserAddress $userAddress)
    {
        if ($userAddress->user_id !== auth('api')->user()->id) {
            return $this->forbiddenResponse(__('api.Unauthorized'));
        }
        $userData = new UserAddressResource($userAddress);
        return $this->successResponse($userData,__('api.get data successfully'));
    }
    public function update(UserAddressRequest $request, UserAddress $userAddress)
    {
        if ($userAddress->user_id !== auth('api')->user()->id) {
            return $this->forbiddenResponse(__('api.Unauthorized'));
        }

        $userAddress->update($request->validated());
        $userData = new UserAddressResource($userAddress);
        return $this->successResponse($userData,__('api.Address updated successfully'));
    }
    public function destroy(UserAddress $userAddress)
    {
        if ($userAddress->user_id !== auth('api')->user()->id) {
            return $this->forbiddenResponse(__('api.Unauthorized'));
        }

        $userAddress->delete();
        return $this->successResponse('done',__('api.Address deleted successfully'));
    }


    public function getGovernorates()
    {
        $governorates = Location::where('type','governorate')->whereNull('parent_id')->get();
        $locations = LocationResource::collection($governorates);
        return $this->successResponse($locations,__('api.get governorates'));
    }

    public function getCities($governorate_id)
    {
        $cities= Location::where('parent_id', $governorate_id)->where('type', 'city')->get();
        $locations = LocationResource::collection($cities);
        return $this->successResponse($locations,__('api.get cities'));

    }
    public function getDistricts($city_id)
    {
        $districts= Location::where('parent_id', $city_id)->where('type', 'district')->get();
        $locations = LocationResource::collection($districts);
        return $this->successResponse($locations,__('api.get districts'));
    }
}
