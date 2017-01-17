<!--
  TODO:

  1.0   BACKEND:
  1.1   The main CRUD backend is getting close to complete. Needs tidying and a bit of DRY.
  1.2   usermettings linker table needs sorting.
  1.3   all forms need validation. Because the tables are linked by FKs SQL errors will be spat
        if somebody tries to invite a user who doesn't exist within the users table etc.
  1.4   login system needs polishing off, protect pages etc. see TODO in index.php
  1.5   implementation of important users
  1.6   some sort of notification system. Email?
  1.7   Security, though probably out of scope for this assignment. Current basic encryption
        should be fine. Ask Mehmet.

  2.0   FRONTEND:
  2.1   Create a dummy hidden input box on meeting creation form which uses JAVASCRIPT to build
  2.2   input. See IDEA in add-meeting.php.
  2.3   Password confirmation on user creation.
  2.4   once that is complete it's just a case of adding visual elements. Maybe a nice calendar
        grid GUI with users meetings appear in each section, red for cancelled, orange for unconfirmed
        green for confirmed.

  3.0   BONUS:
  3.1   password reset / account retrieval functionality. Quite easy to implement if we add a mailer
        class as mentioned in 1.6 above. Not really needed, but a nice bit of QoL.

-->

<?php
include_once("includes/header.inc.php");
include_once("includes/nav.inc.php");
?>
<h1>Meeting Scheduler</h1>
<h2>Homepage</h2>
<?php include_once("includes/footer.inc.php"); ?>
