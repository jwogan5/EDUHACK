<?php

class eduhack_db {
	static protected $dbh = null;

	static public function getInstance() {
		if(self::$dbh == null) {
			self::connect();
		}
		return self::$dbh;
	}

	static public function connect() {
		$dsn = 'mysql:host=localhost;dbname=eduhack';
		$username = 'root';
		$password = '';
		$options = array(
			PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		); 

		self::$dbh = new PDO($dsn, $username, $password, $options);
		return self::$dbh;
	}
}

class Author {
	public $id = null;
	public $name = null;
	public $authid = null;

	public function __construct($info = null) {
		if($info instanceof PDOStatement) {
			$this->popFromPDOStatement($info);
		} else if(is_array($info)) {
			$this->popFromAssocArray($info);
		} else if(is_numeric($info)) {
			$db = eduhack_db::getInstance();
			$this->id = (int)$info;
			$info = $db->prepare("select author_id as id, name, authid from author where author_id = :id;");
			$info->execute(array(':id'=>$this->id));
			$this->popFromPDOStatement($info);
		} else {
			$this->name = $info;
		}
	}
	private function popFromPDOStatement($info) {
		$this->popFromAssocArray($info->fetch(PDO::FETCH_ASSOC));
	}
	private function popFromAssocArray($info) {
		if(isset($info['id'])) $this->id = $info['id'];
		if(isset($info['name'])) $this->name = $info['name'];
		if(isset($info['authid'])) $this->authid = $info['authid'];
	}

	public function save() {
		$db = eduhack_db::getInstance();
		if($this->id == null) {
			$qry = $db->prepare("INSERT INTO author (name, authid) VALUES(:name, :authid);");
			$qry->execute(array(':name'=>$this->name, ':authid'=>$this->authid));
			$this->id = $db->lastInsertId();
		} else {
			$qry = $db->prepare("UPDATE author SET name = :name, authid = :authid WHERE author_id = :id;");
			$qry->execute(array(':id'=>$this->id, ':name'=>$this->name, ':authid'=>$this->authid));
		}
	}
}

class Lesson {
	public $id = null;
    public $subject = null;
    public $title = null;
    public $grade = null;
    public $duration = null;
    public $duration_type = null;
    public $purpose = null;
    public $instruction = null;
    public $materials = null;
    public $assessment = null;
    public $author_id = null;

	public function __construct($info = null) {
		if($info instanceof PDOStatement) {
			$this->popFromPDOStatement($info);
		} else if(is_array($info)) {
			$this->popFromAssocArray($info);
		} else if(is_numeric($info)) {
			$db = eduhack_db::getInstance();
			$this->id = (int)$info;
			$info = $db->prepare("select lesson_id as id, subject, title, grade, duration, duration_type, purpose, instruction, materials, assessment, author_id from lesson where lesson_id = :id;");
			$info->execute(array(':id'=>$this->id));
			$this->popFromPDOStatement($info);
		} else {
			$this->name = $info;
		}
	}
	private function popFromPDOStatement($info) {
		$this->popFromAssocArray($info->fetch(PDO::FETCH_ASSOC));
	}
	private function popFromAssocArray($info) {
		if(isset($info['id'])) $this->id = $info['id'];
		if(isset($info['subject'])) $this->subject = $info['subject'];
		if(isset($info['title'])) $this->title = $info['title'];
		if(isset($info['grade'])) $this->grade = $info['grade'];
		if(isset($info['duration'])) $this->duration = $info['duration'];
		if(isset($info['duration_type'])) $this->duration_type = $info['duration_type'];
		if(isset($info['purpose'])) $this->purpose = $info['purpose'];
		if(isset($info['instruction'])) $this->instruction = $info['instruction'];
		if(isset($info['materials'])) $this->materials = $info['materials'];
		if(isset($info['assessment'])) $this->assessment = $info['assessment'];
		if(isset($info['author_id'])) $this->author_id = $info['author_id'];
	}

