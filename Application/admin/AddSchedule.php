<?php

session_start();

if ($_SESSION["login_admin"] == null) {


    header("location:  index.php");
} else {

    include_once('include/admin_navbar.php');





    if (isset($_POST["btn-search-sch"])) {

        $class_id = $_POST["class-name"];
        $section_name = $_POST["section-name"];


        ///fetch the correspondind class name

        $c_n = 0;

        $query = " SELECT class_name as '$c_n' FROM class_tb WHERE class_id='$class_id' ";
        $query_run = mysqli_query($connection, $query);
        $result = mysqli_fetch_assoc($query_run);

        $class_name = $result["$c_n"];



        //////////////Fetching section id

        $s_id = 0;
        $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
        $query_run = mysqli_query($connection, $query);
        $result = mysqli_fetch_assoc($query_run);

        $section_id = $result["$s_id"];



?>

        <br><br>

        <form action="" method="POST">

            <input type="hidden" name="class-name" value="<?php echo "$class_id" ?>">
            <input type="hidden" name="section-name" value="<?php echo "$section_name" ?>">

            <select name="subject-name" style="width: 40%; margin-left: 45px; display: inline-block;" class="form-control" required>


                <option value="" disabled selected>Select Subject</option>

                <?php

                $connection = mysqli_connect("localhost", "root", "", "sms6");
                $query = "SELECT subject_id,subject_name FROM subject_tb where class_id='$class_id'";

                $query_run = mysqli_query($connection, $query);

                if (mysqli_num_rows($query_run) > 0) {

                    while ($row = mysqli_fetch_assoc($query_run)) {
                        # code...

                ?>
                        <option value='<?php echo $row["subject_id"] ?>'> <?php echo $row["subject_name"] ?> </option>


                <?php
                    }
                } else {
                    echo "No record found";
                }
                ?>


            </select>




            <select name="day-name" style="width: 40%; margin-left: 45px; display: inline-block;" class="form-control" required>
                <option value="" disabled selected>Select Day</option>
                <option>Monday</option>
                <option>Tuesday</option>
                <option>Wednesday</option>
                <option>Thursday</option>
                <option>Friday</option>
                <option>Saturday</option>

            </select>

            <br><br>
            <button type="submit" style="margin-left: 45px;" class="btn btn-info" name="btn-search-slot">Search Slot</button>

            </div>
        </form>


        <?php

    }





    if (isset($_POST["btn-search-slot"])) {

        $class_id = $_POST["class-name"];
        $section_name = $_POST["section-name"];
        $subject_id = $_POST["subject-name"];
        $day = $_POST["day-name"];

        ///fetch the correspondind section id

        $s_id = 0;
        $query = " SELECT section_id as '$s_id' FROM section WHERE section_name='$section_name' and class_id='$class_id' ";
        $query_run = mysqli_query($connection, $query);
        $result = mysqli_fetch_assoc($query_run);

        $section_id = $result["$s_id"];


        $query = "SELECT * FROM schedule_tb where subject_id='$subject_id' and class_id='$class_id' and section_id=$section_id and day='$day'";

        $query_run = mysqli_query($connection, $query);


        if (mysqli_num_rows($query_run) > 0) {

            echo "<h2>This subject is already schedule</h2>";
        } else {



            $query = "SELECT * FROM schedule_tb where class_id='$class_id' and section_id=$section_id and day='$day'";

            $query_run = mysqli_query($connection, $query);

            $slot1 = "8-9";
            $slot2 = "9-10";
            $slot3 = "10-11";
            $slot4 = "11-12";
            $slot5 = "13-14";

            $slot_nr = ["8-9", "9-10", "10-11", "11-12", "12-13"];

            if (mysqli_num_rows($query_run) > 0) {



        ?>

                <br><br>

                <form action="AAddSchedule.php" method="post">

                    <input type="hidden" name="class-id" value="<?php echo $class_id ?>">
                    <input type="hidden" name="section-id" value="<?php echo $section_id ?>">
                    <input type="hidden" name="subject-id" value="<?php echo $subject_id ?>">
                    <input type="hidden" name="day" value="<?php echo $day ?>">


                    <select name="slot-name" style="width: 30%; margin-left: 220px;" class="form-control" required>
                        <option value="" disabled selected>Slot</option>
                        <option disabled>One Hour Slot</option>
                        <?php
                        $p = 0;
                        while ($row = mysqli_fetch_assoc($query_run)) {

                            $slot_db[$p] =  $row["slot"];

                            $p++;
                            echo "<option disabled>$row[slot]</option>";
                        }

                        $size = count($slot_db);


                        $pr = 0;
                        for ($i = 0; $i < $size; $i++) {
                            if ($slot_db[$i] == $slot1) {

                                $pr++;
                                break;
                            }
                        }

                        if ($pr == 0) {
                            echo "<option>$slot1</option>";
                        }
                        $pr = 0;

                        for ($i = 0; $i < $size; $i++) {
                            if ($slot_db[$i] == $slot2) {
                                $pr++;
                                break;
                            }
                        }


                        if ($pr == 0) {
                            echo "<option>$slot2</option>";
                        }

                        $pr = 0;

                        for ($i = 0; $i < $size; $i++) {
                            if ($slot_db[$i] == $slot3) {
                                $pr++;
                                break;
                            }
                        }
                        if ($pr == 0) {
                            echo "<option>$slot3</option>";
                        }

                        echo "<option disabled>Break</option>";

                        $pr = 0;
                        for ($i = 0; $i < $size; $i++) {
                            if ($slot_db[$i] == $slot4) {
                                $pr++;
                                break;
                            }
                        }

                        if ($pr == 0) {
                            echo "<option>$slot4</option>";
                        }


                        $pr = 0;
                        for ($i = 0; $i < $size; $i++) {
                            if ($slot_db[$i] == $slot5) {
                                $pr++;
                                break;
                            }
                        }

                        if ($pr == 0) {
                            echo "<option>$slot5</option>";
                        }
                        $pr = 0;

                        ?>

                    </select>
                    <br><br>

                    <button type="submit" name="btn-add-schedule" style="margin-left: 220px;" class="btn btn-info">Add Schedule</button>

                </form>

            <?php

            } else {

            ?>
                <br><br>
                <form action="AAddSchedule.php" method="POST">

                    <input type="hidden" name="class-id" value="<?php echo $class_id ?>">
                    <input type="hidden" name="section-id" value="<?php echo $section_id ?>">
                    <input type="hidden" name="subject-id" value="<?php echo $subject_id ?>">
                    <input type="hidden" name="day" value="<?php echo $day ?>">

                    <select name="slot-name" style="width: 30%; margin-left: 220px;" class="form-control" required>
                        <option value="" disabled selected>Slot</option>
                        <option disabled>One Hour Slot</option>
                        <?php
                        echo "<option>$slot1</option>
            <option>$slot2</option>
            <option>$slot3</option>
            <option disabled>Break</option>
            <option>$slot4</option>
            <option>$slot5</option>";
                        ?>


                    </select>
                    <br><br>

                    <button type="submit" name="btn-add-schedule" style="margin-left: 220px;" class="btn btn-info">Add Schedule</button>

                </form>
<?php
            }
        }
    }
}
?>