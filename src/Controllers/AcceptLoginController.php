<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Models\UserModel;
use App\Sanitisers\UserSanitiser;
use App\Validators\UserValidator;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class AcceptLoginController extends Controller
{
    private $userModel;

    public function __construct(UserModel $userModel)
    {
        $this->userModel = $userModel;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $userEmail = $request->getParsedBody();

        $data = [
            'success' => false,
            'message' => 'Unexpected Error.',
            'data' => []
        ];
        $statusCode = 400;

        try {
            $currentUsers = $this->userModel->getAllUsers();

            if (UserValidator::validateEmail($userEmail['email'])) {
                $userEmail = UserSanitiser::sanitiseEmail($userEmail['email']);
                if (in_array($userEmail['email'], $currentUsers)) {
                    $message = 'Successfully signed in';
                    $result = true;
                } else {
                    $result = $this->userModel->addUser($userEmail);
                    $message = 'User added to DB';
                }
            }
        } catch (\Exception $exception) {
            $data['message'] = $exception->getMessage();
        }

        if (isset($result) && $result) {
            $data = [
                'success' => true,
                'message' => $message,
                'data' => []
            ];
            $statusCode = 200;
        }

        return $this->respondWithJson($response, $data, $statusCode);
    }
}
