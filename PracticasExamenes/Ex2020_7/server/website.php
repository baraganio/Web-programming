<?php
class Website implements JsonSerializable{

    private $id;
    private $url;
    private $documentsCount;

    public function __construct($id, $url, $documentsCount){
        $this->id=$id;
        $this->url=$url;
        $this->documentsCount=$documentsCount;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getUrl(){
        return $this->url;
    }

    public function setUrl($url){
        $this->url = $url;
    }

    public function getDocumentsCount(){
        return $this->documentsCount;
    }

    public function setDocumentsCount($documentsCount){
        $this->documentsCount = $documentsCount;
    }

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'url' => $this->url,
            'documentscount' => $this->documentsCount
        ];
    }
}
?>