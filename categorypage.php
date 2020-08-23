<!--Category page for the webiste. Views the events divided by each category-->
<?php
session_start();
include ('sessions_user.php'); //sessions for users
?>
<!doctype html>
<html lang="en">
	<head>
		<title>Category</title>
		<?php include ('header.php'); ?> <!--header includes all the necessary meta tags and links-->
	</head>
	<body>
    <?php include ('nav.php'); ?><!--navigation bar-->
    <?php include ('loginform.php');?> <!--login form for additional priviledges-->
    <br/>
    <?php include ('categoryview.php')?><!--to display all the events according to their catagory-->
    <div class="grid-container" id="viewalleventgrid">
        <div class="grid-x" >
            <ul class="menu colorless" data-magellan> <!--For faster navigatiob-->
                <li><a href="#Music">Music</a></li>
                <li><a href="#Art">Art</a></li>
                <li><a href="#CookingFest">Cooking/ Fest</a></li>
                <li><a href="#SeminarConference">Seminar/ Conference</a></li>
                <li><a href="#CelebrationParty">Celebration/ Party</a></li>
                <li><a href="#Fundraising">Fundraising</a></li>
                <li><a href="#Sale">Sale</a></li>
                <li><a href="#Educational">Educational</a></li>
                <li><a href="#WorkshopInternship">Workshop/ Internship</a></li>
            </ul>
        </div>
        <div class="grid-x grid-margin-x">
            <div class="sections">
                <section id="Music" data-magellan-target="first">
                    <h3> Music </h3>
                    <?php getCategory('Music');?> <!--gets the events of catagory music-->
                </section>
                <section id="Art" data-magellan-target="second">
                    <h3> Art </h3>
                    <?php getCategory('Art');?><!--gets the events of catagory art -->
                </section>
                <section id="CookingFest" data-magellan-target="third">
                    <h3> Cooking/ Fest  </h3>
                    <?php getCategory('Cooking/Fest');?> <!--gets the events of cooking/fest -->
                </section>
                <section id="SeminarConference" data-magellan-target="fourth">
                    <h3> Seminar/ Conference </h3>
                    <?php getCategory('Seminar/Conference');?> <!--gets the events of seminar/conference -->
                </section>
                <section id="CelebrationParty" data-magellan-target="fifth">
                    <h3> Celebration/ Party </h3>
                    <?php getCategory('Celebration/Party');?><!--gets the events of catagory celebration-->
                </section>
                <section id="Fundraising" data-magellan-target="sixth">
                    <h3> Fundraising </h3>
                    <?php getCategory('Fundraising');?><!--gets the events of catagory fundraising-->
                </section>
                <section id="Sale" data-magellan-target="seventh">
                    <h3> Sale </h3>
                    <?php getCategory('Sale');?><!--gets the events of catagory sale-->
                </section>
                <section id="Educational" data-magellan-target="eigth">
                    <h3> Educational </h3>
                    <?php getCategory('Educational');?><!--gets the events of catagory educational-->
                </section>
                <section id="WorkshopInternship" data-magellan-target="ninth">
                    <h3> Workshop/ Internship</h2>
                    <?php getCategory('Workshop/Internship');?><!--gets the events of catagory workshop-->
                </section>
            </div>
        </div>
    </div>
	<br/>
	<footer>
		<?php include ('footer.php');?> <!--footer includes about us and other necessary website details-->
	</footer>
    </body>
    <!--Java Scripts-->
    <script src="js/vendor/jquery.js"></script>
	<script src="js/vendor/what-input.js"></script>
	<script src="js/vendor/foundation.js"></script>
	<script src="js/app.js"></script>
</html>