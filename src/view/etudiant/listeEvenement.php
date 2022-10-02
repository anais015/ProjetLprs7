<?php
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }
        .tab button:hover {
            background-color: #ddd;
        }
        .tab button.active {
            background-color: #ccc;
        }
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
    </style>
</head>
<body>
<nav>
    <div class="bottom-row">
        <a href="../../index.php">Accueil</a>
        <a href="trouverJob.php">Trouver un job</a>
        <a href="trouverEvenement.php">Trouver un événement</a>
        <a href="organizerEvenement.php">Organizer un événement</a>
        <a href="#">Contact</a>

        <a href="listeEvenement.php">Mes événement</a>
        <a href="candidature.php">Mes candidatures</a>
        <a href="rdv.php">Mes rendez-vous</a>
        <a href="monCompte.php">Mon compte</a>
        <a href="deconnexion.php">Se déconnecter</a>
    </div>
</nav>
<h2>Événement</h2>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'À organiser')">À organiser</button>
    <button class="tablinks" onclick="openTab(event, 'À participer')">À participer</button>
</div>

<div id="À organiser" class="tabcontent">
    <h3>Événement à organiser</h3>
    <table>
        <tr>
            <th>Titre du événement</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Durée</th>
            <th>Salle</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>Alfreds Futterkiste</td>
            <td>20-10-2022</td>
            <td>10:00</td>
            <td>2:00</td>
            <td>Germany</td>
            <td>
                <button>Modifier</button>
                <button>Annuler</button>
            </td>
        </tr>
    </table>
</div>

<div id="À participer" class="tabcontent">
    <h3>Événement à participer</h3>
    <table>
        <tr>
            <th>Titre du événement</th>
            <th>Entreprise</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Durée</th>
            <th>Salle</th>
            <th>Action</th>
        </tr>
        <tr>
            <td>Alfreds Futterkiste</td>
            <td>ENGIE</td>
            <td>20-10-2022</td>
            <td>10:00</td>
            <td>2:00</td>
            <td>Germany</td>
            <td><button>Annuler</button></td>
        </tr>
    </table>
</div>

<script>
    function openTab(evt, eventType) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(eventType).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

</body>
</html>
