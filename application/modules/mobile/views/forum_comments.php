<?php
//comments
$comments = '<li>No Comments</li>';
if($comments_query->num_rows() > 0)
{
	$comments = '';
	$last_date = '';
	foreach ($comments_query->result() as $row)
	{
		$member_name = $row->member_name;
		$member_id = $row->member_id;
		$user_names = explode(' ', $member_name);
		$post_comment_user = $user_names[0];
		$post_comment_description = $row->post_comment_description;
		$date = date('jS M, Y H:i a',strtotime($row->comment_created));
		
		$comments .=
		'
			<div class="messages-date">'.$date.'</div>
		';
		if($member_id == $forum_member_id)
		{
			$comments .=
			'
				<div class="message message-sent message-last message-with-tail">
					<div class="message-text">'.$post_comment_description.'</div>
				</div>
			';
		}
		
		else
		{
			$comments .=
			'
				<div class="message message-received message-with-avatar message-last message-with-tail message-first">
					<div class="message-name">'.$post_comment_user.'</div>
					<div class="message-text">'.$post_comment_description.'</div>
				</div>
			';
		}
	}
}
echo $comments;
?>