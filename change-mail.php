<?php
include("configs.php");
$page_cat = "settings";
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
        header('Location: account_log.php');		
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb">
<head>
<title><?php echo $website['title']; ?><?php echo $Reg['Reg37']; ?></title>
<meta content="false" http-equiv="imagetoolbar" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<link rel="shortcut icon" href="wow/static/local-common/images/favicons/wow.png" type="image/x-icon" />
<link rel="search" type="application/opensearchdescription+xml" href="http://eu.battle.net/en-gb/data/opensearch" title="Battle.net Search" />
<link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/management/common.css" />
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common-ie.css?v22" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common-ie6.css?v22" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="all" href="wow/static/local-common/css/common-ie7.css?v22" /><![endif]-->
<link rel="stylesheet" type="text/css" media="all" href="wow/static/css/bnet.css" />
<link rel="stylesheet" type="text/css" media="print" href="wow/static/css/bnet-print.css" />
<!--[if IE]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/bnet-ie.css?v21" /><![endif]-->
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="all" href="wow/static/css/bnet-ie6.css?v21" /><![endif]-->
<script type="text/javascript" src="wow/static/local-common/js/third-party/jquery-1.4.4-p1.min.js"></script>
<script type="text/javascript" src="wow/static/local-common/js/core.js"></script>
<script type="text/javascript" src="wow/static/local-common/js/tooltip.js"></script>
<!--[if IE 6]> <script type="text/javascript">
//<![CDATA[
try { document.execCommand('BackgroundImageCache', false, true) } catch(e) {}
//]]>
</script>
<![endif]-->
<script type="text/javascript">
//<![CDATA[
Core.staticUrl = '/account';
Core.sharedStaticUrl= 'wow/static/local-common';
Core.baseUrl = '/account';
Core.supportUrl = 'http://eu.battle.net/support/';
Core.secureSupportUrl= 'https://eu.battle.net/support/';
Core.project = 'bam';
Core.locale = 'en-gb';
Core.buildRegion = 'eu';
Core.shortDateFormat= 'dd/MM/yyyy';
Core.dateTimeFormat = 'dd/MM/yyyy HH:mm';
Core.loggedIn = true;
Flash.videoPlayer = 'http://eu.media.blizzard.com/global-video-player/themes/bam/video-player.swf';
Flash.videoBase = 'http://eu.media.blizzard.com/bam/media/videos';
Flash.ratingImage = 'http://eu.media.blizzard.com/global-video-player/ratings/bam/rating-pegi.jpg';
Flash.expressInstall= 'http://eu.media.blizzard.com/global-video-player/expressInstall.swf';
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-544112-16']);
_gaq.push(['_trackPageview']);
_gaq.push(['_trackPageLoadTime']);
//]]>
</script>
</head>
<body class="en-gb logged-in">
<div id="layout-top">
<div class="wrapper">
<div id="header">
<?php include("functions/header_account.php"); ?>
<?php include("functions/footer_man_nav.php"); ?>
</div>
</div>
</div>
<div id="layout-middle">
<div class="wrapper">
<div id="content">
<div id="page-header">
<span class="float-right"><span class="form-req">*</span> <?php echo $Reg['Reg']; ?></span>
<h2 class="subcategory"><?php echo $Reg['Reg1']; ?></h2>
<h3 class="headline">Change E-Mail</h3>
</div>
<div id="page-content" class="page-content">
<p><?php echo $Reg['Reg3']; ?><b><?php echo $Reg['Reg4']; ?></b> be Offline to this tool works. Use this tool to change your E-Mail.</p>
<form autocomplete="off" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<input type="hidden" name="csrftoken" value="" />
<?php 
if(isset($_POST['submit']))
{
        function valid_email($email) {         //Small function to validate the email
          $result = TRUE;
          if(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$", $email)) {
              $result = FALSE;
          }
          return $result;
        }
          
        $account = mysql_real_escape_string($_POST['account']);
        $curMail = mysql_real_escape_string($_POST['curMail']);
        $newMail = mysql_real_escape_string($_POST['newMail']);
        $newMail1 = mysql_real_escape_string($_POST['newMail1']);

        $eaccount = strtoupper($account);

        $con = mysql_connect($serveraddress, $serveruser, $serverpass) or die(mysql_error());
        mysql_select_db($server_adb, $con) or die(mysql_error());
        $query = "SELECT id FROM account WHERE username = '".$eaccount."' AND UPPER(email) = UPPER('".$curMail."')";

        $result = mysql_query($query) or die(mysql_error());
        $numrows = mysql_num_rows($result);

        if($newMail != $newMail1) { die("<p align='center'><font color='red'>".$Reg['Reg6']."</font><br><br>E-Mail Addresses MUST match<br><br>".$Reg['Reg8']."</p><p align='center'><a href='change-mail.php'><button class='ui-button button1' type='submit' value='back' tabindex='1'><span><span>".$re['back']."</span></span></button></a></p>"); }

        if(!valid_email($newMail)){die("<p align='center'><font color='red'>".$Reg['Reg6']."</font><br><br>The new E-Mail address is not a valid E-mail.<br><br>".$Reg['Reg8']."</p><p align='center'><a href='change-mail.php'><button class='ui-button button1' type='submit' value='back' tabindex='1'><span><span>".$re['back']."</span></span></button></a></p>"); }

        if($numrows == 0) { die("<p align='center'><font color='red'>".$Reg['Reg6']."</font><br><br>Invalid E-Mail address, write your current E-Mail correctly.<br><br>".$Reg['Reg15']."</p><p align='center'><a href='change-mail.php'><button class='ui-button button1' type='submit' value='back' tabindex='1'><span><span>".$re['back']."</span></span></button></a></p>"); }

        $query = "UPDATE account SET email = '".$newMail."' WHERE username = '".$eaccount."'";
        $result = mysql_query($query) or die(mysql_error());
        

        echo "<p align='center'>The E-Mail for account<br><br>'<b><font color='green'>".$account."</font></b>'<br><br>".$Reg['Reg17']."<p align='center'><a href='account_man.php'><button class='ui-button button1' type='submit' value='back' tabindex='1'><span><span>".$re['back']."</span></span></button></a></p>";
        //close mysql connection
        mysql_close($con);
}
else{
?>
<div class="form-row required">
<label for="firstname" class="label-full ">
<strong> <?php echo $Reg['Reg18']; ?>
</strong>
<span class="form-required">*</span>
</label>
<input type="text" id="firstname" name="account" value="<?php echo strtolower($_SESSION['username']); ?>" class=" input border-5 glow-shadow-2 form-disabled" maxlength="16" tabindex="1" />
</div>
<div class="form-row required">
<label for="curMail" class="label-full ">
<strong> Current E-Mail
</strong>
<span class="form-required">*</span>
</label>
<input type="text" id="curMail" name="curMail" value="" class=" input border-5 glow-shadow-2" maxlength="50" tabindex="1" />
</div>
<div class="form-row required">
<label for="newMail" class="label-full ">
<strong> New E-Mail
</strong>
<span class="form-required">*</span>
</label>
<input type="text" id="newMail" name="newMail" value="" class=" input border-5 glow-shadow-2" maxlength="50" tabindex="1" />
</div>
<div class="form-row required">
<label for="confirmMail" class="label-full ">
<strong> Confirm E-Mail
</strong>
<span class="form-required">*</span>
</label>
<input type="text" id="confirmMail" name="newMail1" value="" class=" input border-5 glow-shadow-2" maxlength="50" tabindex="1" />
</div>
<fieldset class="ui-controls " >
<button
class="ui-button button1 "
type="submit"
name="submit"

id="settings-submit"
value="Change Mail"
tabindex="1">
<span>
<span><?php echo $Reg['Reg35']; ?></span>
</span>
</button>
<a class="ui-cancel "
href="account_man.php"
tabindex="1">
<span>
<?php echo $Reg['Reg36']; ?></span>
</a>
</fieldset>
</form>
<?php
}
?>
</div>
</div>
</div>
</div>
<div id="layout-bottom">
<?php include("functions/footer_man.php"); ?>
</div>
<script type="text/javascript">
//<![CDATA[
var xsToken = 'b213c993-d61d-4957-9141-9da399fd7d54';
var Msg = {
support: {
ticketNew: 'Ticket {0} was created.',
ticketStatus: 'Ticket {0}�s status changed to�{1}.',
ticketOpen: 'Open',
ticketAnswered: 'Answered',
ticketResolved: 'Resolved',
ticketCanceled: 'Cancelled',
ticketArchived: 'Archived',
ticketInfo: 'Need�Info',
ticketAll: 'View All Tickets'
},
cms: {
requestError: 'Your request cannot be completed.',
ignoreNot: 'Not ignoring this user',
ignoreAlready: 'Already ignoring this user',
stickyRequested: 'Sticky requested',
postAdded: 'Post added to tracker',
postRemoved: 'Post removed from tracker',
userAdded: 'User added to tracker',
userRemoved: 'User removed from tracker',
validationError: 'A required field is incomplete',
characterExceed: 'The post body exceeds XXXXXX characters.',
searchFor: "Search for",
searchTags: "Articles tagged:",
characterAjaxError: "You may have become logged out. Please refresh the page and try again.",
ilvl: "Item Lvl",
shortQuery: "Search requests must be at least three characters long."
},
bml: {
bold: 'Bold',
italics: 'Italics',
underline: 'Underline',
list: 'Unordered List',
listItem: 'List Item',
quote: 'Quote',
quoteBy: 'Posted by {0}',
unformat: 'Remove Formating',
cleanup: 'Fix Linebreaks',
code: 'Code Blocks',
item: 'WoW Item',
itemPrompt: 'Item ID:',
url: 'URL',
urlPrompt: 'URL Address:'
},
ui: {
viewInGallery: 'View in gallery',
loading: 'Loading�',
unexpectedError: 'An error has occurred',
fansiteFind: 'Find this on�',
fansiteFindType: 'Find {0} on�',
fansiteNone: 'No fansites available.'
},
grammar: {
colon: '{0}:',
first: 'First',
last: 'Last'
},
fansite: {
achievement: 'achievement',
character: 'character',
faction: 'faction',
'class': 'class',
object: 'object',
talentcalc: 'talents',
skill: 'profession',
quest: 'quest',
spell: 'spell',
event: 'event',
title: 'title',
arena: 'arena team',
guild: 'guild',
zone: 'zone',
item: 'item',
race: 'race',
npc: 'NPC',
pet: 'pet'
}
};
//]]>
</script>
<script type="text/javascript" src="wow/static/js/bam.js?v21"></script>
<script type="text/javascript" src="wow/static/local-common/js/tooltip.js?v22"></script>
<script type="text/javascript" src="wow/static/local-common/js/menu.js?v22"></script>
<script type="text/javascript">
$(function() {
Menu.initialize();
Menu.config.colWidth = 190;
Locale.dataPath = 'data/i18n.frag.xml';
});
</script>
<!--[if lt IE 8]>
<script type="text/javascript" src="wow/static/local-common/js/third-party/jquery.pngFix.pack.js?v22"></script>
<script type="text/javascript">$('.png-fix').pngFix();</script>
<![endif]-->
<script type="text/javascript" src="wow/static/js/settings/settings.js?v21"></script>
<script type="text/javascript" src="wow/static/js/settings/password.js?v21"></script>
<script type="text/javascript">
//<![CDATA[
Core.load("wow/static/local-common/js/overlay.js?v22");
Core.load("wow/static/local-common/js/search.js?v22");
Core.load("wow/static/local-common/js/third-party/jquery-ui-1.8.6.custom.min.js?v22");
Core.load("wow/static/local-common/js/third-party/jquery.mousewheel.min.js?v22");
Core.load("wow/static/local-common/js/third-party/jquery.tinyscrollbar.custom.js?v22");
Core.load("wow/static/local-common/js/login.js?v22", false, function() {
Login.embeddedUrl = '<?php echo $website['root'];?>loginframe.php';
});
//]]>
</script>
<script type="text/javascript">
//<![CDATA[
(function() {
var ga = document.createElement('script');
var src = "https://ssl.google-analytics.com/ga.js";
if ('http:' == document.location.protocol) {
src = "http://www.google-analytics.com/ga.js";
}
ga.type = 'text/javascript';
ga.setAttribute('async', 'true');
ga.src = src;
var s = document.getElementsByTagName('script');
s = s[s.length-1];
s.parentNode.insertBefore(ga, s.nextSibling);
})();
//]]>
</script>
</body>
</html>