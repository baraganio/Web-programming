<?php
class Log implements JsonSerializable{

    private $id;
    private $user;
    private $date;
    private $type;
    private $severity;
    private $message;

    public function __construct($id, $user, $date, $type, $severity, $message)
    {
        $this->id=$id;
        $this->user=$user;
        $this->date=$date;
        $this->type=$type;
        $this->severity=$severity;
        $this->message=$message;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->user = $id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type)
    {
        $this->type = $type;
    }

    public function getSeverity()
    {
        return $this->severity;
    }

    public function setSeverity($severity)
    {
        $this->severity = $severity;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'user' => $this->user,
            'date' => $this->date,
            'type' => $this->type,
            'severity' => $this->severity,
            'message' => $this->message,
        ];
    }
}
?>