<?php

namespace App\Controllers;

use App\Abstracts\Controller;
use App\CustomExceptions\InvalidEmailException;
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
                $validatedEmail = UserSanitiser::sanitiseEmail($userEmail['email']);
                foreach ($currentUsers as $user) {
                    if ($user['email'] === $validatedEmail) {
                        $message = 'Successfully signed in';
                        $result = true;
                        $_SESSION['loggedIn'] = true;
                        $_SESSION['user'] = $validatedEmail;
                    } else {
                        $result = $this->userModel->addUser($validatedEmail);
                        $message = 'User added to DB';
                        $_SESSION['loggedIn'] = true;
                        $_SESSION['user'] = $validatedEmail;
                    }
                }
            } else {
                throw new InvalidEmailException('This email is invalid');
            }
        } catch (InvalidEmailException $exception) {
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
