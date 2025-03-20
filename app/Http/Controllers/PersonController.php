<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Commons\Controller;
use App\Services\PersonService;
use Illuminate\Http\Request;
use App\Transforms\Person as Transform;

class PersonController extends Controller{

     /**
     * {@inheritdoc}
     */
    public $created = 'messages.The person has been created';

    /**
     * {@inheritdoc}
     */
    public $updated = 'messages.The person has been updated';

    /**
     * @param PersonService $personService
     */
    public function __construct(PersonService $personService)
    {
        parent::__construct($personService);
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
            'identification' => 'required|string|unique:persons',
            'names' => 'required|string',
            'surnames' => 'required|string',
            'email' => 'required|email|string|unique:persons',
            'phone' => 'integer|required',
            'active' => 'required|bool'
        ];
    }


}