<?php
class FootballMatch {
    private $conn;
    private $table_name = "matches";

    public $id;
    public $team_a_id;
    public $team_b_id;
    public $team_a_goals;
    public $team_b_goals;
    public $match_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        $query = "INSERT INTO " . $this->table_name . " SET team_a_id=:team_a_id, team_b_id=:team_b_id, team_a_goals=:team_a_goals, team_b_goals=:team_b_goals, match_date=:match_date";

        $stmt = $this->conn->prepare($query);

        $this->team_a_id = htmlspecialchars(strip_tags($this->team_a_id));
        $this->team_b_id = htmlspecialchars(strip_tags($this->team_b_id));
        $this->team_a_goals = htmlspecialchars(strip_tags($this->team_a_goals));
        $this->team_b_goals = htmlspecialchars(strip_tags($this->team_b_goals));
        $this->match_date = htmlspecialchars(strip_tags($this->match_date));

        $stmt->bindParam(":team_a_id", $this->team_a_id);
        $stmt->bindParam(":team_b_id", $this->team_b_id);
        $stmt->bindParam(":team_a_goals", $this->team_a_goals);
        $stmt->bindParam(":team_b_goals", $this->team_b_goals);
        $stmt->bindParam(":match_date", $this->match_date);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
