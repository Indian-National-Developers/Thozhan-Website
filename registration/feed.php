<?php
  include_once('db.php');
  include("FeedWriter.php");

  $dd = '|||';
  $TestFeed = new FeedWriter(RSS2);
  $TestFeed->setTitle('Thozhan Volunteers"');
  $TestFeed->setLink('http://thozhan.org/');
  $TestFeed->setDescription(
        'nothing much'
  );

  mysql_connect($host, $username, $password);
  mysql_select_db($db_name);
  $result = mysql_query("select * from registration");
  $counter = 0;
  while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

      $counter++;

      $newItem = $TestFeed->createNewItem();
      $newItem->setTitle($row['registration'] . $counter);
      $newItem->setLink('http://thozhan.org/' . $counter . '.php');
      $desc = $row['id'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['name'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['gender'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['bloodGroup'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['address'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['city'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['pincode'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['interests'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['phone'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['mailID'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['facebook'] . ' ' .  $dd . ' ';
      $desc = $desc . $row['timeToVolunteer'] . ' ' .  $dd . ' ';
      $newItem->setDescription($desc);

      $newItem->setDate($row['createdOn']);
      $TestFeed->addItem($newItem);
  }

  $TestFeed->genarateFeed();

?>
