<?php
namespace App\Http\Controllers\API;

use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\User\UserCreateRequest;
use App\Transformers\UserTransformer;
use App\Http\Controllers\Controller;;
use Spatie\Fractal\Fractal;
use Validator;
use Hash;

class UsersController extends Controller
{
    private $userService;
    protected $transformer = UserTransformer::class;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $result = $this->userService->getByPaginate();
        $result['data'] = Fractal::create( $result['data'] , new UserTransformer())->toArray();
        return response()->json($result, $result['http_code']);
    }
     public function getAll(){
        $result = $this->userService->getAll();
        $result['data'] = Fractal::create( $result['data'] , new UserTransformer())->toArray();
        return response()->json($result, $result['http_code']);
     }
     public function show($id){
         $result = $this->userService->getById($id);
         $result['data'] = Fractal::create( $result['data'] , new UserTransformer())->toArray();
         return response()->json($result, $result['http_code']);
     }
     public  function store(UserCreateRequest $userCreateRequest){
        $result = $this->userService->insert($userCreateRequest);
//        $result['data'] = Fractal::create( $result['data'] , new UserTransformer())->toArray();
        return response()->json($result, $result['http_code']);
     }
     public function destroy($id){
         $result = $this->userService->delete($id);
         $result['data'] = Fractal::create( $result['data'] , new UserTransformer())->toArray();
         return response()->json($result, $result['http_code']);
     }




}
