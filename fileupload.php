<?php 
    function upload_file($file, $destination){
        $result = array();
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = $file['type'];
        $file_ext = @strtolower(end(explode('.', $file_name)));

        $extensions= array('', 'jpeg', 'jpg', 'png', 'pdf', 'jfif');

        if(in_array($file_ext, $extensions) === false){
            $result['message'] = "extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > 2097152){
            $result['message'] = 'File size must be excately 2 MB';
        }
        $path = $destination."/".md5($file_name).'.'.$file_ext;

        if(empty($errors) == true){
            $result['result'] = move_uploaded_file($file_tmp, $path);
            $result['path'] = $path;
        }
        return $result;
    }
?>