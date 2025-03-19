<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Commons\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Transforms\User as Transform;

class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $created = 'messages.The server has been created';

    /**
     * {@inheritdoc}
     */
    public $updated = 'messages.The server has been updated';

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        parent::__construct($userService);
    }

    /**
     * @param array<string,mixed> $form
     * @param Request $request
     * @return Transform
     * @SuppressWarnings("PHPMD.UnusedFormalParameters")
     */
    public function converted(array $form, Request $request): Transform
    {
        $source = Transform::from([
            ...$form,
        ]);
        return $source;
    }

     /**
     * @return array<string,string>
     */
    public function rules(): array
    {
        return [
            'user' => 'required|string',
            'password' => 'required|string',
            'email' => 'required|string',
            'active' => 'required|bool'
        ];
    }



}