<?php
//comments
$comments = '<li>No Comments</li>';
if($comments_query->num_rows() > 0)
{
	$comments = '';
	foreach ($comments_query->result() as $row)
	{
		$member_name = $row->member_name;
		$user_names = explode(' ', $member_name);
		$post_comment_user = $user_names[0];
		$post_comment_description = $row->post_comment_description;
		$date = date('jS M, Y H:i a',strtotime($row->comment_created));
		
		$comments .= 
		'
			<li class="comment_row">
				<div class="comm_avatar"><img src="images/icons/black/user.png" alt="" title="" border="0" /></div>
				<div class="comm_content"><p>'.$post_comment_description.' by <a href="#">'.$post_comment_user.'</a></p></div>
			</li>
		';
	}
}
echo $comments;
?>