<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SECM Meeting Booking System</title>
    <!-- Style Sheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php
      // Variables
      $currentYear = date("Y");
      $currentMonth = date("m");
      $date = $currentYear.'-'.$currentMonth.'-01';
      $firstDayOfMonth = date("N", strtotime($date));
      $totalDaysOfMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
      $totalDaysOfMonthDisplay = ($firstDayOfMonth == 7)?($totalDaysOfMonth):($totalDaysOfMonth + $firstDayOfMonth);
      $boxDisplay = ($totalDaysOfMonthDisplay <= 35)?35:42;
    ?>
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="calendar">
            <table class="table table-bordered">
              <tr>
                <th class="col-xs-1 calendar_header">Sun</th>
                <th class="col-xs-1 calendar_header">Mon</th>
                <th class="col-xs-1 calendar_header">Tue</th>
                <th class="col-xs-1 calendar_header">Wed</th>
                <th class="col-xs-1 calendar_header">Thu</th>
                <th class="col-xs-1 calendar_header">Fri</th>
                <th class="col-xs-1 calendar_header">Sat</th>
              </tr>
              <tr>
              <?php
                $dayCount = 1;
                // for each day of the month
                for($i = 1; $i <= $boxDisplay; $i++)
                {
                  // print date cells
                  if(($i >= $firstDayOfMonth + 1 || $firstDayOfMonth == 7) && $i <= ($totalDaysOfMonthDisplay))
                  {
                    $currentDate = $currentYear.'-'.$currentMonth.'-'.$dayCount;
                    // highlight todays date
                    if(strtotime($currentDate) == strtotime(date("Y-m-d")))
                    {
                      echo '<td date="'.$currentDate.'" id="'.$i.'" class="calendar_cell lightblue">';
                    }
                    // else print other dates normally
                    else
                    {
                      echo '<td date="'.$currentDate.'" id="'.$i.'" class="calendar_cell">';
                    }
                    echo '<a href="day.php?date='.$currentDate.'"><span>' . $dayCount . '</span></a>';
                    echo '</td></a>';
                    // skip to next table row after 7 cells
                    if($i % 7 == 0) { echo '</tr><tr>';}
                    // increment dayCount
                    $dayCount++;
                  }
                  else
                  // print blank cells
                  { ?>
                    <td class="calendar_cell" id="<?php $i ?>">&nbsp;</td>
                    <?php } }  ?>
            </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
