# PHP-FantasyData-MLB

PHP-FantasyData-MLB is a PHP class for [MLB Data by FantasyData](http://fantasydata.com/).
You must first register an account to receive an API key. There is a free trial option, which limits the amount of API calls to 1K per month.

The API currently returns your data in two formats; JSON and XML. This class has set JSON as the default return format.

##Example Usage

###Instantiate the class
```php
    $fantasyDataMLB = new FantasyDataMLB('YOUR_API_KEY');
```

###Active Players
```php
    $fantasyDataMLB->active_players();
```

###Active Teams
```php
    $fantasyDataMLB->active_teams();
```

###Free Agents
```php
    $fantasyDataMLB->free_agents();
```

###Games by Date
```php
    $fantasyDataMLB->games_by_date('Y-M-d');
```

###Games by Season
```php
    $fantasyDataMLB->games_by_season('YEAR');
```

###Player Game Stats by Date
```php
    $fantasyDataMLB->player_game_stats_by_date('Y-M-d');
```

###Player Season Stats
```php
    $fantasyDataMLB->player_season_stats('YEAR');
```

###Player Season Stats by Team
```php
    $fantasyDataMLB->player_season_stats_by_team('YEAR','TEAM_ABBR');
```

###Players by Team
```php
    $fantasyDataMLB->player_by_team('TEAM_ABBR');
```

###Stadiums
```php
    $fantasyDataMLB->stadiums();
```
