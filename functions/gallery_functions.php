<?php

require_once BLOG_ROOT . '/functions/articles_functions.php';


// Retrieve all pictures that have 'gallery' flag on
function retrieve_pictures($page_number){
    if(is_null($page_number)){
        $DBpictures = selectQuery(TAB_UPLOADS, "gallery = '1'", "id DESC");
    }else{
        if($page_number == 1){
            $DBpictures = selectQuery(TAB_UPLOADS, "gallery = '1'", "id DESC LIMIT 0, 16");
        }else{
            $page_number = ($page_number - 1) * 16;
            $condition = $page_number . ", 16";
            $DBpictures = selectQuery(TAB_UPLOADS, "gallery = '1'", "id DESC LIMIT $condition");
        }
    }
    $gallery = assign_pictures($DBpictures);

    return $gallery;
}


// Creates an array of images with its details
function assign_pictures($pictures){
    $result = array();

    foreach($pictures as $picture){
        $list_element = array();

        $list_element['id'] = $picture['id'];
        $list_element['image'] = $picture['file_address'] . $picture['file_name'];
        $list_element['name'] = $picture['name'];
        $list_element['description'] = $picture['description'];

        $result[] = $list_element;
    }
    return $result;
}


// Return specific information about one picture
function get_picture($id){
    $DB_picture = selectRecord(TAB_UPLOADS, "id = $id");
    $DB_art_pic = selectRecord(TAB_ART_UPL, "upload = $id");

    if(count($DB_art_pic) > 0){
        $article_id = $DB_art_pic['article'];
        $article = retrieve_article_title($article_id);

        $result['image'] = $DB_picture['file_address'] . $DB_picture['file_name'];
        $result['name'] = $DB_picture['name'];
        $result['description'] = $DB_picture['description'];
        $result['article_id'] = $article['id'];
        $result['article_title'] = $article['title'];
    }else{
        $result['image'] = $DB_picture['file_address'] . $DB_picture['file_name'];
        $result['name'] = $DB_picture['name'];
        $result['description'] = $DB_picture['description'];
        $result['article_id'] = "";
        $result['article_title'] = "Eitfabis";
    }
    return $result;
}


// Count and get the total page number of Gallery section
function get_total_page(){
    $row = countRecord(TAB_UPLOADS, "gallery = '1'");
    $page = $row / 16;

    if($row % 16 == 0)
        return $page;
    else
        return substr($page+1, 0, 1);
}

?>
