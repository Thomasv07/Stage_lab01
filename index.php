<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <Br id="Haut" />
        <img class="imagee" src="media/lab01+.png" alt="">
        <center>
            <ul id="menu">
                <li><a href=""><span>???</span></a></li>
                <li><a href=""><span>???</span></a></li>
                <li><a href=""><span>???</span></a></li>
                <li><a href=""><span>???</span></a></li>
            </ul>
        </center>
        <Br>
    </header>
    <div class="progress-circle" data-value="
        <?php
        $prix = 48;
        $pourcentage = 25;

        echo $prix - ($prix * ($pourcentage / 100));
        ?>">
    </div>
    <section>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                    <tr>
                        <th><span>Positif</span></th>
                        <th><span>Negatif</span></th>
                        <th><span>Suppression</span></th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    <?php
                    try {
                        $bdd = new PDO('mysql:host=localhost;dbname=stage_lab01', 'root', '');
                    } catch (PDOException $e) {
                        print "Erreur: " . $e->getMessage() . "<br/>";
                        die();
                    }

                    $req = $bdd->query('SELECT * FROM `satisfaction` WHERE 1');

                    foreach ($req as $value) :

                    ?>
                        <tr>
                            <td><?= $value['taux']; ?></td>
                            <td><?= $value['taux_insatisfait']; ?></td>
                            <td>
                                <img src="media/download.png" alt="">
                                <a href="delete.php?id=<?= $value['id']; ?>">Supprimer</a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </section>


    <script type="text/javascript">
        function createJauge(elem) {
            if (elem) {
                // on commence par un clear
                while (elem.firstChild) {
                    elem.removeChild(elem.firstChild);
                }
                // création des éléments
                var oMask = document.createElement('DIV');
                var oBarre = document.createElement('DIV');
                var oSup50 = document.createElement('DIV');
                // affectation des classes
                oMask.className = 'progress-masque';
                oBarre.className = 'progress-barre';
                oSup50.className = 'progress-sup50';
                // construction de l'arbre
                oMask.appendChild(oBarre);
                oMask.appendChild(oSup50);
                elem.appendChild(oMask);
            }
            return elem;
        }

        // Initialisation après chargement du DOM
        document.addEventListener('DOMContentLoaded', function() {
            var oJauges = document.querySelectorAll('.progress-circle');
            var i, nb = oJauges.length;
            for (i = 0; i < nb; i += 1) {
                createJauge(oJauges[i]);
            }
        });

        function initJauge(elem) {
            var oBarre;
            var angle;
            var valeur;
            //
            createJauge(elem);
            oBarre = elem.querySelector('.progress-barre');
            valeur = elem.getAttribute('data-value');
            valeur = valeur ? valeur * 1 : 0;
            elem.setAttribute('data-value', valeur.toFixed(1));
            angle = 360 * valeur / 100;
            if (oBarre) {
                oBarre.style.transform = 'rotate(' + angle + 'deg)';
            }
        }

        // Initialisation après chargement du DOM
        document.addEventListener('DOMContentLoaded', function() {
            var oJauges = document.querySelectorAll('.progress-circle');
            var i, nb = oJauges.length;
            for (i = 0; i < nb; i += 1) {
                initJauge(oJauges[i]);
            }
        });

        // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
        $(window).on("load resize ", function() {
            var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
            $('.tbl-header').css({
                'padding-right': scrollWidth
            });
        }).resize();
    </script>

</body>

</html>