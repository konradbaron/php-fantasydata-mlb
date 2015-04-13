<?php
/**
 * @author Konrad Baron <konradbaron@gmail.com> http://kobatechnologies.com
 */
class FantasyDataMLB {
	
	private $base_url = "http://api.nfldata.apiphany.com/mlb/v2/";
	private $send_url;
	private $api_key;
	private $format_valid = array('json','xml');
	private $team_valid = array('ARI','ATL','BAL','BOS','CHC','CHW','CIN','CLE','COL','DET','HOU','KC','LAA','LAD','MIA','MIL','MIN','NYM','NYY','OAK','PHI','PIT','SD','SEA','SF','STL','TB','TEX','TOR','WSH');
	private $format;
	private $request_date;
	private $request_year;
	
	
    	public function __construct($api_key) {
        	$this->api_key = $api_key;
    	}
	
	private function check_format($format) {
		if(!in_array($format,$this->format_valid)) throw new Exception('Format is not valid. Must be set as one of the following: '.implode(', ',$this->format_valid).'');
		return $format;
	}
	
	private function check_date($request_date) {
		$d_compare = DateTime::createFromFormat('Y-M-d', $request_date);
		if (!is_object($d_compare)) throw new Exception('Date is not valid.');
		if(strtolower($d_compare->format('Y-M-d')) != strtolower($request_date)) throw new Exception('Date Format is not valid. Must be sent as Y-M-d, for example 2015-JUL-01');
		return $request_date;
	}
	
	private function check_year($request_year) {
		if (!is_int($request_year) || strlen($request_year) != 4) throw new Exception('Year Format is not valid. Must be valid four digit year');
		return $request_year;
	}
	
	private function check_team($team) {
		if(!in_array(strtoupper($team),$this->team_valid)) throw new Exception('Team is not valid. Must be set as one of the following: '.implode(', ',$this->team_valid).'');
		return $team;
	}
	
	/**
	* Active Players
 	* URL format http://api.nfldata.apiphany.com/mlb/v2/{format}/Players?subscription-key=<Your subscription key>
	* Required parameters
	* format
 	*/
	public function active_players($format = 'json'){
		$format = $this->check_format($format);
		
		$this->send_url = $this->base_url.$format.'/Players?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	/**
	* Active Teams
 	* URL format http://api.nfldata.apiphany.com/mlb/v2/{format}/teams?subscription-key=<Your subscription key>
	* Required parameters
	* format
 	*/
	public function active_teams($format = 'json'){
		$format = $this->check_format($format);
		
		$this->send_url = $this->base_url.$format.'/Teams?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	/**
	* Free Agents
 	* http://api.nfldata.apiphany.com/mlb/v2/{format}/FreeAgents?subscription-key=<Your subscription key>
	* Required parameters
	* format
 	*/
	public function free_agents($format = 'json'){
		$format = $this->check_format($format);
		
		$this->send_url = $this->base_url.$format.'/FreeAgents?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	/**
	* Games by Date
 	* http://api.nfldata.apiphany.com/mlb/v2/{format}/GamesByDate/{date}?subscription-key=<Your subscription key>
	* Required parameters
	* format | date
 	*/
	public function games_by_date($request_date, $format = 'json'){
		$request_date = $this->check_date($request_date);
		
		$this->send_url = $this->base_url.$format.'/GamesByDate/'.$request_date.'?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	/**
	* Games by Season
 	* http://api.nfldata.apiphany.com/mlb/v2/{format}/Games/{season}?subscription-key=<Your subscription key>
	* Required parameters
	* format | year
 	*/
	public function games_by_season($request_year, $format = 'json'){
		$request_year = $this->check_year($request_year);
		
		$this->send_url = $this->base_url.$format.'/Games/'.$request_year.'?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	/**
	* Player Game Stats by Date
 	* http://api.nfldata.apiphany.com/mlb/v2/{format}/PlayerGameStatsByDate/{date}?subscription-key=<Your subscription key>
	* Required parameters
	* format | date
 	*/
	public function player_game_stats_by_date($request_date, $format = 'json'){
		$request_date = $this->check_date($request_date);
		
		$this->send_url = $this->base_url.$format.'/PlayerGameStatsByDate/'.$request_date.'?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	/**
	* Player Season Stats
 	* http://api.nfldata.apiphany.com/mlb/v2/{format}/PlayerSeasonStats/{season}?subscription-key=<Your subscription key>
	* Required parameters
	* format | year
 	*/
	public function player_season_stats($request_year, $format = 'json'){
		$request_year = $this->check_year($request_year);
		
		$this->send_url = $this->base_url.$format.'/PlayerSeasonStats/'.$request_year.'?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	/**
	* Player Season Stats by Team
 	* http://api.nfldata.apiphany.com/mlb/v2/{format}/PlayerSeasonStatsByTeam/{season}/{team}?subscription-key=<Your subscription key>
	* Required parameters
	* format | year | team
 	*/
	public function player_season_stats_by_team($request_year, $team, $format = 'json'){
		$request_year = $this->check_year($request_year);
		$team = $this->check_team($team);
		
		$this->send_url = $this->base_url.$format.'/PlayerSeasonStatsByTeam/'.$request_year.'/'.$team.'?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	/**
	* Players by Team
 	* http://api.nfldata.apiphany.com/mlb/v2/{format}/Players/{team}?subscription-key=<Your subscription key>
	* Required parameters
	* format | team
 	*/
	public function player_by_team($team, $format = 'json'){
		$team = $this->check_team($team);
		
		$this->send_url = $this->base_url.$format.'/Players/'.$team.'?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	
	/**
	* Projected Player Game Stats by Date
 	* http://api.nfldata.apiphany.com/mlb/v2/{format}/PlayerGameProjectionStatsByDate/{date}?subscription-key=<Your subscription key>
	* Required parameters
	* format | date
 	*/
	public function projected_player_game_stats_by_date($request_date,$format = 'json'){
		$request_date = $this->check_date($request_date);
		
		$this->send_url = $this->base_url.$format.'/PlayerGameProjectionStatsByDate/'.$request_date.'?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	/**
	* Stadiums
 	* http://api.nfldata.apiphany.com/mlb/v2/{format}/Stadiums?subscription-key=<Your subscription key>
	* Required parameters
	* format
 	*/
	public function stadiums($format = 'json'){
		$this->send_url = $this->base_url.$format.'/Stadiums?subscription-key='.$this->api_key;
		return $this->curl($this->send_url);
	}
	
	
	public function curl($send_url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $send_url);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			$error = curl_error($ch);
			curl_close($ch);
			
			throw new Exception("Failed retrieving  '" . $this->send_url . "' because of ' " . $error . "'.");
		}
		return $result;
	}
}
