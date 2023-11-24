<?php
include_once 'db.php';
class Event extends Db
{
    public $totalEvents;
    function __construct()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM events;');
        $stmt->execute();
        $ev = $stmt->fetchAll();
        foreach ($ev as $key => $value) {
            $this->totalEvents++;
        }
    }
    public function create($posted_by, $event_title, $event_description)
    {
        $stmt = $this->connect()->prepare('INSERT INTO events(posted_by, event_title, event_desc) values(?, ?,?);');

        if (!$stmt->execute(array($posted_by, $event_title, $event_description))) {
            $stmt = null;
            header('location: ../views/post.php?error=querystatmentfailed');
            exit();
        }
        header('location: events.php');
    }
    public function read()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM events;');
        $stmt->execute();
        $ev = $stmt->fetchAll();
        foreach ($ev as $key => $value) {
            $this->totalEvents += count($ev[$key]);
        }
        return $ev;
    }
}
