<?php

require_once _ROOT . '/admin/functions/db_functions.php';
require_once _ROOT . '/admin/functions/utility_functions.php';


// Returns the contents of the User-Group DB tables
function get_usersTable(){
    $result = array();
    $users = selectQuery(TAB_USERS, "", "id DESC");
    $user_groups =
    $i = 0;

    foreach($users as $user){
        $id = $user['id'];
        $result[$i]['id'] = $id;
        $result[$i]['username'] = $user['username'];
        $result[$i]['password'] = "**********";
        $result[$i]['email'] = $user['email'];
        $result[$i]['group'] = selectJoin(TAB_USR_ROLE, TAB_GROUPS, "groupId = id", "userId = $id")[0]['role'];
        $i++;
    }
    return $result;
}


// Returns a selected User-Group row
function get_userGroup($id){
    $result = array();
    $user = selectRecord(TAB_USERS, "id = $id");

    $result['id'] = $user['id'];
    $result['username'] = $user['username'];
    $result['password'] = "";
    $result['email'] = $user['email'];

    $role = selectJoin(TAB_USR_ROLE, TAB_GROUPS, "groupId = id", "userId = $id")[0]['role'];
    $groups = selectQuery(TAB_GROUPS, "role <> '$role'", "role ASC");

    foreach($groups as $group){
        $gr_elem[] = $group['role'];
    }
    array_unshift($gr_elem, $role);
    $result['group'] = $gr_elem;

    return $result;
}


// Returns an empty User-Group info
function get_emptyUserGroup(){
    $result = array();
    $result['id'] = 0;
    $result['username'] = "username";
    $result['password'] = "pwd";
    $result['email'] = "mail@example.com";
    $groups = selectQuery(TAB_GROUPS, "", "role ASC");

    foreach($groups as $group){
        $result['group'][] = $group['role'];
    }
    return $result;
}


// Modify an existing User-Group row
function set_userGroup($data, $oldId){
    $data_user = array();
    $data_group = array();
    $data_user['id'] = $data['id'];
    $data_user['username'] = $data['username'];
    $data_user['password'] = $data['password'];
    $data_user['email'] = $data['email'];

    $group = $data['group'];
    $data['group'] = selectRecord(TAB_GROUPS, "role = '$group'")['id'];
    $data_group['userId'] = $data['id'];
    $data_group['groupId'] = $data['group'];

    updateRecord(TAB_USR_ROLE, $data_group, "userId = $oldId");
    updateRecord(TAB_USERS, $data_user, "id = $oldId");
    $data_info = array();
    if($data['group'] == 1){
        $data_info = array();
        $data_info['employment'] = "-";
        $data_info['img_address'] = "upload/user/user-default.png";
        $data_info['user'] = $data['id'];
        insertRecord(TAB_PERSONALINFO, $data_info);
    }
}


// Delete one or more User-Group
function delete_userGroup($idList, $number){
    if($number == 1){
        if(is_admin($idList)){
            return 0;
        }else{
            deleteRecord(TAB_USR_ROLE, "userId = $idList");
            deleteRecord(TAB_USERS, "id = $idList");
        }
    }else{
        $flag = false;
        for($i = 0; $i < count($idList); $i++){
            $id = $idList[$i];
            if(is_admin($id)){
                $flag = true;
                break;
            }
        }
        if(!$flag){
            for($j = 0; $j < count($idList); $j++){
                $id = $idList[$j];
                deleteRecord(TAB_USR_ROLE, "userId = $id");
                deleteRecord(TAB_USERS, "id = $id");
            }
        }else{
            return 0;
        }
    }
    return 1;
}

// Insert one or more rows in the Users-groups-user_role tables of the DB.
function restore_userGroup($data, $number){
    $new_dataUser = array();
    $new_dataRole = array();

    if($number == 1){
        $new_dataUser['id'] = $data[0]['id'];
        $new_dataUser['username'] = $data[0]['username'];
        $new_dataUser['password'] = $data[0]['password'];
        $new_dataUser['email'] = $data[0]['email'];
        $new_dataRole['userId'] = $data[0]['id'];
        $new_dataRole['groupId'] = $data[0]['group'];
        insertRecord(TAB_USERS, $new_dataUser);
        insertRecord(TAB_USR_ROLE, $new_dataRole);
    }else{
        foreach($data as $data_element){
            $new_dataUser['id'] = $data_element['id'];
            $new_dataUser['username'] = $data_element['username'];
            $new_dataUser['password'] = $data_element['password'];
            $new_dataUser['email'] = $data_element['email'];
            $new_dataRole['userId'] = $data_element['id'];
            $new_dataRole['groupId'] = $data_element['group'];
            insertRecord(TAB_USERS, $new_dataUser);
            insertRecord(TAB_USR_ROLE, $new_dataRole);
        }
    }
}


// Insert one row in users and user_role
function insert_userGroup($data){
    $user = array();
    $user_group = array();

    // Insert user
    $user['id'] = $data['id'];
    $user['username'] = $data['username'];
    $user['password'] = md5($data['password']);
    $user['email'] = $data['email'];
    insertRecord(TAB_USERS, $user);

    // Insert user-role
    $group = $data['group'];
    $data['group'] = selectRecord(TAB_GROUPS, "role = '$group'")['id'];
    $user_group['userId'] = $data['id'];
    $user_group['groupId'] = $data['group'];
    insertRecord(TAB_USR_ROLE, $user_group);
    if($group['id'] == 1){
        $data_info = array();
        $data_info['employment'] = "-";
        $data_info['img_address'] = "upload/user/user-default.png";
        $data_info['user'] = $data['id'];
        insertRecord(TAB_PERSONALINFO, $data_info);
    }
}


