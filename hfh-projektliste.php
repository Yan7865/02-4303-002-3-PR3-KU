<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
	<script src="scripts.js" defer></script>
</head>

<body>
    <div class="projektdarstellung">
        <div class="kontextmenu">
            <div class="button">
                <div class="buttonicon">+</div>
                <button type="button" onclick="showNeuerProjekt()">Neues Projekt erstellen</button>
            </div>
            <div class="button">
                <div class="buttonicon">>></div>
                <button type="button" onclick="showFilter()">Liste filtern</button>
            </div>
        </div>
        <div class="projektliste">
            <?php
                $server = "localhost";
                $user = "root";
                $password = "";
                $database = "hfh-pr";

                $mysqli = new mysqli($server, $user, $password, $database);

                if ($mysqli->connect_error) {
                    die("Verbindungsfehler: " . $mysqli->connect_error);
                }

                $sql = "SELECT * FROM projekt";

                $result = $mysqli->query($sql);

                if ($result->num_rows > 0) {
                    echo "<div class=\"tablebody\">";
                    echo "<div class=\"tableheader tablerow\">";

                    $columnnames = array_keys($result->fetch_assoc());
                    foreach ($columnnames as $columnname) {
                        echo "<div class=\"tableheadercell tablecell\">" . $columnname . "</div>";
                    }

                    echo "<div class=\"tableheadercell tablecell\"></div></div>";

                    $result->data_seek(0);

                    while ($row = $result->fetch_assoc()) {
                        echo "<div class=\"tablerow\">";
                        foreach ($row as $value) {
                            echo "<div class=\"tablecell\">" . $value . "</div>";
                        }
                        echo "<div class=\"tablecell\"><button class=\"eintragAktualiserButton\" onclick=\"editRow(" . $row['id'] . ")\">Bearbeiten</button></div></div>";
                    }

                    echo "</div>";
                } else {
                    echo "<p>Keine Ergebnisse gefunden.</p>";
                }

                $mysqli->close();
            
            ?>
        </div>
    </div>

    <div class="neuerProjektContainer hidden" id="neuProjekt">
        <h1 class="headLineNewProject">Neues Projekt erstellen</h1>
        <form class="neuerProjekt" action="projektspeichern.php" method="post">
            <fieldset class="topGroup">
                <fieldset class="leftGroup">
                    <label for="projektideingabe">ID*:</label>
                    <input type="text" id="projektideingabe" name="projektideingabe" required><br>
                    <label for="projektnameeingabe">Projektname*:</label>
                    <input type="text" id="projektnameeingabe" name="projektnameeingabe" required><br>
                    <label for="starteingabe">Startdatum*:</label>
                    <input type="date" id="starteingabe" name="starteingabe" required><br>
                    <label for="endeeingabe">Enddatum:</label>
                    <input type="date" id="endeeingabe" name="endeeingabe"><br>
                    <label for="projektverantwortlicheingabe">Verantwortlich:</label>
                    <input type="text" id="projektverantwortlicheingabe" name="projektverantwortlicheingabe"><br>
                </fieldset>
                <fieldset class="rightGroup">
                    <label for="beschreibungeingabe">Beschreibung:</label>
                    <textarea name="Beschreibung" id="beschreibungeingabe"></textarea>
                </fieldset>
            </fieldset>
            <fieldset class="botGroup">
                <input type="submit" value="Speichern">
                <button type="button" class="cancel" onclick="hideNeuerProjekt()">Abbrechen</button>
            </fieldset>
        </form>
    </div>

	<div class="neuerProjektContainer hidden" id="editProjektFormular">
		<h1 class="headLineNewProject">Projekt bearbeiten</h1>
		<form id="editProjektForm" class="neuerProjekt">
			<fieldset class="topGroup">
				<fieldset class="leftGroup">
					<input type="hidden" id="editProjektId">
					<label for="editProjektName">Projektname*:</label>
					<input type="text" id="editProjektName" required><br>
					<label for="editStartDatum">Startdatum*:</label>
					<input type="date" id="editStartDatum" required><br>
					<label for="editEndDatum">Enddatum:</label>
					<input type="date" id="editEndDatum"><br>
					<label for="editVerantwortlich">Verantwortlich:</label>
					<input type="text" id="editVerantwortlich"><br>
				</fieldset>
				<fieldset class="rightGroup">
					<label for="editBeschreibung">Beschreibung:</label>
					<textarea id="editBeschreibung"></textarea>
				</fieldset>
			</fieldset>
			<fieldset class="botGroup">
				<input type="button" class="jetztFiltern" value="Speichern" onclick="updateProject()">
				<button type="button" class="cancel" onclick="hideUpdater()">Abbrechen</button>
			</fieldset>
		</form>
	</div>

	<div class="ergebnisFiltern hidden" id="filter">
		<h2 class="headLineFilter">Projekte im Zeitraum filtern</h2>
		<form id="filterForm" class="filern">
			<fieldset class="filern">
				<label for="startfilter">Startdatum:</label>
				<input type="date" id="startfilter" name="startfilter"><br>
				<label for="endfilter">Enddatum:</label>
				<input type="date" id="endfilter" name="endfilter"><br>
			</fieldset>
			<fieldset class="botGroup">
				<button class="jetztFiltern" type="button" onclick="applyFilter()">Filtern</button>
				<button type="button" class="cancel" onclick="hideFilter()">Abbrechen</button>
			</fieldset>
		</form>
	</div>
</body>
