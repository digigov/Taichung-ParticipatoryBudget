<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$this->load->database();
		$this->load->model("sliderModel");

		$slides = $this->sliderModel->get_active_now();
		
		$this->load->database();
		$this->load->model("newsModel");
    $latest_news = $this->newsModel->get_latest_news_list(1,3);


		$this->load->view('welcome_message',
			[	
				"pb" => "",
				"slides" => $slides,
				"latest_news" => $latest_news
			] );
		session_write_close();
	}

	public function QA(){
		session_write_close();
		// $this->load->database();
    // $this->load->model("qaModel");		

		//$qas = $this->qaModel->get_latest_by_page(1,1000)
    $qas = $this->_test();
    // die(var_export($qas));
		$this->load->view('pages/qa',
			[
				"pageTitle" => "問與答",
				"qas" => $qas
			]);
			
	}

	public function _test(){
		return 
array (
  0 => 
  (Object)(array(
     'id' => 1,
     'question' => '為什麼臺中市要推動參與式預算？',
     'answer' => '<p>透過參與式預算公共審議的機制達到三大目標</p>
<ul>
<li>
<p>政府公開化： 參與式預算透過公共審議的機制將決策權力交給人民，促使政府提高透明度，將一部分預算的使用模式攤開於全體人民之前，落實開放政府。</p>
</li>
<li>施政準確化： 參與式預算拉近人民與政府的距離，透過提案反映老百姓的需要，使政府政策能夠符合地方需求，及時改善人民最迫切的需求，施政快又準。</li>
<li>民主普遍化： 參與式預算提供一個發聲管道給所有人民，讓他們的需求能被聽見，實踐「城市權」與直接民主的理想。</li>
</ul>',
     'ctime' => '2016-10-23 13:57:09.918468',
     'mtime' => '2016-10-23 13:57:09.918468',
     'deleted' => 0,
  )),
  1 => 
  (Object)(array(
     'id' => 2,
     'question' => '臺中市參與式預算辦理精神為何？',
     'answer' => '<p>參與式預算辦理秉持五大原則</p>
<ul>
<li>公民培力：市民才是決定預算分配的主體。</li>
<li>公開透明：資訊開放，各項資訊公開大眾檢視。</li>
<li>包容多元：尋找傳統政治下被忽略的聲音，提供發聲的管道。</li>
<li>立足點式平等：確保每個人都能夠有相等的權力影響公共支出。</li>
<li>社區導向：利己利人，從關心社區開始。</li>
</ul>',
     'ctime' => '2016-10-23 14:10:47.448341',
     'mtime' => '2016-10-23 14:10:47.448341',
     'deleted' => 0,
  )),
  2 => 
  (Object)(array(
     'id' => 3,
     'question' => '住民會議怎麼開？',
     'answer' => '<div class="answer">
<p>住民會議開放給16 歲（含）以上設籍臺中市的市民參與，採取審議民主的精神，大家帶著自己的提案，坐下來和大家分享、彼此交流、相互聆聽，提升提案的公益性，讓議題更能夠貼合大家的需求。</p>
</div>',
     'ctime' => '2016-10-23 14:11:24.829967',
     'mtime' => '2016-10-23 14:11:24.829967',
     'deleted' => 0,
  )),
  3 => 
  (Object)(array(
     'id' => 4,
     'question' => '專家學者顧問團的意見我一定要照單全收嗎？',
     'answer' => '<p>顧問團的意見回饋主要是協助民眾提高提案的可行性，幫助民眾的提案更完整，也讓政府更容易實踐提案。所有意見都會上網公告，要不要採行專家學者顧問團的意見仍由提案人做最終決定。</p>',
     'ctime' => '2016-10-23 14:11:59.513721',
     'mtime' => '2016-10-23 14:11:59.513721',
     'deleted' => 0,
  )),
  4 => 
  (Object)(array(
     'id' => 7,
     'question' => '請問要在哪裡看提案資料？',
     'answer' => '<p>您可以至臺中市參與式預算官方網站（<a href="http://pb.taichung.gov.tw">http://pb.taichung.gov.tw</a>）的「今年提案」頁面，點選您想瀏覽的區域，即可看見今年度住民會議提案內容、海報以及專家學者顧問團的意見。</p>',
     'ctime' => '2016-11-02 07:25:27.567994',
     'mtime' => '2016-11-02 07:25:27.567994',
     'deleted' => 0,
  )),
  5 => 
  (Object)(array(
     'id' => 8,
     'question' => '我應該要去哪裡投票？',
     'answer' => '<p>今年的投票分為兩個階段，第一階段為全市市民投票，時間由105年11月7日至11月13日，臺中市16歲以上市民皆可於投票期間登入票選；第二階段為在地居民投票，時間由105年11月21日至11月27日，對象為設籍中區、大里區、清水區與豐原區的16歲以上市民。網路票選系統網址：<a href="http://ivoting.taichung.gov.tw">http://ivoting.taichung.gov.tw</a>。</p>',
     'ctime' => '2016-11-02 07:26:02.94116',
     'mtime' => '2016-11-02 07:26:02.94116',
     'deleted' => 0,
  )),
  6 => 
  (Object)(array(
     'id' => 9,
     'question' => '為什麼投票要分兩階段進行？',
     'answer' => '<p>今年的採行兩階段投票主要是基於「城市權」的理念，臺中市的發展應該是由全體市民共同決定，因此第一階段投票將由全市市民一起決定12 項入圍提案。第二階段的投票將由中區、大里區、豐原區與清水區的居民自行從12 項提案中決選出6項優先提案，並且由市府執行之。</p>',
     'ctime' => '2016-11-02 07:27:43.029166',
     'mtime' => '2016-11-02 07:27:43.029166',
     'deleted' => 0,
  )),
  7 => 
  (Object)(array(
     'id' => 10,
     'question' => '不會網路投票怎麼辦？',
     'answer' => '<p>您可以在第一階段與第二階段投票期間，攜帶身分證明文件於開放期間至以下投票站，會有服務人員協助您進行投票喔！若有任何問題，歡迎與 「臺中市參與式預算推動專案辦公室」聯絡，電話04-22221712。&nbsp;</p>
<ul>
<li>臺中市參與式預算推動專案辦公室</li>
</ul>
<p style="padding-left: 30px;">&nbsp; 臺中市中區中山路69號4F</p>
<p style="padding-left: 30px;">&nbsp; 週一到週五10：00~12：00、14：00~18：00</p>
<ul>
<li>中區公所</li>
</ul>
<p style="padding-left: 30px;">&nbsp; 臺中市中區成功路300號3F</p>
<p style="padding-left: 30px;">&nbsp; 週一到週日08：00~12：00、13：00~17：00</p>
<ul>
<li>大里區公所</li>
</ul>
<p style="padding-left: 30px;">&nbsp; 臺中市大里區大新街36號</p>
<p style="padding-left: 30px;">&nbsp; 週一到週日08：00~12：00、13：00~17：00</p>
<ul>
<li>清水區公所</li>
</ul>
<p style="padding-left: 30px;">&nbsp; 臺中市清水區中社里鎮政路101號</p>
<p style="padding-left: 30px;">&nbsp; 週一到週日08：00~12：00、13：00~17：00</p>
<ul>
<li>豐原區公所</li>
</ul>
<p style="padding-left: 30px;">&nbsp; 臺中市豐原區市政路2號</p>
<p style="padding-left: 30px;">&nbsp; 週一到週日08：00~12：00、13：00~17：00</p>
<ul>
<li>清水散步</li>
</ul>
<p style="padding-left: 30px;">&nbsp; 台中市清水區文昌街18號</p>
<p style="padding-left: 30px;">&nbsp; 每日10：00~21：00，週二公休</p>
<ul>
<li>臺中市山線社區大學</li>
</ul>
<p style="padding-left: 30px;">&nbsp; 臺中市豐原區豐東路75號（豐東國中內）</p>
<p style="padding-left: 30px;">&nbsp; 週一到週五14：00~21：00週六09：00~17：00</p>',
     'ctime' => '2016-11-02 07:28:16.606845',
     'mtime' => '2016-11-02 07:28:16.606845',
     'deleted' => 0,
  )),
);
	}
	public function process(){
		session_write_close();
		$this->load->view('pages/process',["pageTitle" => "臺中市參與式預算推動流程"]);
	}

	public function introduce(){
		session_write_close();
		$this->load->view('pages/introduce',["pageTitle" => "認識參與式預算"]);
	}

	public function links(){
		session_write_close();
		$this->load->view('pages/links',["pageTitle" => "友站連結"]);
	}
}
