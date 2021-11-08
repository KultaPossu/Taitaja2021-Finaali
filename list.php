<?php
include "db/conn.php";


$sql = "SELECT `id`, `hostname`, `type`, `manufacturer`, `product` FROM testilaitteet WHERE `school` = '" . $_SESSION["school"] . "'";
$result = mysqli_query($con, $sql);

    //while($row = mysqli_fetch_assoc($result)) {
    //  echo "id: " . $row["id"]. " - Name: " . $row["school"]. " " . $row["hostname"]. "<br>";
    //}
?>

<div class="list-sitecontainer">
    <div class="container-search-graph">
        <div class="search-container">
            <form action="">
                <div class="custom-select">
                    <select name="started" id="started-select">
                        <option value="">Kaikki kannettavat</option>
                        <option value="2021">Ei käynnistetty 2021</option>
                        <option value="2020">Ei käynnistetty 2020</option>
                    </select>
                </div>
                <input type="submit" value="Hae">
            </form>
            <div class="graphs-button-container">
                <p><a href="graphs.php">Graafit</a></p>
            </div>
        </div>
    </div>
    <div class="list-container">
        <table>
            <tr>
                <th>Verkkonimi</th>
                <th>Tyyppi</th>
                <th>Valmistaja</th>
                <th>Malli</th>
                <th>Toiminnot</th>
            </tr>
            <?php
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                        echo "<td>". $row["hostname"] ."</td>";
                        echo "<td>". $row["type"] ."</td>";
                        echo "<td>". $row["manufacturer"] ."</td>";
                        echo "<td>". $row["product"] ."</td>";
                        echo "  <td>
                                    <form action='device.php'>
                                        <input type='text' name='id' value=" . $row["id"] . " style='display: none'>
                                        <input type='submit' value='Muokkaa'>
                                    </form>
                                </td>";
                    echo "</tr>";
                }
            ?>
            
            <!--<tr>
                <td>tietokone matti</td>
                <td>Kannettava</td>
                <td>HP</td>
                <td>Elitebook</td>
                <td><a href="muokkaa.php">Muokkaa</a></td>
            </tr>-->
        </table> 
    </div>
</div>