	public function save() {
		$db = eduhack_db::getInstance();
		if($this->id == null) {
			$qry = $db->prepare("INSERT INTO lesson (subject, title, grade, duration, duration_type, purpose, instruction, materials, assessment, author_id) VALUES(:subject, :title, :grade, :duration, :duration_type, :purpose, :instruction, :materials, :assessment, :author_id);");
			$qry->execute(array(
				':subject'=>$this->subject,
				':title'=>$this->title,
				':grade'=>$this->grade,
				':duration'=>$this->duration,
				':duration_type'=>$this->duration_type,
				':purpose'=>$this->purpose,
				':instruction'=>$this->instruction,
				':materials'=>$this->materials,
				':assessment'=>$this->assessment,
				':author_id'=>$this->author_id
				));
			$this->id = $db->lastInsertId();
		} else {
			$qry = $db->prepare("UPDATE lesson SET 
				subject = :subject,
				title = :title,
				grade = :grade,
				duration = :duration,
				duration_type = :duration_type,
				purpose = :purpose,
				instruction = :instruction,
				materials = :materials,
				assessment = :assessment,
				author_id = :author_id
				WHERE lesson_id = :id;");
			$qry->execute(array(
				':id'=>$this->id,
				':subject'=>$this->subject,
				':title'=>$this->title,
				':grade'=>$this->grade,
				':duration'=>$this->duration,
				':duration_type'=>$this->duration_type,
				':purpose'=>$this->purpose,
				':instruction'=>$this->instruction,
				':materials'=>$this->materials,
				':assessment'=>$this->assessment,
				':author_id'=>$this->author_id
				));
		}
	}
}

class LessonItem {
	public $id = null;
	public $lesson_id = null;
    public $title = null;
    public $url = null;
    public $lrdocid = null;
    public $notes = null;
    public $orderby = null;

	public function __construct($info = null) {
		if($info instanceof PDOStatement) {
			$this->popFromPDOStatement($info);
		} else if(is_array($info)) {
			$this->popFromAssocArray($info);
		} else if(is_numeric($info)) {
			$db = eduhack_db::getInstance();
			$this->id = (int)$info;
			$info = $db->prepare("select lessonitem_id as id, lesson_id, title, url, lrdocid, notes, orderby from lessonitem where lessonitem_id = :id;");
			$info->execute(array(':id'=>$this->id));
			$this->popFromPDOStatement($info);
		} else {
			$this->name = $info;
		}
	}
	private function popFromPDOStatement($info) {
		$this->popFromAssocArray($info->fetch(PDO::FETCH_ASSOC));
	}
	private function popFromAssocArray($info) {
		if(isset($info['id'])) $this->id = $info['id'];
		if(isset($info['lesson_id'])) $this->lesson_id = $info['lesson_id'];
		if(isset($info['title'])) $this->title = $info['title'];
		if(isset($info['url'])) $this->url = $info['url'];
		if(isset($info['lrdocid'])) $this->lrdoc = $info['lrdocid'];
		if(isset($info['notes'])) $this->notes = $info['notes'];
		if(isset($info['orderby'])) $this->orderby = $info['orderby'];
	}

	public function save() {
		$db = eduhack_db::getInstance();
		if($this->id == null) {
			$qry = $db->prepare("INSERT INTO lessonitem (lesson_id, title, url, lrdocid, notes, orderby) VALUES(:lesson_id, :title, :url, :lrdocid, :notes, :orderby);");
			$qry->execute(array(
				':lesson_id'=>$this->lesson_id,
				':title'=>$this->title,
				':url'=>$this->url,
				':lrdocid'=>$this->lrdocid,
				':notes'=>$this->notes,
				':orderby'=>$this->orderby
				));
			$this->id = $db->lastInsertId();
		} else {
			$qry = $db->prepare("UPDATE lessonitem SET lesson_id = :lesson_id, title = :title, url = :url, lrdocid = :lrdocid, notes = :notes, orderby = :orderby WHERE lessonitem_id = :id;");
			$qry->execute(array(':id'=>$this->id,
				));
		}
	}
}

