<?php

namespace App\Repositories;

use App\Traits\GetInstance;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaseRepository
{
    use GetInstance;

    protected ConnectionInterface $db;

    public function __construct()
    {
        $this->db = DB::connection();
    }

    /**
     * Set database connection
     * @param string $connection
     * @return $this
     */
    public function setConnection(string $connection)
    {
        $this->db = DB::connection($connection);

        return $this;
    }

    /**
     * Start transaction
     */
    public function beginTransaction()
    {
        $this->db->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public function commit()
    {
        $this->db->commit();
    }

    /**
     * RollBack transaction
     */
    public function rollback()
    {
        $this->db->rollBack();
    }

    /**
     * Check the authenticated user is admin or not
     * @return bool
     */
    public function isAdmin()
    {
        return Auth::guard('admin')->check();
    }
}
