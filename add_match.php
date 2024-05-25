<?php
include_once 'Database.php';
include_once 'FootballMatch.php';

$database = new Database();
$db = $database->getConnection();

$match = new FootballMatch($db);

$data = json_decode(file_get_contents("php://input"));

$match->team_a_id = $data->team_a_id;
$match->team_b_id = $data->team_b_id;
$match->team_a_goals = $data->team_a_goals;
$match->team_b_goals = $data->team_b_goals;
$match->match_date = $data->match_date;

if ($match->create()) {
    echo json_encode(array("message" => "Match was added."));
} else {
    echo json_encode(array("message" => "Unable to add match."));
}
?>
