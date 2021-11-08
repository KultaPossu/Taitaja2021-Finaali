<?php
session_start();

include "db/conn.php";

$sql = "SELECT `battery.capacity`, count(*) FROM laitteet WHERE `school` = '" . $_SESSION["school"] . "' group by `battery.capacity`";
$resultBattery = mysqli_query($con, $sql);

$sql = "SELECT `release`, count(*) FROM laitteet WHERE `school` = '" . $_SESSION["school"] . "' group by `release`";
$resultOs = mysqli_query($con, $sql);

$batteryChartData = array();
$osChartData = array();

while($row = mysqli_fetch_assoc($resultBattery)) {
    array_push($batteryChartData, array("x" => (int)substr($row["battery.capacity"], 0, -1), "y" => $row["count(*)"]));
}

while($row = mysqli_fetch_assoc($resultOs)) {
    array_push($osChartData, array("label" => str_replace(array('\\'), ' ', $row["release"]), "y" => $row["count(*)"]));
}
?>

<html>
    <head>
        <?php
            include "head.php";
        ?>
        <script>
        window.addEventListener('load', function () {
        //window.onload = function () {
        
        var batteryChart = new CanvasJS.Chart("batteryChart", {
            animationEnabled: false,
            exportEnabled: false,
            theme: "light1",
            title:{
                text: "Akkujen kunto"
            },
            axisY:{
                suffix: "Kpl",
            },
            axisX:{
                includeZero: false,
                suffix: "%",
                title: "Prosentit [%]"
            },
            data: [{
                type: "column",
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                xValueFormatString: "#,##0\"%\"",
                yValueFormatString: "#,##0\"Kpl\"",
                dataPoints: <?php echo json_encode($batteryChartData, JSON_NUMERIC_CHECK); ?>
            }]
        });

        var osChart = new CanvasJS.Chart("osChart", {
            animationEnabled: false,
            exportEnabled: false,
            theme: "light1",
            title:{
                text: "Käyttöjärjestelmät"
            },
            data: [{
                type: "pie",
                indexLabelFontColor: "#5A5757",
                indexLabelPlacement: "outside",
                dataPoints: <?php echo json_encode($osChartData, JSON_NUMERIC_CHECK); ?>
            }]
        });

        
        osChart.render();
        batteryChart.render();
        })
        </script>
    </head>
    <body>
        <div class="graphs-container">
            <div id="batteryChart" class="battery-chart" style=""></div>
            <div id="osChart" class="battery-chart" style=""></div>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        </div>
        <div class="list-sitecontainer">
            <form action="actions/year-select.php">
                <select name="year" id="started-select">
                    <option value="">Kaikki kannettavat</option>
                    <option value="2021">Ei käynnistetty 2021</option>
                    <option value="2020">Ei käynnistetty 2020</option>
                </select>
                <input type="submit" value="Hae">
            </form>
            <?php
            $sql = "SELECT `id`, `hostname`, `type`, `manufacturer`, `product`, FROM_UNIXTIME(`timestamp` , '%Y') AS `timestamp` FROM laitteet WHERE `school` = '" . $_SESSION["school"] . "'";
            $result = mysqli_query($con, $sql);

            $tableString = "";
            $counted = 0;
            while($row = mysqli_fetch_assoc($result)) {
                if($row['timestamp'] != $_SESSION["year"]) {
                    $counted++;
                    $tableString .= "<tr><td>". $row["hostname"] ."</td><td>". $row["type"] ."</td><td>". $row["manufacturer"] ."</td><td>". $row["product"] ."</td>";
                }
            }
            echo "<div class='deviceAmount'>Laitteita " . $counted . "kpl</div>";
            ?>
            <div class="list-container">
                <table>
                    <tr>
                        <th>Verkkonimi</th>
                        <th>Tyyppi</th>
                        <th>Valmistaja</th>
                        <th>Malli</th>
                    </tr>
                    <?php echo $tableString; ?>
                </table> 
            </div>
        </div>
    </body>
</html>