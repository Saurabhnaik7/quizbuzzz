<?php
session_start();
error_reporting(0);
include('../dbconnection.php');
if (strlen($_SESSION['quizsid']==0)) {
  header('location:logout.php');
  } else{

    $numofques=$_SESSION['numofques'];

    if(!isset($_SESSION['score'])){
      $_SESSION['score']=0;
    }

    if($_POST){
      $selected_choice=$_POST['choice'];
      $reel_num=$_POST['reel_num'];
      $real_num=$_POST['real_num'];
      $next=$reel_num+1;
      $nextqno=$real_num+1;

      $sql="SELECT * from  choices where question_number=:reel_num and is_correct=1";
      $query = $dbh -> prepare($sql);
      $query->bindParam(':reel_num',$reel_num,PDO::PARAM_STR);
      $query->execute();
      $result=$query->fetchAll(PDO::FETCH_OBJ);
      $cnti=1;
      if($query->rowCount() > 0)
      {
        foreach($result as $row)
        { 
          $correct_choice=$row->a_id;
          $cnti=$cnti+1;
        }
      }

      if($correct_choice==$selected_choice){
          $_SESSION['score']++;
      }

      if($real_num==$numofques){
        header("Location:final.php");
        exit();
      }
      else{
        header("Location:question.php?m=".$next."&n=".$nextqno);
      }
    }
  } 
  ?>