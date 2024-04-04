<?php
class model {
    protected $db;
	protected $dbuser;
	protected $dbpass;
	protected $dbname;
	protected $host;	

	public function __construct() {
		global $db;
		$this->db = $db;

		global $config;
		$this->dbuser = $config['dbuser'];
		$this->dbpass = $config['dbpass'];
		$this->dbname = $config['dbname'];
		$this->host = $config['host'];
	}

    public function getConfig() {
		$cfg['dbuser'] = $this->dbuser;
		$cfg['dbpass'] = $this->dbpass;
		$cfg['dbname'] = $this->dbname;
		$cfg['host'] = $this->host;
		return $cfg;
	}

}
?>