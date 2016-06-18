<?php

namespace Vandy;


class GitSearch
{
    protected $repositoryID;
    protected $name;
    protected $url;
    protected $created_date;
    protected $last_push_date;
    protected $stars;
    protected $description;

    /**
     * @return string
     */
    public function generateStarredList()
    {
        $result = '';
        $db = new Database();
        $db->connect();

        $data = $db->select("SELECT * FROM most_starred ORDER BY stargazers_count DESC");

        for ($i = 0; $i < count($data); $i++)
        {
            $result .= "<div class=\"panel panel-default\"><div class=\"panel-heading\" role=\"tab\" id=\"headingOne\"><h4 class=\"panel-title\">";
            $result .= "<a class=\"collapsed\" role=\"button\" data-toggle=\"collapse\" data-parent=\"#accordion\" href=\"#collapse". $i . "\" aria-expanded=\"false\" aria-controls=\"collapse". $i . "\">";
            $result .= "Name: " . $data[$i]["name"] . "<span class=\"badge glyphicon glyphicon-star\" aria-hidden=\"true\">" . $data[$i]["stargazers_count"] . "</span></a></h4></div>";
            $result .= "<div id=\"collapse". $i . "\" class=\"panel-collapse collapse\" role=\"tabpanel\" aria-labelledby=\"headingOne\">";
            $result .= "<div class=\"panel-body\">";
            $result .= "<ul><li>Repository ID: " . $data[$i]["repositoryID"] . "</li>";
            $result .= "<li>URL: <a href=\"" . $data[$i]["url"] . "\">" . $data[$i]["url"] . "</a></li>";
            $result .= "<li>Created Date: " . $data[$i]["created_date"] . "</li>";
            $result .= "<li>Last Push Date: " . $data[$i]["last_push_date"] . "</li>";
            $result .= "<li>Description: " . $data[$i]["description"] . "</li>";
            $result .= "</div></div></div>";
        }

        return $result;
    }

    /**
     * @param $params
     */
    public function saveMostStarred($params)
    {
        $db = new Database();
        $db->connect();

        for ($i = 0; $i < count($params["items"]); $i++) {
            $this->repositoryID = $params["items"][$i]["id"];
            $this->name = $params["items"][$i]["name"];
            $this->url = $params["items"][$i]["html_url"];
            $this->created_date = strtotime($params["items"][$i]["created_at"]);
            $this->last_push_date = strtotime($params["items"][$i]["pushed_at"]);
            $this->stars = $params["items"][$i]["stargazers_count"];
            $this->description = $params["items"][$i]["description"];

            $formattedCreate = date("Y-m-d H:i:s", $this->created_date);
            $formattedPush = date("Y-m-d H:i:s", $this->last_push_date);

            $db->dbQuery("INSERT INTO most_starred (repositoryID, name, url, created_date, last_push_date, stargazers_count, description)
                         VALUES ($this->repositoryID, '$this->name', '$this->url', '$formattedCreate', '$formattedPush', $this->stars, '$this->description')
                         ON DUPLICATE KEY UPDATE repositoryID=$this->repositoryID, name='$this->name', url='$this->url', created_date='$formattedCreate', 
                         last_push_date='$formattedPush', stargazers_count=$this->stars, description='$this->description'");
        }
    }
}