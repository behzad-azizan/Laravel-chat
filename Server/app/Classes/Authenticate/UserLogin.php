<?php


namespace App\Classes\Authenticate;


use App\Exceptions\InvalidAuthException;
use App\Http\Requests\LoginRequest;
use App\Repositories\User\UserRepository;
use App\Traits\GetInstance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserLogin
 * @package App\Classes\Authenticate
 *
 * @method static self GetInstance
 */
class UserLogin
{
    use GetInstance;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param LoginRequest $request
     * @return $this
     */
    public function setRequest(LoginRequest $request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * Login
     * @return \App\Models\User|bool
     * @throws InvalidAuthException
     */
    public function login()
    {
        $username = $this->request->get('username');
        $password = $this->request->get('password');

        if (! $user = UserRepository::getInstance()->checkUsernameAndPassword($username, $password))
            throw new InvalidAuthException();

        return $user;
    }
}
