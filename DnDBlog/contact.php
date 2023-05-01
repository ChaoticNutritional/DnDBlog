<?php session_start();

include 'persistent/header.php';
include 'persistent/navigation.php';

$success_message = "";
$error_message ="";


if (isset($_GET['formType'])) {
    $formType = $_GET['formType'];
}

if (isset($_GET['success_message'])) {
    $success_message = $_GET['success_message'];
}

if (isset($_GET['error_message'])) {
    $error_message = $_GET['error_message'];
}

echo "<div class='alert alert-success'>$success_message</div>";
echo "<div class='alert alert-error'>$error_message</div>";
?>


<form action="contact.php" method="get">
    <label for="formType">Choose a form:</label>
    <select id="formType" name="formType">
        <option value="">Select a form</option>
        <option value="feedback">Feedback Form</option>
        <option value="help">Help Form</option>
    </select>
    <input type="submit" value="Submit">
</form>



<?php
if ($formType == "feedback") {
    //display the feedback form
    //note you should use a post  method not a get to submit the form data.
?>
    <form action="functions/mailaway.php" method="POST">
        <H1>Feedback Form</H1>
        <!--Name entry-->
        <div class="form-group" style="display: inline-block;">
            <label for="firstname">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <!--HELP ONLY: issue description-->
        <div id="describeIssue">
            <textarea id="describeIssueTextarea" class="paddedText" rows="3" cols="30" name="Additional Comments" placeholder="Computer name, device name, model #, phone, etc..." aria-label="Provide additional context for your issue"></textarea>
        </div>

        <!--country/state-->
        <div class="inline">
            <label for="country">Country: </label>
            <input list="countries" name="country" id="country">
            <datalist id="countries">
                <option value="US" label="United states">
                <option value="--" label="--">
            </datalist>
            <label class="nudge" for="state"> State: </label>
            <input class="abbrev" list="states" name="state" id="state">
            <br>

        </div>

        <!--city/zip-->
        <div class="margin" id="zipSect">
            <label class="plain">City: <input name="City" class="nudge" type="text" autocomplete="on"></label>

            <label class="plain">Zip Code: <input id="zip" name="Zip" class="midsize" type="text" autocomplete="on"></label>
        </div>

        <!--phoneNum-->
        <div id="phone">
            <label for="phone" class="plain">Phone: </label>
            <input name="phone" class="paddedText" id="phone" type="tel" placeholder="(123) 123 4567">
            <span><?php if (isset($phoneErr)) echo $phoneErr; ?></span>
        </div>


        <!--REVIEW ONLY: additional comments-->
        <div id="additionalComments">
            <textarea class="paddedText" rows="3" cols="30" name="Additional Comments" placeholder="Additional comments" aria-label="Enter additional comments here"></textarea>
        </div>
        <!--REVIEW ONLY: rating 1 - 5-->
        <div id="rating">
            <div class="star-rating">
                <fieldset>
                    <legend>Rate us!</legend>
                    <div class="rating-option">
                        <span class="number">1</span>
                        <input type="radio" name="rating" value="1" required aria-label="One Star">
                    </div>
                    <div class="rating-option">
                        <span class="number">2</span>
                        <input type="radio" name="rating" value="2" required aria-label="Two Stars">
                    </div>
                    <div class="rating-option">
                        <span class="number">3</span>
                        <input type="radio" name="rating" value="3" required aria-label="Three Stars">
                    </div>
                    <div class="rating-option">
                        <span class="number">4</span>
                        <input type="radio" name="rating" value="4" required aria-label="Four Stars">
                    </div>
                    <div class="rating-option">
                        <span class="number">5</span>
                        <input type="radio" name="rating" value="5" required aria-label="Five Stars">
                    </div>
                </fieldset>
            </div>
        </div>
        <!--button-->
        <div class="rightSide">
            <input type="hidden" name="ToAddress" value="jacktvicari@gmail.com">
            <input type="hidden" name="CCAddress" value="jacktvicari@gmail.com">
            <input type="hidden" name="Subject" value="TEST">
            <input type="hidden" name="formType" value="feedback">

            <div class="rightSide">
                <input class="button" type="submit" name="submit_form" value="Submit" id="submit_form">
                <input class="button" type="reset" value="Reset">
            </div>
    </form>
<?php
} //end of display of feedback form
if ($formType == "help") {
    //display the help form
?>
    <form action="functions/mailaway.php" method="POST">
        <H1>Help Form</H1>
        <!--Name entry-->
        <div class="rowLike" id="nameSect">
            <label for="firstname">First Name:</label>
            <input name="firstname" class="paddedText" type="text" autocomplete="on" id="firstname">

            <label for="lastname">Last Name:</label>
            <input name="lastname" class="paddedText" type="text" autocomplete="on" id='lastname'>
        </div>

        <!--HELP ONLY: issue description-->
        <div id="describeIssue">
            <textarea id="describeIssueTextarea" class="paddedText" rows="3" cols="30" name="Additional Comments" placeholder="Computer name, device name, model #, phone, etc..." aria-label="Provide additional context for your issue"></textarea>
        </div>

        <!--email-->
        <div id="email" class="rowLike">
            <label class="plain" for="emailSect">Email: </label>
            <input name="email" class="paddedText" id="emailSect" type="email" placeholder="john.smith@gmail.com" aria-label="Enter email here">
        </div>

        <!--phoneNum-->
        <div id="phone">
            <label for="phone" class="plain">Phone: </label>
            <input name="phone" class="paddedText" id="phone" type="tel" placeholder="(123) 123 4567">
        </div>

        <!--country/state-->
        <div class="inline">
            <label for="country">Country: </label>
            <input list="countries" name="country" id="country">
            <datalist id="countries">
                <option value="US" label="United states">
                <option value="--" label="--">
            </datalist>
            <label class="nudge" for="state"> State: </label>
            <input class="abbrev" list="states" name="state" id="state">
            <br>

        </div>

        <!--city/zip-->
        <div class="margin" id="zipSect">
            <label class="plain">City: <input name="City" class="nudge" type="text" autocomplete="on"></label>

            <label class="plain">Zip Code: <input id="zip" name="Zip" class="midsize" type="text" autocomplete="on"></label>
        </div>

        <!--button-->
        <div class="rightSide">
            <input type="hidden" name="ToAddress" value="jacktvicari@gmail.com">
            <input type="hidden" name="CCAddress" value="jacktvicari@gmail.com">
            <input type="hidden" name="Subject" value="TEST">
            <input type="hidden" name="formType" value="help">

            <div class="rightSide">
                <input class=" button" type="submit" name="submit_form" value="Submit" id="submit_form">
                <input class="button" type="reset" value="Reset">
            </div>
    </form>
<?php
} //end of help form
?>
</main>
</body>


<?php include 'persistent/footer.php'; ?>

</html>