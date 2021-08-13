<?php


namespace App\Repositories\User;


use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UserRepository extends BaseRepository
{
    /**
     * @var RegisterRequest
     */
    private $request;

    /**
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function list(array $params = [])
    {
        $query = User::query();

        return $query;
    }

    public function newUser(RegisterRequest $request)
    {
        $this->request = $request;

        $user = $this->setUser(new User());
        $user->save();

        return $user;
    }

    public function editUser($user, RegisterRequest $request)
    {
        $this->request = $request;

        if (! $user instanceof User)
            $user = $this->getUser($user);

        $user = $this->setUser($user);
        $user->save();

        return $user;
    }

    /**
     * @param $id
     * @return User
     * @throws NotFoundResourceException
     */
    public function getUser($id)
    {
        return User::findOrFail($id);
    }

    /**
     * @param User $user
     * @return User
     */
    protected function setUser(User $user)
    {
        $user->name = $this->request->get('name');
        $user->username = $this->request->get('username');

        if ($this->request->get('password'))
            $user->password = $this->request->get('password');

        if ($this->request->hasFile('avatar'))
            $user->avatar = $this->request->file('avatar')->store('users', 'public');

        return $user;
    }

    /**
     * @param $username
     * @param $password
     * @return bool|User
     */
    public function checkUsernameAndPassword($username, $password)
    {
        $user = User::whereUsername($username)
            ->first();

        if (! $user)
            return false;

        if (! Hash::check($password, $user->password))
            return false;

        return $user;
    }

}
