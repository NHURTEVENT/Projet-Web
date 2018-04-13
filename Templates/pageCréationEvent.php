<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <meta charset="utf-8">
    </head>

    <body>
        <header id="enTete">

            <img id="img" src="https://pbs.twimg.com/profile_images/693744907127750656/W_byIUTt_400x400.png" alt="logo bde"/>

            <section id="navigation">

                <p id="btn">
                    <button id="inscriptionHead">Inscription</button>
                    <button id="connexionHead">Connexion</button>
                </p>

                <p id="BVN">Bienvenue sur le site du BDE du Cesi Toulouse</p>

                <nav id="navBar">
                    <ul id="ul">
                        <li class="listeNav"><a href="#Fil d'actualité" >Fil d'actualité</a></li>
                        <li class="listeNav"><a href="#Boutique" >Boutique</a></li>
                        <li class="listeNav"><a href="#Evènement" >Evènement</a></li>
                        <li class="listeNav"><a href="#Boite à idée" >Boite à idée</a></li>
                    </ul>
                </nav>
            </section>
        </header>

        <section id="base">
            <section id="coeur">
                <a id="TitreCréationEvent">Création d'évènement</a>
                <section id="paramEvent">
                    <section id="nomEvent">
                        <a>Nom de l'évènement</a>
                        <input id="inNomEvent">
                    </section>

                    <section id="imageEvent">
                        <a>Ajouter une image à votre évènement :</a>
                        <button id="fichier">Parcourir mes fichiers</button>
                    </section>

                    <section id="dateEvent">
                        <a>Date de l'évènement</a>
                        <input type="date">
                    </section>

                    <section id="lieuEvent">
                        <a>Lieu de l'évènement</a>
                        <input id="lieu">
                    </section>

                    <sectino id="eventPayant">
                        <a>Est-ce payant?</a>
                        <input type="radio" name="payant" value="oui">oui
                        <input type="radio" name="payant" value="non">non
                        <a id="oui">Si oui, combien?</a>
                        <input id="prixEvent">
                    </sectino>

                    <section id="eventPonctuel">
                        <a>Est-ce un évènement ponctuel?</a>
                        <input type="radio" name="ponctuel" value="oui">oui
                        <input type="radio" name="ponctuel" value="non">non
                    </section>

                </section>
                <section id="choix">
                    <button>Annuler</button>
                    <button>Créer évènement</button>
                </section>
            </section>

            <section id="aside">
                <section id="boiteIdée">
                    <a>Boite à Idées</a>
                </section>

                <section id="EventMois">
                    <a>Evènement du mois</a>
                </section>
            </section>

        </section>

        <footer id="footer">
            <p id="mail">Adresse mail: bde-toulouse@viacesi.fr</p>
            <a href="https://www.facebook.com/bdecesitoulouse/?ref=br_rs">Facebook BDE</a>
        </footer>

    </body>

</html>