<?php
include('vendor/autoload.php');
include('config/config.php');



$fixture_id = (int)$_GET['id'];
$app_id = '1483142';
$app_key = '5506c128345d2a429a4d';
$app_secret = 'a5a527a958487b9f6154';
$app_cluster = 'ap2';

$pusher = new Pusher\Pusher($app_key, $app_secret, $app_id, ['cluster' => $app_cluster]);


$user_ip=$_SERVER['REMOTE_ADDR'];
$check_ip = $con->prepare("SELECT  userip from page_view where page='yourpage' AND userip=?");
$check_ip->execute([$user_ip]);
if($check_ip->fetch()[0] !== $user_ip)
{
    $insertview = $con->prepare("INSERT into page_view VALUES (?,?,?)");
    $insertview->execute([1,'yourpage',$user_ip]);
    $insertview = $con->prepare("INSERT into total_view VALUES (?,?,?)");
    $insertview->execute([1,'yourpage',0]);
    $updateview =$con->prepare("UPDATE `total_view` SET `totalvisit` = `totalvisit`+1 WHERE page=?");
    $updateview->execute(['yourpage']);
}
$stmt = $con->prepare("SELECT `totalvisit` from `total_view` where page=? ");
$stmt->execute(['yourpage']);
$visits = (int)$stmt->fetch()["totalvisit"];

$pusher->trigger('demo_pusher', 'visits', $visits);

if($_POST['step'] === "half_time") {
// insert data into the database
    $stmt = $con->prepare('UPDATE `fixtures` set `half_time` = 1 WHERE `fixtures`.id=?');
    $pusher->trigger('demo_pusher', 'half_time', 'half_time');
    header('Location: live_match.php?id='.$fixture_id);
    $stmt->execute([$fixture_id]);
}

if($_POST['step'] === "full_time") {
// insert data into the database
    $stmt = $con->prepare('UPDATE `fixtures` set `full_time` = 1 WHERE `fixtures`.id=?');
    $stmt->execute([$fixture_id]);
    $pusher->trigger('demo_pusher', 'full_time', 'full_time');
    header('Location: live_match.php?id='.$fixture_id);
}

if($_POST['step'] === "kick_off") {
// insert data into the database
    $stmt = $con->prepare('UPDATE `fixtures` set `kick_off` = 1 WHERE `fixtures`.id=?');
    $stmt->execute([$fixture_id]);
    $pusher->trigger('demo_pusher', 'kick_off', 'kick_off');
    header('Location: live_match.php?id='.$fixture_id);

}

if($_POST['step'] === "goal") {
    if($_POST['goals'] === "home") {
        $home_score = $con->prepare("SELECT your_goal_score from  fixtures WHERE id=?");
        $home_score->execute([$fixture_id]);
        $your_score = $home_score->fetch();
        $your_score_val = $your_score[0];

        if($your_score_val < 1 ) {
        $update_your_goal = $con->prepare('UPDATE `fixtures` set `your_goal_score` = ? WHERE `fixtures`.id=?');
        $update_your_goal->execute([1,$fixture_id]);
        header('Location: live_match.php?id='.$fixture_id);
    } else {
        $your_score_val++;
        $increase_your_goal = $con->prepare('UPDATE `fixtures` set `your_goal_score` = ? WHERE `fixtures`.id=?');
        $increase_your_goal->execute([$your_score_val,$fixture_id]);
        header('Location: live_match.php?id='.$fixture_id);
    }
// insert data into the database

} else {
        $other_team_score = $con->prepare("SELECT other_goal_score from  fixtures WHERE id=?");
        $other_team_score->execute([$fixture_id]);
        $other_score = $other_team_score->fetch();
        $other_score_val = $other_score[0];

        if($other_score_val < 1) {
            $update_other_goal = $con->prepare('UPDATE `fixtures` set `other_goal_score` = ? WHERE `fixtures`.id=?');
            $update_other_goal->execute([1,$fixture_id]);
            header('Location: live_match.php?id='.$fixture_id);
        } else {
            $other_score_val++;
            $increase_other_goal = $con->prepare('UPDATE `fixtures` set `other_goal_score` = ? WHERE `fixtures`.id=?');
            $increase_other_goal->execute([$other_score_val,$fixture_id]);
            header('Location: live_match.php?id='.$fixture_id);
        }
}

    $data['goals'] = array(
        'your_goal_score' => $your_score_val,
        'other_goal_score' => $other_score_val
    );
    $pusher->trigger('demo_pusher', 'add_goals', $data);
}
if($_POST['step'] === "substitution") {
    if ($_POST['player_in']) {
        $player_in = $con->prepare('UPDATE `fixtures` set `player_in` = ? WHERE `fixtures`.id=?');
        $player_in->execute([$_POST['player_in'], $fixture_id]);
        $player_in = $con->prepare("SELECT  team_players.* FROM fixtures LEFT JOIN team_players ON fixtures.player_in=team_players.id WHERE fixtures.id=? ");
        $player_in->execute([$fixture_id]);
        $player_in_name = $player_in->fetch()['player_name'];
        header('Location: live_match.php?id=' . $fixture_id);
    }
    if ($_POST['player_out']) {
        $player_out = $con->prepare('UPDATE `fixtures` set `player_out` = ? WHERE `fixtures`.id=?');
        $player_out->execute([$_POST['player_out'], $fixture_id]);
        $player_out = $con->prepare("SELECT  team_players.* FROM fixtures LEFT JOIN team_players ON fixtures.player_out=team_players.id WHERE fixtures.id=?");
        $player_out->execute([$fixture_id]);
        $player_out_name = $player_out->fetch()['player_name'];
        header('Location: live_match.php?id=' . $fixture_id);
    }


    $subst['players'] = array(
        'player_in' => $player_in_name . ' is in the game now',
        'player_out' => $player_out_name . ' is out of the game now'
    );
    $pusher->trigger('demo_pusher', 'subst', $subst);
}



