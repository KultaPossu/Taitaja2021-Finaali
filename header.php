<header>
    <div class="main-header">
        <div class="logo">
            <img src="img/opinsys-logo.png" alt="Logo">
        </div>
        <div class="search">
            <input type="text">
            <input type="button" value="Hae">
        </div>
        <div class="contact">
            <p>p. 014 4591624</p>
            <p>Ylistönmäentie 31 B</p>
            <p>40500 Jyväskylä</p>
            <p class="pumpkin">info@opinsys.fi</p>
        </div>
    </div>
    <div class="school-header">
        <div class="form-container">
            <form action="actions/school-select.php">
                <div class="custom-select">
                    <select name="schools" id="school-select">
                        <option value="">Valitse koulu</option>
                        <option value="kettula">Kettula</option>
                        <option value="karhula">Karhula</option>
                        <option value="pupula">Pupula</option>
                    </select>
                </div>
                <input type="submit" value="Hae">
            </form>
            <?php
                if($_SESSION["school"] != null)     echo "<h1>" . ucfirst($_SESSION["school"]) . "</h1>";
            ?>
        </div>
        <div class="nav">

        </div>
    </div>
</header>