<?php
class Mukuchu extends DB_Connect
{
		public function __construct($dbo=NULL)
		
		{
		/*
		* Call the parent constructor to check for
		* a database object
		*/
			parent::__construct($dbo);
		}
		

		public function crosswordMukuchu()
		{
			$sql="CALL proc_tbl_crossword_completed(?,?,?,?,?,?)";
			
			$narr=CCDLookUp("point_desc","tbl_mukuchu_points","point_id=35");
			$points=CCDLookUp("points","tbl_mukuchu_points","point_id=35");
			$point_id=35;
			$cross_id=CCGetParam("crossword_id",0);
			$user=CCGetUserID();
			$ip=$_SERVER['REMOTE_ADDR'];

				$stmt = $this->db->prepare($sql);
				$stmt->bindParam(1, $point_id, PDO::PARAM_INT,10);
				$stmt->bindParam(2, $cross_id, PDO::PARAM_INT,10);
				$stmt->bindParam(3, $points, PDO::PARAM_INT,10);
				$stmt->bindParam(4, $user, PDO::PARAM_INT,10);
				$stmt->bindParam(5, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
				$stmt->bindParam(6, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
				$stmt->execute();
			
		}
		
		public function inboxMukuchu()
		{
			$sql="CALL proc_tbl_mukuchu_inbox(?,?,?,?,?)";
			$point_id=50;
			$narr="Inbox msee ".CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."");
			$points=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
			$user=CCGetUserID();
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(1, $user, PDO::PARAM_INT,10);
			$stmt->bindParam(2, $point_id, PDO::PARAM_INT,10);
			$stmt->bindParam(3, $points, PDO::PARAM_INT,10);
			$stmt->bindParam(4, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->bindParam(5, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->execute();
		}


		public function mabeshteMukuchu($user,$bdbu_id)
		{
			
			//CALL proc_tbl_mukuchu_mabeshte('$dbu_id','$bdbu_id','49','$points','$ip','$narr1')
			$sql="CALL proc_tbl_mukuchu_mabeshte(?,?,?,?,?,?)";
			$point_id=49;
			$narr=CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."");
			$points=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
			$user=CCGetUserID();
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(1, $user, PDO::PARAM_INT,10);
			$stmt->bindParam(2, $bdbu_id, PDO::PARAM_INT,10);
			$stmt->bindParam(3, $point_id, PDO::PARAM_INT,10);
			$stmt->bindParam(4, $points, PDO::PARAM_INT,10);
			$stmt->bindParam(5, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->bindParam(6, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->execute();
		}

	public function AddmabeshteMukuchu($user,$bdbu_id)
		{
			
			//CALL proc_tbl_mukuchu_mabeshte('$dbu_id','$bdbu_id','49','$points','$ip','$narr1')
			$sql="CALL proc_tbl_mukuchu_mabeshte(?,?,?,?,?,?)";
			$point_id=41;
			$narr=CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."");
			$points=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
			$user=CCGetUserID();
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(1, $user, PDO::PARAM_INT,10);
			$stmt->bindParam(2, $bdbu_id, PDO::PARAM_INT,10);
			$stmt->bindParam(3, $point_id, PDO::PARAM_INT,10);
			$stmt->bindParam(4, $points, PDO::PARAM_INT,10);
			$stmt->bindParam(5, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->bindParam(6, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->execute();
		}
		public function shareLikeMukuchu($user,$narr1)
		{
			
			//CALL proc_tbl_mukuchu_mabeshte('$dbu_id','$bdbu_id','49','$points','$ip','$narr1')
			$sql="CALL proc_tbl_sharelike_mukuchu(?,?,?,?,?)";
			$point_id=43;
			$narr=$narr1." / ". CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."");
			$points=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
			$user=CCGetUserID();
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(1, $point_id, PDO::PARAM_INT,10);
			$stmt->bindParam(2, $points, PDO::PARAM_INT,10);
			$stmt->bindParam(3, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->bindParam(4, $user, PDO::PARAM_INT,10);
			$stmt->bindParam(5, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->execute();
		}
		public function inshachangiaMukuchu($insha_id,$comments,$narr1)
		{
			
			//CALL proc_tbl_mukuchu_mabeshte('$dbu_id','$bdbu_id','49','$points','$ip','$narr1')
			$sql="CALL proc_tbl_mukuchu_insha(?,?,?,?,?,?)";
			$point_id=57;
			$narr=$narr1." / ". CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."");
			$points1=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
			$points=$points1*$comments;
			$user=CCGetUserID();
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(1, $point_id, PDO::PARAM_INT,10);
			$stmt->bindParam(2, $insha_id, PDO::PARAM_INT,10);
			$stmt->bindParam(3, $points, PDO::PARAM_INT,10);
			$stmt->bindParam(4, $user, PDO::PARAM_INT,10);			
			$stmt->bindParam(5, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->bindParam(6, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->execute();
		}
		public function bongaCommentMukuchu($topic_id,$comments,$narr1)
		{
			
			//CALL proc_tbl_mukuchu_mabeshte('$dbu_id','$bdbu_id','49','$points','$ip','$narr1')
			$sql="CALL proc_tbl_mukuchu_bonga(?,?,?,?,?,?)";
			$point_id=25;
			$narr=$narr1." / ". CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."");
			$points1=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
			$points=$points1*$comments;
			$user=CCGetUserID();
			$ip=$_SERVER['REMOTE_ADDR'];
			
			$stmt = $this->db->prepare($sql);
			$stmt->bindParam(1, $point_id, PDO::PARAM_INT,10);
			$stmt->bindParam(2, $topic_id, PDO::PARAM_INT,10);
			$stmt->bindParam(3, $points, PDO::PARAM_INT,10);
			$stmt->bindParam(4, $user, PDO::PARAM_INT,10);			
			$stmt->bindParam(5, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->bindParam(6, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
			$stmt->execute();
		}
		
		//Pea mwenye word mukuchu
		public function VoteWordYake()
		{
		$wordid = htmlentities($_POST['wordidMemWVote'], ENT_QUOTES);
		$addedby = htmlentities($_POST['nickMemWVote'], ENT_QUOTES);
		$UserID = CCGetUserID();
		$nick=CCDLookUp("nickname","tbl_u_members","dbu_id=".$UserID."");
		$point_id=45;	
		$points=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
		$narr=CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."")." by $nick, word id $wordid";
		//$narr=CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."")."d for wordid=$wordid";
		$ip=$_SERVER['REMOTE_ADDR'];
		//"CALL proc_tbl_mukuchu_kamusi_vote_memberword('4','$word_id','$points','$user','$ip','$narr1')"
		
		
		$proc= "CALL proc_tbl_mukuchu_kamusi_vote_memberword(?,?,?,?,?,?)";
		$stmt = $this->db->prepare($proc);
		$stmt->bindParam(1, $point_id, PDO::PARAM_INT);
		$stmt->bindParam(2, $wordid, PDO::PARAM_INT);
		$stmt->bindParam(3, $points, PDO::PARAM_INT);
		$stmt->bindParam(4, $addedby, PDO::PARAM_INT);
		$stmt->bindParam(5, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$stmt->bindParam(6, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);					
		$stmt->execute();
				

	}
	
	//Pea voter mukuchu
	public function VoteWordMwenyewe()
		{
		$wordid =htmlentities($_POST['wordidMemWVote'], ENT_QUOTES);
		$point_id=5;
		$points=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
		$narr=CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."").", word id $wordid";
		$ip=$_SERVER['REMOTE_ADDR'];
		//"CALL proc_tbl_mukuchu_kamusi_vote_memberword('4','$word_id','$points','$user','$ip','$narr1')"
		$voted_by = CCGetUserID();
		
		$proc= "CALL proc_tbl_mukuchu_kamusi_vote_memberword(?,?,?,?,?,?)";
		$stmt = $this->db->prepare($proc);
		$stmt->bindParam(1, $point_id, PDO::PARAM_INT);
		$stmt->bindParam(2, $wordid, PDO::PARAM_INT);
		$stmt->bindParam(3, $points, PDO::PARAM_INT);
		$stmt->bindParam(4, $voted_by, PDO::PARAM_INT);
		$stmt->bindParam(5, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$stmt->bindParam(6, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);					
		$stmt->execute();
				

	}
	public function LoginMukuchu()
		{
		$wordid =htmlentities($_POST['word_id'], ENT_QUOTES);
		$UserID = CCGetUserID();
		$point_id=23;	
		$points=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
		$narr=CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."");
		$ip=$_SERVER['REMOTE_ADDR'];
		//"CALL proc_tbl_mukuchu_login ('$dbu','23','$points','$IP','Sheng Log In'
		
		
		$proc= "CALL proc_tbl_mukuchu_login(?,?,?,?,?)";
		$stmt = $this->db->prepare($proc);
		$stmt->bindParam(1, $UserID, PDO::PARAM_INT);
		$stmt->bindParam(2, $point_id, PDO::PARAM_INT);		
		$stmt->bindParam(3, $points, PDO::PARAM_INT);		
		$stmt->bindParam(4, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$stmt->bindParam(5, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);					
		$stmt->execute();
				

	}
	public function RegMukuchu()
		{
		$wordid =htmlentities($_POST['word_id'], ENT_QUOTES);
		$UserID = CCGetUserID();
		$point_id=1;	
		$points=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
		$narr=CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."");
		$ip=$_SERVER['REMOTE_ADDR'];
		//" proc_tbl_u_reg_mukuchu(1,'$points','$ipadd','$dbu_id','Registration')
		
		
		$proc= "CALL proc_tbl_u_reg_mukuchu(?,?,?,?,?)";
		$stmt = $this->db->prepare($proc);
		
		$stmt->bindParam(1, $point_id, PDO::PARAM_INT);		
		$stmt->bindParam(2, $points, PDO::PARAM_INT);		
		$stmt->bindParam(3, $ip, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$stmt->bindParam(4, $UserID, PDO::PARAM_INT);
		$stmt->bindParam(5, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);					
		$stmt->execute();
				

	}
	/*Add word mukuchu
	public function AddWordMukuchu($word_id)
	{
	$user_id=CCGetUserID();
	$point_id=13;
	$points=CCDLookUp("points","tbl_mukuchu_points","point_id=".$point_id."");
	$narr=CCDLookUp("point_desc","tbl_mukuchu_points","point_id=".$point_id."");
	$ip=$_SERVER['REMOTE_ADDR'];
		//call procedure in the order of : dbu_id,word_id,point_id,points,IP,narrative
		$proc="CALL proc_tbl_mukuchu_kamusi(?,?,?,?,?,?)";
		$stmt->bindParam(1, $user_id, PDO::PARAM_INT);		
		$stmt->bindParam(2, $word_id, PDO::PARAM_INT);		
		$stmt->bindParam(3, $point_id, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);
		$stmt->bindParam(4, $points, PDO::PARAM_INT);
		$stmt->bindParam(5, $ip, PDO::PARAM_STR);
		$stmt->bindParam(6, $narr, PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, 4000);					
		$stmt->execute();
 }*/
		
}//End class Mukuchu 