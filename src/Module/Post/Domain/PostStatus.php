<?php


namespace Blog\Module\Post\Domain;


class PostStatus
{
    const STATUS_ONLY_SAVE = 1;
    const STATUS_SAVE_PUBLISH = 2;
    private $status;
    private $toPublish;

    public function __construct($status)
    {
        $this->toPublish = true;
        $this->status = $this->checkStatus($status);
    }

    public function checkStatus($status)
    {
        if($status == self::STATUS_ONLY_SAVE || $status == self::STATUS_SAVE_PUBLISH){
            if($status == self::STATUS_ONLY_SAVE){
                $this->toPublish = false;
            }
            return $status;
        }
        throw new \InvalidArgumentException("Status not found");

    }

    /**
     * @return mixed
     */
    public function getToPublish()
    {
        return $this->toPublish;
    }
}