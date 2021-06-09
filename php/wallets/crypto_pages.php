<?php  

require_once '../utils/database.php';
require_once '../utils/check_session.php';
require_once '../utils/crypto.php';
require_once '../file/utils.php';

$_SESSION['U_ID'] = 3;
$_SESSION['scadenza'] = time() + 48927398;


if(!valid_session()){
	//redirect al login
	exit();
}

$address = get_address($_SESSION['U_ID']);

if($address === null){

	$errore_address = "";
	$errore_insert = "";

	if(isset($_POST['btn_send'])){
		if ($_POST['address'] !== "") {
					
			$sql = "
			insert into WALLETS (U_ID, ADDRESS)
			values (?, ?);
			";

			$stmt=$pdo->prepare($sql);
			$stmt->execute([$_SESSION['U_ID'], $_POST['address']]);
			$conferma = $stmt->fetch();
				
			if ($conferma === null) {
				$errore_insert = true;
			}
			
		}else{
			$errore_address = "error";
		}
	}
?>



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style_menu2.css">
    <link rel="stylesheet" href="../../style/style_crypto.css">



    <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/metamask/nkbihfbeogaeaoehlefnkodbefgpgknn">



    <!--<link href="style/style_cal.css" rel="stylesheet">-->



</head>

<body>

    <nav id="sidebar" class="msidebar mis-open_menu">

        <div class="mscroll_wrapper">

            <a class="msidebar-brand" href="index.html">
                <svg class="msvgprova" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" id="svg925" viewBox="0 0 80 80" sodipodi:docname="logo_bianco_sfondo_azzurro_bordo_bianco.jpg.svg" inkscape:version="1.0.2 (e86c870, 2021-01-15)">
  
                    <g
                        inkscape:groupmode="layer"
                        inkscape:label="Image"
                        id="g933"
                        transform="translate(1.8897638,1.8897638)">
                        <circle
                        style="fill:#3f80ea;fill-opacity:1;stroke:transparent;stroke-width:3.77953;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke fill markers"
                        id="path1500"
                        cx="30"
                        cy="30"
                        r="30" />
                        <path
                        style="fill:#ffffff;fill-opacity:1;stroke-width:0.360365"
                        d="m 14.000004,49.13796 c -0.0042,-0.947573 3.141983,-26.461906 3.424656,-27.773092 l 0.175809,-0.815486 H 27.98445 c 7.011299,0 10.383979,0.123566 10.383979,0.380437 0,0.694673 -0.99718,2.324637 -2.028255,3.31533 -1.84346,1.771257 -3.217124,2.103247 -8.70252,2.103247 -4.917309,0 -5.024467,0.01682 -5.192099,0.815487 -0.233711,1.113468 -2.001857,15.527267 -1.996558,16.275796 0.0094,1.335904 3.48886,-0.649022 4.456875,-2.542552 0.280792,-0.549257 0.686685,-2.375671 0.901984,-4.058697 0.2153,-1.683026 0.483275,-3.671661 0.5955,-4.41919 l 0.204042,-1.359144 h 4.581404 c 3.102487,0 5.060444,-0.170967 6.065378,-0.529618 5.639891,-2.012833 7.813718,-9.095436 3.920258,-12.772695 -1.817675,-1.716739 -2.990212,-1.9201 -11.070909,-1.9201 -8.804378,0 -9.649477,-0.211283 -10.762776,-2.690793 -0.364807,-0.812487 -0.666828,-1.852918 -0.671156,-2.312069 L 18.661797,10 29.679636,10.109941 c 12.370785,0.123446 12.722925,0.19033 15.798223,3.00074 6.537667,5.974547 3.558726,18.065294 -5.508429,22.35729 -1.826197,0.864441 -3.011239,1.152693 -5.344189,1.299918 l -2.997666,0.189178 -0.229687,1.672603 c -0.570807,4.156643 -3.504525,8.02706 -7.633143,10.070317 -1.670903,0.826931 -2.563485,1.000048 -5.865844,1.137681 L 14.00382,50 14.00002,49.137958 Z"
                        id="path1498" />
                    </g>
                </svg>


                <span class="malign-middle">Pocket</span>
            </a>

            <ul class="msidebar-nav">
                <li class="msidebar-header">
                    Profile
                </li>
                <li class="msidebar-item">
                    <a href="dashboard.html" data-toggle="collapse" class="mnonactive">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" class="msidebar-item_icon" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                        <span class="">Dashboard</span>

                </li>

                <li class="msidebar-item">
                    <a id="organizzazione" data-toggle="collapse" class="msidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="msidebar-item_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span class="">Organizzazione</span>
                        <svg id="org_arrow" xmlns="http://www.w3.org/2000/svg" class="mextended_arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle"><polyline points="6 9 12 15 18 9"></polyline></svg>

                    </a>
                    <ul id="org_child" class="mcollapsed mchild">
                        <li class="msidebar-item"><a class="msidebar-link" href="calendar.html">Calendario</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="new_event.html">Aggiungi evento</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="promemoria.html">Promemoria</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="viaggi.html">Viaggi</a></li>
                    </ul>
                </li>

                <li class="msidebar-item">
                    <a id="finanze" data-toggle="" class="mlinkactive">
                        <svg xmlns="http://www.w3.org/2000/svg" class="msidebar-item_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>                        Finanza
                        <svg id="finanze_arrow" xmlns="http://www.w3.org/2000/svg" class="mextended_arrow mcontracted" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down align-middle mr-2"><polyline points="6 9 12 15 18 9"></polyline></svg>

                    </a>
                    <ul id="finanze_child" class="mchild mopen_fin">
                        <li class="msidebar-item"><a class="msidebar-link" style="color: rgba(255, 255, 255, 0.9);" href="crypto.html">Crypto</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="dashboard-default.html">Conto</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="dashboard-analytics.html">Carte</a></li>
                    </ul>
                </li>

            </ul>



            <ul class="msidebar-nav">
                <li class="msidebar-header">
                    Files
                </li>
                <li class="msidebar-item">
                    <a id="files" href="#dashboards" class="msidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" class="msidebar-item_icon" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                        <i class="" data-feather="sliders"></i> <span class="align-middle">Files</span>
                        <svg id="files_arrow" xmlns="http://www.w3.org/2000/svg" class="mextended_arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle"><polyline points="6 9 12 15 18 9"></polyline></svg>

                    </a>
                    <ul id="files_child" class="mchild mcollapsed" data-parent="#sidebar">
                        <li class="msidebar-item"><a class="msidebar-link" href="show_files.html">My Files</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="upload_files.html">Upload</a></li>

                    </ul>
                </li>

                <li class="msidebar-item">
                    <a href="#dashboards" data-toggle="collapse" class="msidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="msidebar-item_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle mr-2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Upgrade</span>
                    </a>

                </li>



            </ul>
        </div>
    </nav>


    <div id="root" class="mmain_container mis-open_main">

        <header class="mintestation">
            <a id="mmenu_button">
                <span class="mfirst_line"></span>
                <span class="msecond_line"></span>
                <span class="mthird_line"></span>
            </a>
        </header>



        <div id="container" class="mcontainer">

            <form method="POST" action="">
                <h2>Ho un indirizzo</h2>
                <input name="address" placeholder="Indirizzo wallet" class="input <?=$errore_address?>">
                <button name="btn_send" class="btn_send" type="submit">Connetti al wallet <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="arrow"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></button>
               	<?php if($errore_address == 'error') echo '<p style="color: RED;margin-left: 5px; font-size: 12px">Inserisci l\'indirizzo</p>'?>
            </form>

            <hr>
            <h2>Non ho un indirizzo</h2>
            <ul>
                <li>
                    <p>Aggiungi l'estensione <a class="btn_metamask" href="https://chrome.google.com/webstore/detail/metamask/nkbihfbeogaeaoehlefnkodbefgpgknn">Metamask<img src="../../icons/metamask.svg"></a></p>
                </li>
                <li>
                    <p>Crea un wallet e incolla l'indirizzo</p>
                </li>
            </ul>

        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        $(document).ready(function() {



            /*$(".menu_icon").click(function(e) {
                $("#mySidenav").toggleClass('is-open_menu');
                $("#main").toggleClass('is-open_main');

                e.preventDefault();
            });*/

            $("#container").click(function(e) {
                var width = $(window).width();

                if ($("#root").hasClass("mis-open_main") && width <= 767) {
                    $("#sidebar").removeClass('mis-open_menu');
                    $("#root").removeClass('mis-open_main');
                    e.preventDefault();
                }
            });


            $("#mmenu_button").click(function(e) {
                $("#sidebar").toggleClass('mis-open_menu');
                $("#root").toggleClass('mis-open_main');
                e.preventDefault();
            });




            $("#organizzazione").click(function(e) {
                $("#org_child").toggleClass('mcollapsed');
                $("#org_child").toggleClass('mopen_org');

                if ($("#org_child").hasClass('mopen_org')) {
                    $("#org_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(180deg)"
                    });

                } else {
                    $("#org_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                }
                if ($("#finanze_child").hasClass('mopen_fin')) {
                    $("#finanze_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#finanze_child").removeClass('mopen_fin');
                    $("#finanze_child").addClass('mcollapsed');

                }

                if ($("#files_child").hasClass('mopen_files')) {
                    $("#files_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#files_child").removeClass('mopen_files');
                }




                e.preventDefault();
            });

            $("#finanze").click(function(e) {
                $("#finanze_child").toggleClass('mopen_fin');
                $("#finanze_child").toggleClass('mcollapsed');

                if ($("#finanze_child").hasClass('mopen_fin')) {
                    $("#finanze_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(180deg)"
                    });

                } else {
                    $("#finanze_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                }

                if ($("#org_child").hasClass('mopen_org')) {
                    $("#org_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#org_child").removeClass('mopen_org');
                    $("#org_child").addClass('mcollapsed');

                }


                if ($("#files_child").hasClass('mopen_files')) {
                    $("#files_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#files_child").removeClass('mopen_files');
                }



                e.preventDefault();
            });


            $("#files").click(function(e) {
                $("#files_child").toggleClass('mopen_files');
                if ($("#files_child").hasClass('mopen_files')) {
                    $("#files_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(180deg)"
                    });

                } else {
                    $("#files_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                }

                if ($("#org_child").hasClass('mopen_org')) {
                    $("#org_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#org_child").removeClass('mopen_org');
                    $("#org_child").addClass('mcollapsed');

                }

                if ($("#finanze_child").hasClass('mopen_fin')) {
                    $("#finanze_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#finanze_child").removeClass('mopen_fin');
                    $("#finanze_child").addClass('mcollapsed');

                }


                e.preventDefault();
            });




        });
    </script>

</body>

</html>

<?php  
}else{

	$balance_obj = get_balance($address);

	$balance = 0;

	if($balance_obj->status == 0){
		$address = "address del wallet non corretto ==> prova a reinserirlo";
	}else{
		$balance = $balance_obj->result;
	}


	$used_space = get_used_space($_SESSION['U_ID']) / 1000000000;
	$max_usable = get_max_usable($_SESSION['U_ID']);


	$used_rel = $used_space / $max_usable;
	$perc_used = $used_rel * 100;


	$status_starter = "Upgrade";
	$status_starter_plus = "Upgrade";
	$status_expert = "Upgrade";
	$status_pro = "Upgrade";

	$style_starter = "";
	$style_starter_plus = "";
	$style_expert = "";
	$style_pro = "";


	$plane = get_plane($_SESSION['U_ID']);

	if($plane == "STARTER"){
		$status_starter = "Current";
		$style_starter = "current";
	}elseif($plane == "STARTER PLUS"){
		$status_starter_plus = "Current";
		$style_starter_plus = "current";
	}elseif($plane == "EXPERT"){
		$status_expert = "Current";
		$style_expert = "current";
	}elseif($plane == "PRO"){
		$status_pro = "Current";
		$style_pro = "current";
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style/style_menu2.css">
    <link rel="stylesheet" href="../../style/style_crypto2.css">

    <link rel="chrome-webstore-item" href="https://chrome.google.com/webstore/detail/metamask/nkbihfbeogaeaoehlefnkodbefgpgknn">

    <!--<link href="style/style_cal.css" rel="stylesheet">-->

</head>

<body>

    <nav id="sidebar" class="msidebar mis-open_menu">

        <div class="mscroll_wrapper">

            <a class="msidebar-brand" href="index.html">
                <svg class="msvgprova" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                    xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" version="1.1" id="svg925" viewBox="0 0 80 80" sodipodi:docname="logo_bianco_sfondo_azzurro_bordo_bianco.jpg.svg" inkscape:version="1.0.2 (e86c870, 2021-01-15)">
  
                    <g
                        inkscape:groupmode="layer"
                        inkscape:label="Image"
                        id="g933"
                        transform="translate(1.8897638,1.8897638)">
                        <circle
                        style="fill:#3f80ea;fill-opacity:1;stroke:transparent;stroke-width:3.77953;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke fill markers"
                        id="path1500"
                        cx="30"
                        cy="30"
                        r="30" />
                        <path
                        style="fill:#ffffff;fill-opacity:1;stroke-width:0.360365"
                        d="m 14.000004,49.13796 c -0.0042,-0.947573 3.141983,-26.461906 3.424656,-27.773092 l 0.175809,-0.815486 H 27.98445 c 7.011299,0 10.383979,0.123566 10.383979,0.380437 0,0.694673 -0.99718,2.324637 -2.028255,3.31533 -1.84346,1.771257 -3.217124,2.103247 -8.70252,2.103247 -4.917309,0 -5.024467,0.01682 -5.192099,0.815487 -0.233711,1.113468 -2.001857,15.527267 -1.996558,16.275796 0.0094,1.335904 3.48886,-0.649022 4.456875,-2.542552 0.280792,-0.549257 0.686685,-2.375671 0.901984,-4.058697 0.2153,-1.683026 0.483275,-3.671661 0.5955,-4.41919 l 0.204042,-1.359144 h 4.581404 c 3.102487,0 5.060444,-0.170967 6.065378,-0.529618 5.639891,-2.012833 7.813718,-9.095436 3.920258,-12.772695 -1.817675,-1.716739 -2.990212,-1.9201 -11.070909,-1.9201 -8.804378,0 -9.649477,-0.211283 -10.762776,-2.690793 -0.364807,-0.812487 -0.666828,-1.852918 -0.671156,-2.312069 L 18.661797,10 29.679636,10.109941 c 12.370785,0.123446 12.722925,0.19033 15.798223,3.00074 6.537667,5.974547 3.558726,18.065294 -5.508429,22.35729 -1.826197,0.864441 -3.011239,1.152693 -5.344189,1.299918 l -2.997666,0.189178 -0.229687,1.672603 c -0.570807,4.156643 -3.504525,8.02706 -7.633143,10.070317 -1.670903,0.826931 -2.563485,1.000048 -5.865844,1.137681 L 14.00382,50 14.00002,49.137958 Z"
                        id="path1498" />
                    </g>
                </svg>


                <span class="malign-middle">Pocket</span>
            </a>

            <ul class="msidebar-nav">
                <li class="msidebar-header">
                    Profile
                </li>
                <li class="msidebar-item">
                    <a href="dashboard.html" data-toggle="collapse" class="mnonactive">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" class="msidebar-item_icon" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                        <span class="">Dashboard</span>

                </li>

                <li class="msidebar-item">
                    <a id="organizzazione" data-toggle="collapse" class="msidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="msidebar-item_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span class="">Organizzazione</span>
                        <svg id="org_arrow" xmlns="http://www.w3.org/2000/svg" class="mextended_arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle"><polyline points="6 9 12 15 18 9"></polyline></svg>

                    </a>
                    <ul id="org_child" class="mcollapsed mchild">
                        <li class="msidebar-item"><a class="msidebar-link" href="calendar.html">Calendario</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="new_event.html">Aggiungi evento</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="promemoria.html">Promemoria</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="viaggi.html">Viaggi</a></li>
                    </ul>
                </li>

                <li class="msidebar-item">
                    <a id="finanze" data-toggle="" class="mlinkactive">
                        <svg xmlns="http://www.w3.org/2000/svg" class="msidebar-item_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>                        Finanza
                        <svg id="finanze_arrow" xmlns="http://www.w3.org/2000/svg" class="mextended_arrow mcontracted" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down align-middle mr-2"><polyline points="6 9 12 15 18 9"></polyline></svg>

                    </a>
                    <ul id="finanze_child" class="mchild mopen_fin">
                        <li class="msidebar-item"><a class="msidebar-link" style="color: rgba(255, 255, 255, 0.9);" href="crypto.html">Crypto</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="dashboard-default.html">Conto</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="dashboard-analytics.html">Carte</a></li>
                    </ul>
                </li>

            </ul>



            <ul class="msidebar-nav">
                <li class="msidebar-header">
                    Files
                </li>
                <li class="msidebar-item">
                    <a id="files" href="#dashboards" class="msidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" class="msidebar-item_icon" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                        <i class="" data-feather="sliders"></i> <span class="align-middle">Files</span>
                        <svg id="files_arrow" xmlns="http://www.w3.org/2000/svg" class="mextended_arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle"><polyline points="6 9 12 15 18 9"></polyline></svg>

                    </a>
                    <ul id="files_child" class="mchild mcollapsed" data-parent="#sidebar">
                        <li class="msidebar-item"><a class="msidebar-link" href="show_files.html">My Files</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="upload_files.html">Upload</a></li>

                    </ul>
                </li>

                <li class="msidebar-item">
                    <a href="#dashboards" data-toggle="collapse" class="msidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="msidebar-item_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle mr-2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Upgrade</span>
                    </a>

                </li>



            </ul>
        </div>
    </nav>


    <div id="root" class="mmain_container mis-open_main">

        <header class="mintestation">
            <a id="mmenu_button">
                <span class="mfirst_line"></span>
                <span class="msecond_line"></span>
                <span class="mthird_line"></span>
            </a>
        </header>




        <div id="container" class="mcontainer">

            <h3>Pocketcoin</h3>

            <div class="balance_container">
                <p class="balance">Balance: <b><?=$balance?> PKCT</b></p>
                <p class="address">Address: <?= $address ?></p>

            </div>

            <hr>

            <div class="balance_container">


                <p class="space"><?php echo "Space: $used_space GB / $max_usable GB "?></p>
                <progress id="file" value="<?=$used_rel?>" max="1"><?=$perc_used?></progress>

            </div>


            <hr>

            <div class="container_plans">
                <div class="card">
                    <div class="card_link">
                        <div class="content">
                            <h3>STARTER</h3>
                            <p class="type">0 PKCT</p>
                            <p class="description">Space: 1GB</p>
                            <a class="download <?=$style_starter?>"> <?=$status_starter?> </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card_link">
                        <div class="content">
                            <h3>STARTER PLUS</h3>
                            <p class="type">1000 PKCT</p>
                            <p class="description">Space: 5GB</p>
                            <a href="https://exchange.pancakeswap.finance/#/swap?outputCurrency=0xf1fad91c3afb4da2417b7af5fdbaf552c6aa9636&inputCurrency=" target="_blank" class="download <?=$style_starter_plus?>"> <?=$status_starter_plus?> </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card_link">
                        <div class="content">
                            <h3>EXPERT</h3>
                            <p class="type">10000 PKCT</p>
                            <p class="description">Space: 60GB</p>
                            <a href="" class="download <?=$style_expert?>"> <?=$status_expert?> </a>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card_link">
                        <div class="content">
                            <h3>PRO</h3>
                            <p class="type">1000000 PKCT</p>
                            <p class="description">Space: 800GB</p>
                            <a href="" class="download <?=$style_pro?>"> <?=$status_pro?> </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script>
        $(document).ready(function() {



            /*$(".menu_icon").click(function(e) {
                $("#mySidenav").toggleClass('is-open_menu');
                $("#main").toggleClass('is-open_main');

                e.preventDefault();
            });*/

            $("#container").click(function(e) {
                var width = $(window).width();

                if ($("#root").hasClass("mis-open_main") && width <= 767) {
                    $("#sidebar").removeClass('mis-open_menu');
                    $("#root").removeClass('mis-open_main');
                    e.preventDefault();
                }
            });


            $("#mmenu_button").click(function(e) {
                $("#sidebar").toggleClass('mis-open_menu');
                $("#root").toggleClass('mis-open_main');
                e.preventDefault();
            });




            $("#organizzazione").click(function(e) {
                $("#org_child").toggleClass('mcollapsed');
                $("#org_child").toggleClass('mopen_org');

                if ($("#org_child").hasClass('mopen_org')) {
                    $("#org_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(180deg)"
                    });

                } else {
                    $("#org_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                }
                if ($("#finanze_child").hasClass('mopen_fin')) {
                    $("#finanze_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#finanze_child").removeClass('mopen_fin');
                    $("#finanze_child").addClass('mcollapsed');

                }

                if ($("#files_child").hasClass('mopen_files')) {
                    $("#files_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#files_child").removeClass('mopen_files');
                }




                e.preventDefault();
            });

            $("#finanze").click(function(e) {
                $("#finanze_child").toggleClass('mopen_fin');
                $("#finanze_child").toggleClass('mcollapsed');

                if ($("#finanze_child").hasClass('mopen_fin')) {
                    $("#finanze_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(180deg)"
                    });

                } else {
                    $("#finanze_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                }

                if ($("#org_child").hasClass('mopen_org')) {
                    $("#org_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#org_child").removeClass('mopen_org');
                    $("#org_child").addClass('mcollapsed');

                }


                if ($("#files_child").hasClass('mopen_files')) {
                    $("#files_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#files_child").removeClass('mopen_files');
                }



                e.preventDefault();
            });


            $("#files").click(function(e) {
                $("#files_child").toggleClass('mopen_files');
                if ($("#files_child").hasClass('mopen_files')) {
                    $("#files_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(180deg)"
                    });

                } else {
                    $("#files_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                }

                if ($("#org_child").hasClass('mopen_org')) {
                    $("#org_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#org_child").removeClass('mopen_org');
                    $("#org_child").addClass('mcollapsed');

                }

                if ($("#finanze_child").hasClass('mopen_fin')) {
                    $("#finanze_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#finanze_child").removeClass('mopen_fin');
                    $("#finanze_child").addClass('mcollapsed');

                }


                e.preventDefault();
            });




        });
    </script>

</body>

</html>
<?php } ?>