<?php
require_once 'common.php';
require_once 'dbfuncs.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    if(!empty($_REQUEST['user']) && !empty($_REQUEST['subject'])
        && !empty($_REQUEST['message'])) {
        $msgSQL = "insert into messages(user_id, subject, message) values('" . 
                    $_REQUEST['user'] . "','" . $_REQUEST['subject'] . "','"
                    . $_REQUEST['message'] . "')";

        $inserted = insertQuery($msgSQL);
        if($inserted === false) {
            echo 'Unable to send message. Sorry.';
        }
        else {
            echo 'Message successfully sent! Hooray!';
        }
    }
}
else {
    $userSQL  = "select id, firstname, surname from users";
    $userList = getSelect($userSQL);

    if(!$userList) die('Unable to retrieve users to message');
    $select = "<select name='user' id='user'>";
    foreach($userList as $user)
        $select .= "<option value='" . $user[0] . "'>" . $user[1]
        . " " . $user[2] . "</option>";
    $select .= "</select>";
?>
<form method="POST">
    <p>Select a user you wish to message</p>
    <label for="user">User:</label>
    <?=$select?> <br/>
    <label for="subject">Subject:</label>
    <input name="subject" id="subject" /> <br />
    <label for="message">Message:</label>
    <textarea rows="10" cols="50" name="message"></textarea>
    <input type="submit" value="Send pigeon">
</form>
<form method="POST">

  <div class="form-group">

    <label for="user">User:</label>

    <select class="form-control" name="user" id="user">

      <option>barry</option>

      <option>allen</option>

      <option>flash</option>

      <option>gordon</option>

      <option>ramsey</option>

    </select>

  </div>

   <div class="form-group">

    <label for="Subject">Subject</label>

    <input type="text" class="form-control" name="subject" id="Subject" placeholder="subject">

  </div>

  

  <div class="form-group">

    <label for="message">Message</label>

    <textarea class="form-control" name="message" id="message" rows="3"></textarea>

  </div>

</form>

<?php
}
require_once 'footer.php';
?>
