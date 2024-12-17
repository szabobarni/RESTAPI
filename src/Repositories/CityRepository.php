<?php
namespace App\Repositories;

class CityRepository extends BaseRepository
{
    function __construct(
        $host = self::HOST, 
        $user = self::USER,
        $password = self::PASSWORD,
        $database = self::DATABASE)
    {
        parent::__construct($host, $user, $password, $database);
        $this->tableName = 'cities';
    }

    public function getAllCity($county_id): array
    {
        $query = $this->select() . "WHERE id_county = $county_id ORDER BY city";

        return $this->mysqli
            ->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getAbcCity($id): array
    {
        $query = "SELECT DISTINCT LEFT(city,1) as abc FROM cities WHERE id_county = $id";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }

    public function getCitiesByFirstCh($id,$ch)
    {
        $character = urldecode($ch);
        $query = $this->select(). "WHERE id_county=$id AND city LIKE '$character%'";

        return $this->mysqli->query($query)->fetch_all(MYSQLI_ASSOC);
    }
}