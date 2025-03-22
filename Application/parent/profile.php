<?php

session_start();

if ($_SESSION["login_parent"] == null) {
  header("location: index.php");
} else {

  include_once('include/parent_navbar.php');

  ?>

  <div class="newss">
    <div class="col-md-6 col-lg-6 col-sm-12">
      <div class="white-box">
        <h3 class="box-title">Events Calendar</h3>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">
                  <div>Title</div>
                </th>
                <th style="text-align: center;">
                  <div>From</div>
                </th>
                <th style="text-align: center;">
                  <div>To</div>
                </th>
                <th style="text-align: center;">
                  <div>Type</div>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="text-align: center;">1</td>
                <td style="text-align: center;">ss</td>
                <td style="text-align: center;">15-08-2019</td>
                <td style="text-align: center;"><span class="text-success">15-08-2019</span></td>
                <td style="text-align: center;"><span class="label label-info label-rouded"></span> </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<?php

}
?>