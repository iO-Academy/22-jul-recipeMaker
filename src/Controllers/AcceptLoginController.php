<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\Models\UserModel;
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
        $this->userModel->addUser($userEmail['email']);

        $data = [
            'success' => false,
            'message' => 'Unexpected Error.',
            'data' => []
        ];
        $statusCode = 400;

        try {
            $currentUsers = $this->userModel->getAllUsers();

            // need to create these classes and functions
            if (UserValidator::validate($userEmail)) {
                $userEmail = UserSanitiser::sanitise($userEmail);
                if (in_array($userEmail['email'], $currentUsers)) {
                    // log user in
                    $message = 'Successfully signed in';
                } else {
                    $result = $this->userModel->addUser($userEmail);
                    // log user in
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
