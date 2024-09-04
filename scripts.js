
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