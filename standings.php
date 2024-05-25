<?php
include_once 'Database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT t.name, s.points, s.goals FROM standings s JOIN teams t ON s.team_id = t.id ORDER BY s.points DESC, s.goals DESC";

$stmt = $db->prepare($query);
$stmt->execute();

$num = $stmt->rowCount();

if ($num > 0) {
    $standings_arr = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $standings_item = array(
            "name" => $name,
            "points" => $points,
            "goals" => $goals
        );

        array_push($standings_arr, $standings_item);
    }

    echo '<!DOCTYPE html>
    <html lang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Team Standings</title>
    </head>
    
    <body>
        <h2>Team Standings</h2>
        <table border="1">
            <tr>
                <th>Team Name</th>
                <th>Points</th>
                <th>Goals</th>
            </tr>';

    foreach ($standings_arr as $standings_item) {
        echo '<tr>';
        echo '<td>' . $standings_item['name'] . '</td>';
        echo '<td>' . $standings_item['points'] . '</td>';
        echo '<td>' . $standings_item['goals'] . '</td>';
        echo '</tr>';
    }

    echo '</table>
    </body>
    
    </html>';
} else {
    echo json_encode(array("message" => "No standings found."));
}
