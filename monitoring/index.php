<?php 

require_once('connect.php');

$sql = "SELECT visited_on, ROUND(AVG(time_spent) OVER(ORDER BY visited_on ROWS BETWEEN 2 PRECEDING AND CURRENT ROW), 4) as avg_time_spent FROM traffic JOIN users ON users.id = traffic.user_id WHERE users.user_type = 'user'";
$result = $conn->query($sql);
$data = $result->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring</title>
</head>
<body>
    
    <h4>Monitoring</h4>

    <table border=1>
        <thead>
        <tr>
            <th>visited_on</th>
            <th>avg_time_spent</th>
        </tr>
        </thead>
        <tbody>
            </tr>
            <?php foreach($data as $row): ?>
                <tr>
                    <td><?= $row['visited_on']; ?></td>
                    <td><?= $row['avg_time_spent']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>