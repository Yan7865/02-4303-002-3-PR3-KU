<head>
<style>
	* {
		box-sizing: border-box;
		border-color: #F0F0F0;
	}
	.tablerow > div:nth-child(1) {
		width: 5%;
		border-left: none;
	}
	.tablerow > div:nth-child(2) {
		width: 15%;
	}
	.tablerow > div:nth-child(3) {
		width: 12%;
	}
	.tablerow > div:nth-child(4) {
		width: 12%;
	}
	.tablerow > div:nth-child(5) {
		width: 34%;
	}
	.tablerow > div:nth-child(6) {
		width: 15%;
	}
	.tablerow > div:nth-child(7) {
		width: 7%;
	}

	.tableheadercell::first-letter {
        text-transform: uppercase;
    }
	.tableheadercell {
		border-bottom: 2px solid #F0F0F0;
		font-weight: bold;
		color: #323232;
	}
	.tablecell {
		padding: 10px 15px 10px 15px;
		border-left: 2px solid #F0F0F0;
		text-align: left;
		vertical-align: text-top;
	}
	.tablerow {
		display: flex;
	}
	.tablebody {
		display: flex;
		flex-direction: column;
	}
	.kontextmenu {
		display: flex;
		background-color: #F0F0F0;
        font-size: 20px;
	}
	.button {
		padding: 10px 15px 10px 15px;
		display: flex;
		text-align: left;
		text-align-last: center;
	}
	.buttonicon {
		color: red;
		font-size: 20px;
		text-align: left;
		text-align-last: center;
	}
	button {
		border: 1px solid transparent;
		cursor: pointer;
	}
	.projektliste {
		padding: 10px 20px 10px 10px;
        font-size: 20px;
	}
	.projektdarstellung {
		border: 2px solid #F0F0F0;
        font-size: 20px;
	}
	.formularneu {
		display: flex;
	}
	.hidden {
		display: none;
	}
    .neuerProjekt {
    	display: flex;
        width: 100%;
        flex-direction: column;
	}
    .leftGroup {
    	width: 50%;
        border: none;
        display: flex;
        flex-direction: column;
    }
    .rightGroup {
    	width: 50%;
        border: none;
        display: flex;
        flex-direction: column;
    }
	textarea {
		font-size: 20px;
		padding: 10px;
		min-height: 200px;
		max-height: 400px;
		width: 100%;
	}
    form {
        font-size: 20px;
    }
   	input[type='text'] {
		border: 0px solid black;
		border-bottom: 1px solid grey;
		height: 30px;
		font-size: 20px;
		margin-right: 15px;
	}
   	input[type='date'] {
    	height: 30px;
		cursor: pointer;
		font-size: 18px;
		border: 0px solid black;
		border-bottom: 1px solid grey;
        margin-right: 15px;
	}
    input[type='submit'] {
    	border: none;
        background-color: red;
        color: white;
        font-size: 20px;
        cursor: pointer;
    }
    .neuerProjektContainer {
    	margin: 40px;
        padding: 20px;
        background-color: #F0F0F0;
        width: 60%;
		position: fixed;
		top: 100px;
		left: 100px;
    }
    label {
    	margin-bottom: 5px;
    }
    .filern {
        display: flex;
        flex-direction: column;
		border: none;
    }
    .ergebnisFiltern {
    	margin: 40px;
        padding: 20px;
        background-color: #F0F0F0;
        width: 30%;
		position: fixed;
		top: 100px;
		left: 100px;
    }
    .topGroup {
    	display: flex;
		border: none;
    }
    .botGroup {
    	display: flex;
        justify-content: flex-end;
		border: none;
    }
	.cancel {
    	background-color: gray;
        color: white;
     	font-size: 20px;
        margin-left: 10px;
    }
	.headLineNewProject {
		margin-left: 30px;
	}
	.headLineFilter {
		margin-left: 15px;
	}
	.jetztFiltern {
		border: none;
        background-color: red;
        color: white;
        font-size: 20px;
        cursor: pointer;
	}
	.eintragAktualiserButton {
		background-color: #F0F0F0;
		margin: 3px;
	}
	.tablerow:hover {
		background-color: #fce3e7;
	}
</style>

<script>

	    function showNeuerProjekt() {
            const element = document.getElementById('neuProjekt');
            element.classList.remove('hidden');
        }
            
        function hideNeuerProjekt() {
            const element = document.getElementById('neuProjekt');
            element.classList.add('hidden');
        }
        function showFilter() {
            const element = document.getElementById('filter');
            element.classList.remove('hidden');
        }
        function hideFilter() {
            const element = document.getElementById('filter');
            element.classList.add('hidden');
        }
        function hideUpdater() {
            const element = document.getElementById('editProjektFormular');
            element.classList.add('hidden');
        }

		async function applyFilter() {
			const startFilter = document.getElementById('startfilter').value;
			const endFilter = document.getElementById('endfilter').value;

			const response = await fetch('filterprojekte.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				},
				body: new URLSearchParams({
					startfilter: startFilter,
					endfilter: endFilter
				})
			});

			const data = await response.text();
			document.querySelector('.projektliste').innerHTML = data;
			hideFilter();
		}
</script>

<script>
    function editRow(id) {
        fetch('projektdatenbekommen.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('editProjektId').value = data.id;
            document.getElementById('editProjektName').value = data.name;
            document.getElementById('editStartDatum').value = data.startdatum;
            document.getElementById('editEndDatum').value = data.enddatum;
            document.getElementById('editVerantwortlich').value = data.verantwortlich;
            document.getElementById('editBeschreibung').value = data.beschreibung;

            document.getElementById('editProjektFormular').classList.remove('hidden'); //Anzeigen der Formularfelder zum aktualisieren eines Projektes
        });
    }

    function updateProject() {
        const id = document.getElementById('editProjektId').value;
        const name = document.getElementById('editProjektName').value;
        const startDatum = document.getElementById('editStartDatum').value;
        const endDatum = document.getElementById('editEndDatum').value;
        const verantwortlich = document.getElementById('editVerantwortlich').value;
        const beschreibung = document.getElementById('editBeschreibung').value;

        fetch('projektaktualisieren.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                id: id,
                name: name,
                startdatum: startDatum,
                enddatum: endDatum,
                verantwortlich: verantwortlich,
                beschreibung: beschreibung
            })
        })
        .then(response => response.text())
        .then(data => {

            document.getElementById('editProjektFormular').classList.add('hidden');

            applyFilter();
        });
    }
</script>


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
            <fieldset class="topgroup">
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
			<fieldset class="topgroup">
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
