<?php
require_once "repository.php";

class Service
{
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function selectLogs(string $username, string $type, string $severity, int $pageSize, int $currentPage) {
        if ($type === "all"  && $severity === "all" && $username === "all"){
            return $this->repository->selectAllLogs($pageSize,$currentPage);
        }else if ($type!="all" || $severity!="all" || $username!="all"){
            return $this->repository->selectFilteredLogs($username,$type,$severity,$pageSize,$currentPage);
        }
    }

    public function insertLog(string $user,string $date,string $type, string $severity, string $message)
    {
        return $this->repository->insertLog($user, $date, $type,$severity,$message);
    }

    public function deleteLog(int $logId)
    {
        return $this->repository->deleteLog($logId);
    }
}

?>