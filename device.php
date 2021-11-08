<?php
include "db/conn.php";
session_start();
?>

<html>
    <head>
        <?php
            include "head.php";
        ?>
    </head>
    <body>
        <div class="device-container">
            <div class="header">
                <h1>tietokone matti</h1>
            </div>
            <div class="pc-info">
                <h1>Tietokoneen tiedot</h1>
                <table>
                    <?php
                    $sql = "SELECT * FROM testilaitteet WHERE `id` = '" . $_GET["id"] . "'";
                    $result = mysqli_query($con, $sql);
                    
                    $row = mysqli_fetch_assoc($result);
                    echo "
                    <tr>
                        <td><b>DN</b></td>
                        <td>?</td>
                    </tr>
                    <tr>
                        <td><b>Laitteen valmistaja</b></td>
                        <td>" . $row["manufacturer"] . "</td>
                    </tr>
                    <tr>
                        <td><b>Laitteen malli</b></td>
                        <td>" . $row["product"] . "</td>
                    </tr>
                    <tr>
                        <td><b>Sarjanumero</b></td>
                        <td>" . $row["serial"] . "</td>
                    </tr>
                    <tr>
                        <td><b>MAC-osoite</b></td>
                        <td>" . $row["mac/0"] . "</td>
                    </tr>
                    <tr>
                        <td><b>Laitteen ensisijainen käyttäjä</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Käynnistymistapa</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Tulostimen laiteosoite</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Tulostimen ajuritiedosto</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Oletustulostin</b></td>
                        <td></td>
                    </tr>
                    ";
                    ?>
                </table> 
            </div>

            <div class="kernel-info">
                <h1>Levykuva ja kernel-asetukset</h1>
                <table>
                    <?php
                    $sql = "SELECT * FROM testilaitteet WHERE `id` = '" . $_GET["id"] . "'";
                    $result = mysqli_query($con, $sql);
                    
                    $row = mysqli_fetch_assoc($result);
                    echo "
                    <tr>
                        <td><b>Käytössä oleva työpöytäkuva</b></td>
                        <td>". $row["image"] ."</td>
                    </tr>
                    <tr>
                        <td><b>Työpöytäkuva</b></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><b>Levykuvasarjan lähdeosoite</b></td>
                        <td>HP EliteBook 840 G3</td>
                    </tr>
                    <tr>
                        <td><b>Kernel-versio</b></td>
                        <td>". $row["kernel_version"] ."</td>
                    </tr>
                    <tr>
                        <td><b>Kernel-parametrit</b></td>
                        <td>". $row['kernel_args'] ."</td>
                    </tr>
                    <tr>
                        <td><b>Sertifikaatit</b></td>
                        <td>Voimassa</td>
                    </tr>
                    ";
                    ?>
                </table> 
            </div>
        </div>
    </body>
</html>
