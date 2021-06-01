<?php  

require_once 'utils/database.php';
require_once 'utils/check_session.php';

session_start();

if(!check_session()){
    header('Location: reception_login.php');
    exit();
}

//query
$sql = "
	select *
	from files f
	where U_ID = ?;
    ";

$stmt=$pdo->prepare($sql);
$stmt->execute([$_SESSION['U_ID']]);
$RESULT = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pocket | Files</title>
    <link rel="stylesheet" href="../style/style_menu2.css">
    <link rel="stylesheet" href="../style/style_show_files.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
</head>

<body>

    <nav id="sidebar" class="msidebar mis-open_menu">

        <div class="mscroll_wrapper">

            <a class="msidebar-brand" href="index.html">
                <svg class="msvgprova" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
              <path d="M19.4,4.1l-9-4C10.1,0,9.9,0,9.6,0.1l-9,4C0.2,4.2,0,4.6,0,5s0.2,0.8,0.6,0.9l9,4C9.7,10,9.9,10,10,10s0.3,0,0.4-0.1l9-4
                C19.8,5.8,20,5.4,20,5S19.8,4.2,19.4,4.1z"/>
              <path d="M10,15c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
                c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,15,10.1,15,10,15z"/>
              <path d="M10,20c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
                c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,20,10.1,20,10,20z"/>
            </svg>

                <span class="malign-middle">Pocket</span>
            </a>

            <ul class="msidebar-nav">
                <li class="msidebar-header">
                    Profile
                </li>
                <li class="msidebar-item">
                    <a href="dashboard.php" data-toggle="collapse" class="mnonactive">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" class="msidebar-item_icon" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                        <span class="">Dashboard</span>

                </li>

                <li class="msidebar-item">
                    <a id="organizzazione" data-toggle="collapse" class="msidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="msidebar-item_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>                        <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Organizzazione</span>
                        <svg id="org_arrow" xmlns="http://www.w3.org/2000/svg" class="mextended_arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle"><polyline points="6 9 12 15 18 9"></polyline></svg>

                    </a>
                    <ul id="org_child" class="mchild mcollapsed">
                        <li class="msidebar-item"><a class="msidebar-link" href="get_events.php">Calendario</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="insert_event.php">Aggiungi evento</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="comingsoon.php">Promemoria</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="viaggi.php">Viaggi</a></li>
                    </ul>
                </li>

                <li class="msidebar-item">
                    <a id="finanze" data-toggle="" class="msidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="msidebar-item_icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>                        Finanza
                        <svg id="finanze_arrow" xmlns="http://www.w3.org/2000/svg" class="mextended_arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down align-middle mr-2"><polyline points="6 9 12 15 18 9"></polyline></svg>

                    </a>
                    <ul id="finanze_child" class="mchild mcollapsed">
                        <li class="msidebar-item"><a class="msidebar-link" href="crypto_pages.php">Crypto</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="comingsoon.php">Conto</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="comingsoon.php">Carte</a></li>
                    </ul>
                </li>

            </ul>



            <ul class="msidebar-nav">
                <li class="msidebar-header">
                    Files
                </li>
                <li class="msidebar-item">
                    <a id="files" href="" class="msidebar-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" class="msidebar-item_icon" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                        <i class="malign-middle" data-feather="sliders"></i> <span class="align-middle">Files</span>
                        <svg id="files_arrow" xmlns="http://www.w3.org/2000/svg" class="mextended_arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="align-middle"><polyline points="6 9 12 15 18 9"></polyline></svg>

                    </a>
                    <ul id="files_child" class="mchild mopen_files" data-parent="#sidebar">
                        <li class="msidebar-item"><a class="msidebar-link" style="color: rgba(255, 255, 255, 0.9);" href="">My Files</a></li>
                        <li class="msidebar-item"><a class="msidebar-link" href="insert_file.php">Upload</a></li>

                    </ul>
                </li>

                <li class="msidebar-item">
                    <a href="crypto_pages.php" data-toggle="collapse" class="msidebar-link">
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


<?php
$pos_file = -1;
foreach ($RESULT as $file) {

	$content_type = explode('/', $file['CONTENT_TYPE']);
	$pos_file++;
	if($pos_file === 0){?>
		<div class="row">
	<?php } ?>
	<div class="card">
        <a href="show_file.php?F_ID=<?=$file['F_ID']?>" class="card_link">
	        <div class="content">
		        <h3><?= $file['TITOLO']?></h3>
		        <p class="type"><?= $content_type[0] ?></p>
		        <p class="description"><?= $file['DESCRIZIONE']?></p>

		        <div>
                    <a href="download_file.php?F_ID=<?=$file['F_ID']?>" class="download">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="svg_download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    </a>

                    <a href="delete_file.php?F_ID=<?=$file['F_ID']?>"class="trash">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 align-middle me-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                    </a>
                </div>
	        </div>
        </a>
    </div>
    <?php
    if($pos_file === 3){?>
	</div>
	<?php $pos_file = -1;}
}?>
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
                }


                if ($("#files_child").hasClass('mopen_files')) {
                    $("#files_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#files_child").removeClass('mopen_files');
                    $("#files_child").addClass('mcollapsed');
                }



                e.preventDefault();
            });

            $("#files").click(function(e) {
                $("#files_child").toggleClass('mopen_files');
                $("#files_child").toggleClass('mcollapsed');

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

                if ($("#org_child").removeClass('mopen_org')) {
                    $("#org_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#org_child").removeClass('mopen_org');
                }

                if ($("#finanze_child").hasClass('mopen_fin')) {
                    $("#finanze_arrow").css({
                        "transition": "0.3s ease-in-out",
                        "transform": "rotate(0deg)"
                    });

                    $("#finanze_child").removeClass('mopen_fin');
                }


                e.preventDefault();
            });
        });
    </script>
</body>
</html>

