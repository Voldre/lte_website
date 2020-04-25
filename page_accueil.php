

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />

    <meta charset="utf-8" />

    <!--[if lt IE 9]>
    <script
    src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- permet d'être compatible avec d'anciennes version d'Internet Explorer-->


    <title>Les trente élus</title>

    <meta name="description" content="Page officiel de la série de jeu : Les trente élus, Les informations principales et tout sur le jeu ici même." />

    <!-- <link rel="canonical" href="https://voldre.wixsite.com/les-trente-elus" /> -->

    <meta property="og:title" content="Les trente élus" />
    <meta property="og:description" content="Page officiel du jeu : Les trente élus Les informations principales et tout sur le jeu ici même." />
    <meta property="og:url" content="https://les-trente-elus" />
    <!-- Custom url -->

    <meta property="og:site_name" content="les-trente-elus" />
    <meta property="og:type" content="website" />

    <meta name="keywords" content="elu, elus, jeu, site, trente, trentes, &amp;eacute;lu, &amp;eacute;lus" />

    <link rel="stylesheet" href="style.css" />
    <!-- Methode 1 : Ajouter le code CSS3 via un fichier à part. La méthode 2 c'est de l'écrire dans l'html avec une balise <style> -->
    <!-- L'avantage de cette méthode, c'est que si on dispose de plusieurs fichiers HTML, on n'a pas à copier le code CSS dans chacun, car on a juste à faire appel à ce même fichier! -->

</head>


<!-- On initialise la page avec une fonction d'initialisation "load()"-->

