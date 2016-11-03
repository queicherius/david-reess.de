<?php

class Model_Article extends Ice_Model{

    public function getArticles($tag_filter = NULL){

        $tagfilter_sql = "";
        if($tag_filter != NULL){
            $tag_filter = $this->escape($tag_filter);
            $tagfilter_sql = "WHERE tag_list LIKE '%{$tag_filter}%'";
        }


        return $this->db->query("SELECT * FROM (
                                     SELECT article.*,
                                            GROUP_CONCAT(tag.name SEPARATOR ',') AS tag_list
                                     FROM article
                                     LEFT OUTER JOIN article_tags ON (article_tags.article_id = article.id)
                                     LEFT OUTER JOIN tag ON (article_tags.tag_id = tag.id)
                                     GROUP BY article.id
                                     ORDER BY article.timestamp DESC
                                 ) AS x
                                 {$tagfilter_sql}")->fetchAll();

    }

}