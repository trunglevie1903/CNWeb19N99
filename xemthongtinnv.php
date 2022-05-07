<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $link = mysqli_connect("localhost", "root", "", "dulieu") or die('Could not connect.');
    if ($link->connect_error) {
        echo "Connect error: ".$link->error;
    } else {
        $tableName = "NHANVIEN";
        $sqlQuery = 'SHOW COLUMNS FROM '.$tableName;
        $result = $link->query($sqlQuery);
        // if ($result === TRUE) {
        $label = array();
        $i = 0;
        while ($row = $result->fetch_assoc()) {
            $label[$i] = $row['Field'];
            $i++;
        }
        // print_r($label);
        // print_r("<br>");

        $sqlQuery = 'SELECT  FROM '.$tableName;
        for ($idx = 0; $idx < count($label); $idx++) {
            if ($idx + 1 == count($label)) {
                $sqlQuery = substr_replace($sqlQuery, $label[$idx].' ', strlen($sqlQuery) - (strlen($tableName) + 5), 0);
            } else {
                $sqlQuery = substr_replace($sqlQuery, $label[$idx].', ', strlen($sqlQuery) - (strlen($tableName) + 5), 0);
            }
        }
        // print_r($sqlQuery."<br>");
        $result = $link->query($sqlQuery);
        if ($result === FALSE) {
            echo "Error fetching table ".$tableName.": ".$link->error;
        } else {
            echo '<table border="1" width="100%" style="padding: 5px">';
            echo '<caption>Du lieu thong ke bang '.$tableName.'</caption>';
            $str = '<tr></tr>';
            for ($idx = 0; $idx < count($label); $idx++) {
                $str = substr_replace($str, '<th>'.$label[$idx].'</th>', strlen($str) - 5, 0);
            }
            echo $str; 
            while ($row = $result->fetch_array()) {
                $str = '<tr>';
                for ($idx = 0; $idx < count($label); $idx++) {
                    if ($idx == 0) {
                        $str .= '<th><a href="./capnhatnv.php?'.$label[$idx].'='.$row[$label[$idx]].'">'.$row[$label[$idx]].'</a></th>';
                    } else {
                        $str .= '<th>'.$row[$label[$idx]].'</th>';
                    }
                }
                $str .= '</tr>';
                echo $str;
            }
        }
    }
    $link->close();
    ?>
</body>
</html>
