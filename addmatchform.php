<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Match</title>
</head>

<body>
    <h2>Add Match</h2>
    <form id="matchForm">
        <label for="team_a_id">Team A ID:</label>
        <input type="text" id="team_a_id" name="team_a_id"><br><br>

        <label for="team_b_id">Team B ID:</label>
        <input type="text" id="team_b_id" name="team_b_id"><br><br>

        <label for="team_a_goals">Team A Goals:</label>
        <input type="text" id="team_a_goals" name="team_a_goals"><br><br>

        <label for="team_b_goals">Team B Goals:</label>
        <input type="text" id="team_b_goals" name="team_b_goals"><br><br>

        <label for="match_date">Match Date:</label>
        <input type="text" id="match_date" name="match_date"><br><br>

        <button type="button" onclick="addMatch()">Add Match</button>
    </form>

    <script>
        function addMatch() {
            var formData = {
                team_a_id: document.getElementById("team_a_id").value,
                team_b_id: document.getElementById("team_b_id").value,
                team_a_goals: document.getElementById("team_a_goals").value,
                team_b_goals: document.getElementById("team_b_goals").value,
                match_date: document.getElementById("match_date").value
            };

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_match.php", true);
            xhr.setRequestHeader("Content-Type", "application/json");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        alert(xhr.responseText);
                        // Handle success response
                    } else {
                        alert('Error: ' + xhr.status);
                        // Handle error response
                    }
                }
            };

            xhr.send(JSON.stringify(formData));
        }
    </script>
</body>

</html>