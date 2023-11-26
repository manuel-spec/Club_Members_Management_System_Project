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
    public function readOne($id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM events WHERE id = ?;');
        $stmt->execute(array($id));
        $ev = $stmt->fetch();

        return $ev;
    }
    public function updateOne($id, $title, $desc)
    {
        $stmt = $this->connect()->prepare("UPDATE events SET event_title = ?, event_desc=? WHERE id = ?;");

        if (!$stmt->execute(array($title, $desc, $id))) {
            $stmt = null;
            header('location: update.php?error=querystatmentfailed');
            exit();
        } else {
            header("location: events.php");
        }
    }
    public function deleteOne($id)
    {
        $stmt = $this->connect()->prepare("DELETE FROM events WHERE id = ?;");

        if (!$stmt->execute(array($id))) {
            $stmt = null;
            header('location: events.php?error=querystatmentfailed');
            exit();
        }
    }
}
