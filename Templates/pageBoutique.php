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
            <section id="container">
                <section id="barre1">
                    <p id="Titre1">Article les plus commandés:</p>
                    <button id="btnPanier">Panier</button>
                </section>

                <section id="prodPlusCommandé">
                    <section id="prodCom1">
                        <p>ImageProduit</p>
                        <p id="nomProd">Prod1</p>
                        <p id="PrixProd">10€</p>
                    </section>
                </section>

                <section id="barre2">
                    <p id="Titre2">Autres articles:</p>
                    <section id="recherche">
                        <form action="/search" id="searchthis" method="get">
                            <input id="search" name="q" type="text" placeholder="Rechercher"/>
                            <input id="search-btn" type="submit" value="Rechercher"/>
                        </form>
                    </section>
                    <section id="Filtre">
                        <button id="dropbtn">Filtre</button>
                        <section id="dropdown">
                            <a href="#prixCroissant">prix croissant</a>
                            <a href="#prixDécroissant">prix décroissant</a>
                            <a href="#OrdreAlpha">Ordre alphabétique</a>
                            <a href="#Catégorie">Catégorie</a>
                        </section>
                    </section>
                </section>

                <section id="Prod">
                    <section id="Prod1">
                        <p>ImageProduit</p>
                        <p id="nomProd">Prod1</p>
                        <p id="PrixProd">10€</p>
                        <button class="delete">supprimer</button>
                    </section>
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