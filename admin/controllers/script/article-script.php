<?php

require_once '../../configs/admin_configs.php';
require_once _ROOT . '/admin/controllers/session.php';
require_once _ROOT . '/admin/functions/articles_functions.php';



switch($_POST['operation']){
    case "tag_list" :
        $tags = get_tagsByCategory($_POST['category']);
        $old_tag = $_POST['old_tag'];
        $option_object = "";

        if($old_tag[0] == "none"){
            foreach ($tags as $tag) {
                $option_object = $option_object . '<option value="'.$tag['label'].'">'.$tag['label'].'</option>';
            }
        }else{
            if(isset($old_tag[1])){
                foreach($tags as $tag){
                    if($old_tag[0] != $tag['label'] && $old_tag[1] != $tag['label']){
                        $option_object = $option_object . '<option value="'.$tag['label'].'">'.$tag['label'].'</option>';
                    }
                }
            }else{
                foreach($tags as $tag){
                    if($old_tag[0] != $tag['label']){
                        $option_object = $option_object . '<option value="'.$tag['label'].'">'.$tag['label'].'</option>';
                    }
                }
            }
        }
        echo $option_object;
        exit;
        break;

    case "make_draft" :
        // Insert article
        $data_1 = array();
        $data_1['title'] = $_POST['title'];
        $data_1['subtitle'] = $_POST['subtitle'];
        $data_1['content'] = $_POST['content'];
        $data_1['background'] = "";
        $data_1['draft'] = 1;
        $data_1['author'] = $_SESSION['username'];
        $id = insert_article($data_1, false, false);
        if(!$id){
            $error = "Impossible to insert article";
            redirect("../index.php?error=$error", true);
        }

        // Insert part_of (relation between article and category)
        $category = $_POST['category'];
        if($category != "Other"){
            $data_2 = array();
            $data_2['article'] = $id;
            $data_2['category'] = $category;
            insert_articlesCategory($data_2, false, false);
        }

        // Insert has (relation between article and tag)
        $flag = true;
        $tags = $_POST['tags'];
        if($tags[0] != "default"){
            if($tags[0] != "default" && $tags[1] != "default" && $tags[2] != "default"){
                $temp = $tags[0];
                $tags[0] = selectRecord("tag", "label = '$temp'");
                $temp = $tags[1];
                $tags[1] = selectRecord("tag", "label = '$temp'");
                $temp = $tags[2];
                $tags[2] = selectRecord("tag", "label = '$temp'");
            }else{
                if($tags[0] != "default" && $tags[1] != "default"){
                    $temp = $tags[0];
                    $tags[0] = selectRecord("tag", "label = '$temp'");
                    $temp = $tags[1];
                    $tags[1] = selectRecord("tag", "label = '$temp'");
                }else{
                    $temp = $tags[0];
                    $tags[0] = selectRecord("tag", "label = '$temp'");
                }
            }
        }else{
            $flag = false;
        }
        // Insert has (relation between article and tag)
        if($flag){
            $data_3 = array();
            $data_3['article'] = $id;
            foreach ($tags as $tag) {
                $data_3['tag'] = $tag['id'];
                insert_articlesTags($data_3, false, false);
            }
        }

        // Insert upload file paths into upload
        $uploads = $_POST['uploads'];
        if(count($uploads) > 0){
            $data_4 = array();
            foreach($uploads as $upload) {
                $data_4['file_name'] = $upload;
                $data_4['folder'] = "post";
                $data_4['file_address'] = "img/post/pictures/";
                $ext = explode(".", $upload);
                $data_4['file_extension'] = $ext[count($ext)-1];
                $data_4['gallery'] = 0;
                $data_4['name'] = "No name";
                $data_4['description'] = "No description";
                $data_4['article'] = $id;
                insertRecord("upload", $data_4);
            }
        }
        break;

    case "remove_file":
        unlink(_ROOT . "/" . $_POST['file_path']);
        break;

    case "delete_draft":
        delete_draft($_POST['draft_id']);
        break;

    default : break;
}

?>