<body onload="load()">


    <!-- Ne pas confondre HEAD (intialisation HTML) et Header : En-tête de la page!-->

    <?php include("header.php"); ?>

    <!-- Doit être déclaré avant la section, car on va le mettre en float, donc il va se caler avec l'élément d'après : la section-->
    <?php include("menu.php"); ?>


    <section class="first">

      <article id="article_1">
            <h3 class="souligne", classe="gras"> Les Trente Elus 3 : Version 2.0 ! </h3>
            <p>Eh voilà enfin la version complète du jeu "Les Trente Elus 3", cette fois ça y est, tout est là, le jeu au grand complet! Avec plusieurs nouveautées à la fois dans le scénario, dans le gameplay et dans son contenu.</p>
            <p class="test">La durée de vie a été prolongé, on passe de 20h de jeu en moyenne à 25h-30h, sans parler du temps de créations : <span class="souligne">500h de créations pour la Version 1.0</span> et <span class="souligne">800h de créations pour cette Version 2.0</span>.</p>
            <!-- Ce texte comporte une classe, "test" qui permet de lui attribuer un style particulier de mise en page-->
            <!-- LA MISE EN PAGE D'UNE CLASSE EST PRIORITAIRE SUR LA MISE EN PAGE D'UNE ECRITURE (comme <p>), l'élément le plus précis l'emporte -->
            <!-- cependant, étant dans une balise <p>, le texte aura la mise en page du p[test] du CSS3, et pas la couleur du .test-->

            <!-- <h6 class="test"> celui-ci sera un texte noir</h6>  -->
            <!-- Celui-ci sera noir, il ne prend pas en compte "p[test]", mais juste ".test", car il n'est pas dans une balise <p> -->


            <p> Voici la liste non-exhaustive des éléments rajoutés :
                <ul>
                    <li>les 24 animations des attaques en duo et en trio, toutes présentent avec leurs effets, vous retrouverez aussi le tableau regroupant ces 24 combinaisons.</li>
                    <li> La forge au grand complet avec plus de 60 objets à crafter, que ce soit au niveau des objets, armes et armures.</li>
                    <li>les 31 Gemmes (et fragments) à collecter, chacune avec des bonus différents.</li>
                    <li>Les 30 illustrations (style Gacha), oui, si vous parvenez à réaliser certains succès du jeu (tout forger, obtenir toutes les gemmes, etc...). Vous aurez des illustrations!</li>
                </ul>
            </p>
            <p>Ainsi, cette version s'est concentré sur les évènements secondaires du jeu, vous aurez donc 18 épreuves uniques à relever, diverses et variées.<br/><br/>​ Pour y jouer, c'est facile, vous avez à présent 3 supports possibles! <span class="gras">Windows, Android et Internet (par navigateur)</span>,
                les 3 versions sont fonctionnelles et vous trouverez les liens ici ou en description des vidéos! Si vous voulez en apprendre plus sur tout cela, je vous invite à visionner le Trailer 2.0 !</p>

            </article>

            <article id="article_2">
                <p>Aujourd'hui, le 23 Août 2018, sort le jeu...</p>
                <h3 class="souligne" , classe="gras">Les Trente Elus 3!</h3>
                <p>Ce troisième et (peut-être) dernier opus de la série se veut encore plus confortable pour les joueurs, et surtout encore plus intéressant! En effet, le mécanisme, la difficulté, ainsi que l'intrigue ont été bien mieux travaillé encore
                    une fois par rapport aux 2 autres jeux jusque là.</p>
                <p>Et ce troisième jeu est ENCORE une fois nettement supérieur à ses deux prédécesseurs! Pour donner des chiffres : la durée de travail du
                    <span class="souligne">1er jeu était aux alentours de 160h</span> pour la version finale.<br/> Tant dis que le <span class="souligne">2ème opus comptait 250h</span> pour la version finale.</p>
                <p>Et cette fois... On n'est plus sur le même niveau... Je dénombre... <br/>
                    <span class="souligne">500 heures de créations au totale!</span></p> ​
                <p>Déjà que le 2ème jeu battait de loin le premier, en terme de qualité, et aussi sur le temps de jeu : (15h pour le 2eme, contre 10h pour le premier), là, <span class="souligne">Les Trente Elus 3</span> explose ce record avec pas moins de
                    <span class="souligne">20h de jeu en moyenne</span>! Sans compter les évènements secondaires!</p>
                <p>Aujourd'hui c'est la Version Officielle 1.0 qui voit le jour, et il manque encore bon nombre d'évènements secondaires à implanter, ce qui devrait donner au total 25h de jeu! Soit l'addition du 1er et 2ème opus!</p>
            </article>

            <article id="article_3">
                <p> Mon test 3</p>
            </article>
            <article id="article_4">
                <p> Mon test 4</p>
            </article>


            <h5> Article <span id="numero">1</span> / 4

                <button onclick="Slider(0)"> << </button>

                <button onclick="Slider(1)"> >> </button>
            </h5>



            <article class="download">
                <h3 class="souligne">Cliquez sur le jeu que vous souhaitez télécharger!</h3>
                <figure>
                    <figcaption class="red">Il est conseillé de commencer par le 3ème jeu!!</figcaption>


                    <!-- Cette configuration permet d'alligner 3 images avec leur texte respectif au dessus. En effet, après la première image, 
                        la deuxième image se met elle-même en flottante, du coup, elles s'allignent! Donnant cet effet -->

                    <p>
                        <a class="flottantG" href="https://voldre.itch.io/les-trente-elus-3" title="Site itch.io" target="_blank">Les Trente Elus 3<br/>
                                        <img src="images/assaut_th.png" alt="Image du jeu Les Trente Elus 3" /></a>
                        <a class="flottantG" href="https://www.fichier-rar.fr/2017/08/28/les-trente-elus-2-beta-1-windows/" title="Fichier .rar" target="_blank">Les Trente Elus 2<br/>
                                <img src="images/LTE2_th.png" alt="Image du jeu Les Trente Elus 2" /></a>
                        <a class="flottantG" href="https://www.fichier-rar.fr/2017/02/13/les-trente-elus-1-pre/" title="Fichier .rar" target="_blank">Les Trente Elus 1<br/>
                                    <img src="images/LTE1_th.png" alt="Image du jeu Les Trente Elus 1" /></a>
                        <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/> <br/>
                    </p>



                </figure>
                <p> Pour vous les présenter brièvement : <br/> <span class="three">Les Trente Elus 3 : Jeu le plus complet, celui par lequel commencer. Beaucoup d'exploration, d'objets à collectionner et de mécaniques de Gameplay (Gemmes / Forges / Attaque en duo-trio /...)
                    sont présents. </span></p>

                <p class="two">Les Trente Elus 2 : Jeu à choix multiples, vos décisions influeront directement sur la santé de votre armée, ainsi que sur les différents évènements, plusieurs fins possibles.</p>

                <p class="one">Les Trente Elus 1 : Tout premier jeu de la série, permet de mieux comprendre l'histoire passé. Mais présente plusieurs défauts, à jouer en tout dernier. </p>


                <p>Je vous invite à vous rendre sur les pages dédiées à chacun des jeux pour mieux comprendre leurs contenus respectif.</p>


            </article>

            </section>




            <section class="second">

                <!-- Si on ne veut pas passer par les classes, on peut passer par les id, mais c'est la même chose -->
                <p id="IDtest">Trailer 2.0 (LTE3)</p>

                <iframe width="475" height="267" src="https://www.youtube.com/embed/UAidCSZXe8s" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <p id="IDtest">Extraits sonore du jeu</p>

                <p> <audio controls>
                    <source src="extraits/0 Une routine nostalgique.ogg" type="audio/ogg">
                </audio> Une routine nostalgique</p>
                <p> <audio controls>
                    <source src="extraits/3rd Generation.ogg" type="audio/ogg"> 
                 </audio> Troisième Génération</p>
                <p> <audio controls>
                    <source src="extraits/Foret de l'ile.ogg" type="audio/ogg">
                </audio> Forêt de l'île maudite </p>


                <br/> <br/> <br/>
                <p id="IDtest">Images des jeux</p>

                <p> Voici différentes images du jeu, vous pouvez cliquer dessus pour les ouvrir en grandes ! </p>

                <a href="images/image_olko.png" target="_blank"><img class="diapo" src='images/image_olko.png' style="display: block;"></a>
                <a href="images/exemple_menu.png" target="_blank"><img class="diapo" src='images/exemple_menu.png' style="display: none;"></a>
                <a href="images/equipe_dechu.png" target="_blank"><img class="diapo" src='images/equipe_dechu.png' style="display: none;"></a>
                <a href="images/vayl_presentation.png" target="_blank"><img class="diapo" src='images/vayl_presentation.png' style="display: none;"></a>


                <!--
                <figure>
                    <a href="images/kzina_aria.png"></ahref> <img src="images/kzina_aria_th.png" alt="Attaque duo Kzina et Aria" /></a>
                    <a href="images/image_velrod.png"> </ahref><img src="images/image_velrod_th.png" alt="Velrod à l'éternité déchu" /></a>
                    <a href="images/vayl_presentation.png"> </ahref><img src="images/vayl_presentation_th.png" alt="Présentation de Vayl de l'univers" /></a>
                </figure>
                -->
            </section>





            <section class="third">
                <p>L

            </section>

            <!-- Pied de Page-->

            <?php include("footer.php"); ?>

            <!-- le Javascript n'a pas d'utilité dans une quelconque section, autant le mettre à la fin du body-->

            <!--------------------------------- JAVASCRIPT PART    --------------------------->

            <!-- Diaporama d'images    -->
            <script type="text/javascript">
                I = 3; // On commence à I = 3 car il y a déjà 3 images utilisés dans la page (pour LTE1,2,3, donc la place 0,1,2 sont occupés)
                Imax = document.images.length - 1; // Nombre d'images -1
                setTimeout(suivante, 2000);

                function suivante() {
                    document.images[I].style.display = "none"; // css - display: none;
                    if (I < Imax)
                        I++;
                    else
                        I = 3; // Réinitialisation de la boucle
                    document.images[I].style.display = "block";
                    setTimeout(suivante, 2000);
                }
            </script>


            <!--------- Diaporama des articles (annonces) --------->

            <script type="text/javascript">
                // Fonction lors de l'initialisation de la page
                // N'afficher que le 1er article
                function load() {

                    // .querySelector() permet de sélectionner un ID (ou une class), et d'ajouter une classe à l'intérieure d'elle,
                    // Ici, la classe collapse permet de faire un "display: none;" et ainsi, désactiver chaque article_X  
                    document.querySelector("#article_2").classList.add("collapse");
                    // Il n'est d'ailleurs pas possible d'écrire   document. . . .style.display = "none", on doit passer par une classe externe
                    document.querySelector("#article_3").classList.add("collapse");
                    document.querySelector("#article_4").classList.add("collapse");

                }

                nb_article = 4;
                i_article = 1;

                function Slider(x) {
                    // alert("le test fonctionne");

                    //  document.querySelector("#newtest").classList.remove("test");
                    /*
                    name_ID = "&quot;article_";
                    name_ID += i_article;
                    name_ID += "&quot;";
                    */

                    switch (i_article) {

                        case 1:
                            document.querySelector("#article_1").classList.add("collapse");
                            break;

                        case 2:
                            document.querySelector("#article_2").classList.add("collapse");
                            break;

                        case 3:
                            document.querySelector("#article_3").classList.add("collapse");
                            break;

                        case 4:
                            document.querySelector("#article_4").classList.add("collapse");
                            break;

                        default:
                            ;

                    }
                    // Passer à l'article suivant ou précédent
                    if (x == 0) {
                        i_article -= 1;
                    }
                    if (x == 1) {
                        i_article += 1;
                    }

                    /*
                    name_ID = "&quot;article_";
                    name_ID += i_article;
                    name_ID += "&quot;";
                    */

                    // On vérifie si on est au dernier article et qu'on avance
                    if (i_article > nb_article) {
                        i_article = 1;
                    }
                    // Si on est au premier et qu'on recul
                    if (i_article < 1) {
                        i_article = 4;
                    }

                    // Affichage du numéro de l'article
                    document.getElementById("numero").innerHTML = i_article;


                    switch (i_article) {
                        case 1: // Ici on "retire" une classe, celle précédemment ajoutée
                            document.querySelector("#article_1").classList.remove("collapse");
                            break;
                        case 2:
                            document.querySelector("#article_2").classList.remove("collapse");
                            break;
                        case 3:
                            document.querySelector("#article_3").classList.remove("collapse");
                            break;
                        case 4:
                            document.querySelector("#article_4").classList.remove("collapse");
                            break;
                        default:
                            ;
                    }

                    //  document.querySelector("#newtest").classList.add("collapse");
                }
            </script>









            <!--
            <script type="text/javascript">
                var htmlClassList = document.documentElement.classList;
                var bodyCacheable = false;
                var clientSideRender = false;
            </script>
            -->


</body>

</html>