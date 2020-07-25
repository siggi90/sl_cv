<?

include '../base/base.php';

class app extends base {
	
	public $streamline;
	public $sl_cv;
	
	public function __construct() {
		parent::__construct('sl_cv', "/sl_cv");
		
		$this->streamline = new streamline($this->sql, $this->statement, $this->user_id);
		$this->sl_cv = new sl_cv($this->sql, $this->statement, $this->user_id);

	}
	
}

?>