// Redefine an array sent by javascript
function restructure_usrGroup($list, $more){
    $result = array();
    if($more){
        for($i = 0; $i < count($list); $i++){
            $result[$i]['id'] = $list[$i][0];
            $result[$i]['username'] = $list[$i][1];
            $result[$i]['password'] = $list[$i][2];
            $result[$i]['email'] = $list[$i][3];
            $result[$i]['group'] = $list[$i][4];
        }
    }else{
        $result['id'] = $list[0];
        $result['username'] = $list[1];
        $result['password'] = $list[2];
        $result['email'] = $list[3];
        $result['group'] = $list[4];
    }
    return $result;
}


// Returns the header of the DB table User-Group
function get_userTableHeader(){
    $table_head = array();
    $table_head[0] = "Id";
    $table_head[1] = "Username";
    $table_head[2] = "Password";
    $table_head[3] = "Email";
    $table_head[4] = "Group";
    return $table_head;
}


// Check if a selected user is an admin
function is_admin($userId){
    $query = selectRecord(TAB_USR_ROLE, "userId = $userId");
    if($query['groupId'] == 1)
        return 1;
    else
        return 0;
}


// Check the correctness of the data that we want to insered
function check_userGroup($data, $op){
    $error = "";
    $id = $data['id'];

    if($op){
        if($id == 0){
            $error = "Id cannot be 0!";
            return $error;
        }

        if(strlen($data['username']) < 6 || strlen($data['username']) > 24 || strlen($data['password']) < 8 || strlen($data['password']) > 24){
            $error = "Username and password must be at least 8 characters length and up to 24.";
            return $error;
        }

        $username = $data['username'];
        $DB_check = selectQuery(TAB_USERS, "id = $id OR username = '$username' OR email = '$email'", "");
        if(count($DB_check) > 0){
            $error = "User already exist!";
            return $error;
        }

    }else{
        if(strlen($data['username']) < 6 || strlen($data['username']) > 24){
            $error = "Username must be at least 6 characters length and up to 24.";
            return $error;
        }

        if($data['password'] == ""){    // Password not modified
            $data['password'] = selectRecord(TAB_USERS, "id = $id")['password'];
        }else{
            if(strlen($data['password']) < 8 || strlen($data['password']) > 24){
                $error = "Password must be at least 8 characters length and up to 24.";
                return $error;
            }
        }
    }

    if(!(field_validation($data['username']) && field_validation($data['password'])) ){   // check the special characters
        $error = "Username and password can not contain special characters or blank spaces";
        return $error;
    }

    if(filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
        $email = $data['email'];
    }else{
        $error = "Email format is invalid.";
        return $error;
    }

    return $data;
}


// Set and send an html string which represents the row of the table
function push_usrRowObject($data){
    $id = $data['id'];
    $username = $data['username'];
    $password = "**********";
    $email = $data['email'];
    $groupId = $data['group'];

    $resultObject = '<tr class="even pointer" id="data_row" name="data_row" role="row">
                        <td class="a-center " name="table_td-checkbox">
                            <div class="icheckbox_flat-green" style="position: relative;" name="data_check" onClick="selected_checkbox(this)">
                                <input id="row_check" type="checkbox" class="table-checkbox" value="'.$id.'" name="table_records">
                                <ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background-color: rgb(255, 255, 255); border: 0px; opacity: 0; background-position: initial initial; background-repeat: initial initial;"></ins>
                                <input id="row_index" type="hidden" value="" name="row_index">
                            </div>
                        </td>
                        <td id="id" class=" " name="id" style="width:7%; margin-right:5px;">
                            <input id="id" class="table_td-input" name="table_input-field" value="'.$id.'" readonly="readonly"/>
                        </td>
                        <td id="email" class=" " name="email">
                            <input id="email" class="table_td-input" name="table_input-field" value="'.$username.'" readonly="readonly"/>
                        </td>
                        <td id="date" class=" " name="date">
                            <input id="date" class="table_td-input" name="table_input-field" value="'.$password.'" readonly="readonly"/>
                        </td>
                        <td id="date" class=" " name="date">
                            <input id="date" class="table_td-input" name="table_input-field" value="'.$email.'" readonly="readonly"/>
                        </td>
                        <td id="date" class=" " name="date">
                            <input id="date" class="table_td-input" name="table_input-field" value="'.$groupId.'" readonly="readonly"/>
                        </td>
                        <td class="table-operation" name="table_td-operation">
                            <a name="delete_button" href="#" onclick="select_operation(event, '.$id.')">
                                <i id="delete" class="fa fa-trash" title="Delete"></i>
                            </a>
                            <a name="edit_button" href="#" onclick="select_operation(event, '.$id.')" >
                                <i id="edit" class="fa fa-pencil" title="Edit"></i>
                            </a>
                            <a name="load_button" class="op-not-enable" href="#" onclick="select_operation(event, '.$id.')">
                                <i id="load" class="fa fa-play-circle" title="Load"></i>
                            </a>
                        </td>
                    </tr>';
    return $resultObject;
}
?>
