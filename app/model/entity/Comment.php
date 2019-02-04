<?php

class Comment

{
    private $comment_id;
    private $post_id;
    private $comment_text;

    public function __construct($comment_id, $post_id, $comment_text)
    {
        $this->setComment_id($comment_id);
        $this->setPost_id($post_id);
        $this->setComment_text($comment_text);
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    public function __get($name)
    {
        return isset($this->$name) ? $this->$name : null;
    }
    public function __call($name, $arguments)
    {
       $function = substr($name, 0,3);
       if ($function === 'set') {
           $this->__set(strtolower(substr($name, 3)), $arguments[0]);
           return $this;
       } else if ($function === 'get') {
           return $this->__get(strtolower(substr($name,3)));
       }
       return $this;
    }

    public static function all()
    {
        $commentList = [];
        $db = Db::connect();
        $statement = $db->prepare("select * from comment order by comment_id desc");
        foreach ($statement->fetchAll() as $comment) {
            $commentList[] = new Comment($comment->comment_id, $comment->post_id, $comment->comment_text);
        }
        return $commentList;
    }
    public static function find($comment_id)
    {
        $commentList = [];
        $comment_id = intval($comment_id);
        $db = Db::connect();
        $statement = $db->prepare("select * from comment where post_id = :comment_id");
        $statement->bindValue('comment_id', $comment_id);
        $statement->execute();
        foreach ($statement->fetchAll() as $comment) {
            $commentList[] = new Comment($comment->comment_id, $comment->comment_text, $comment->post_id);
        }
        return $commentList;
    }
}